<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'?>
<body>

<?php
    //echo $_REQUEST['id'];
    $ques_id = $_REQUEST['id'];
    require_once('class.php');
    $connection = new db_connection;
    $questions_sql = '
    select questions.id, questions.tex_content, questions.difficulty, 
        question_chapter.chapter_id, chapters.chapter_name,
        question_textbook.textbook_id, textbooks.book_name, question_textbook.page
    from questions 
        left join question_chapter on questions.id = question_chapter.question_id
        left join question_textbook on questions.id = question_textbook.question_id
        left join chapters on question_chapter.chapter_id = chapters.id
        left join textbooks on question_textbook.textbook_id = textbooks.id
    where questions.id = '.$ques_id.';
    ';
    $connection->sql_query($questions_sql);
    $question = $connection->result;
    $question = $question[0];
    //print_r($question);
    //$connection->sql_query($sql);
?>

<div class="container">
    <!-- chapter list title -->
    <div class="py-5 text-center">
        <img src="https://cdn-icons-png.flaticon.com/512/1774/1774106.png" width="50" height="50" alt="">
        <h2>Edit Question</h2>
        <p class="lead">為微積分題庫系統留下你的足跡吧！</p>
    </div>

    <div class="col-md-7 col-lg-10">
        <h4 class="mb-3">Information about the Question</h4>
        <!--<form class="needs-validation" novalidate method="post" action="edit_save.php?id=".$ques_id>-->
            <?php
                echo '
                    <form class="needs-validation" novalidate method="post" action="edit_save.php?id='.$ques_id.'">
                ';
                /*echo '
                    <input type="hidden" value="'.$question->id.'">
                ';*/
            ?>
            <div class="row g-3">

                <div class="col-md-6">
                    <label for="chapter" class="form-label">Chapter</label>
                    <select class="form-select" name="chapter" id="chapter" required>
                        <!-- chapter list -->
                        <?php 
                            $sql = '
                                SELECT id, chapter_name 
                                FROM chapters
                            ';
                            $connection->sql_query($sql);
                            $selected = '
                                <option value="'.$question->chapter_id.'" selected>
                                    ch'.$question->chapter_id.'. '.$question->chapter_name.'
                                </option>
                            ';
                            //echo $selected;
                            foreach($connection->result as $row){
                                if($row->id != $question->chapter_id){
                                    $connection->chapter_dropdown($row);
                                }
                                else{
                                    echo $selected;
                                }
                            }
                        ?>
                    </select>
                    <div class="invalid-feedback">
                        Please select a chapter.
                    </div>
                </div>

                <div class="col-md-2">
                    <label for="difficulty" class="form-label">Difficulty</label>
                    <select value="<?php $question->difficulty ?>" class="form-select" name="difficulty" id="difficulty" required>
                        <?php
                            for($i=1; $i<=5; $i++){
                                if($question->difficulty == $i) echo "<option selected>".$i."</option>";
                                else echo "<option>".$i."</option>";
                            }
                        ?>
                    </select>
                    <div class="invalid-feedback">
                        Please select difficulty.
                    </div>
                </div>

                <div class="col-md-7">
                    <label for="TextbookName" class="form-label">Textbook</label>
                    <!--<select class="form-control select2">-->
                    <select name="textbook_id" class="form-select" id="textbook_id" required>
                    <!--<select class="form-select" id="TextbookName" required>-->
                        <?php 
                            $sql = '
                                SELECT id, book_name 
                                FROM textbooks
                            ';
                            echo "<option value=-1></option>";
                            $connection->sql_query($sql);
                            foreach($connection->result as $row){
                                $connection->textbook_dropdown($row);
                            }
                        ?>
                    </select>
                    <div class="invalid-feedback">
                        Please select a textbook.
                    </div>
                </div>

                <div class="col-sm-2">
                    <label for="page" class="form-label">Page</label>
                    <?php
                        echo '<input type="number" min="0" class="form-control" name="page" id="page" placeholder="" value="'.$question->page.'">';
                    ?>
                    <small class="text-muted">Optional</small>
                </div>
                <!--<div class="col-md-3">
                    <label for="ISBN13" class="form-label">ISBN 10</label>
                    <input type="text" class="form-control" id="ISBN13" placeholder="Optional">
                </div>

                <div class="col-md-3">
                    <label for="ISBN13" class="form-label">ISBN 13</label>
                    <input type="text" class="form-control" id="ISBN13" placeholder="Optional">
                </div>-->
                

                <hr class="my-4">
                <h4 class="mb-3">Question Description</h4>
                <div class="row gy-1">
                    <div class="col-ms">
                        <?php 
                            echo '
                                <textarea type="text" class="form-control form-control-lg" name="ques_text" id="ques_text" placeholder="" required>'.$question->tex_content.'
                                </textarea>
                            ';
                        ?>
                        <small class="text-muted">Latex only</small>
                        <div class="invalid-feedback">
                            Please enter question description
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="#" class="col-2 btn btn-secondary me-md-2 " onClick="javascript :history.back(-1);">
                    Cancel
                </a>
                <button class="col-2 btn btn-primary " type="button" data-bs-toggle="modal" data-bs-target="#save">
                    Save
                </button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="save" tabindex="-1" aria-labelledby="saveLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="saveLabel">Are you sure you want to update this question?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <a href="delete_question.php?id='.$row->id.'&chapter='.$chapter.'">
                                <button type="submit" class="btn btn-primary">Yes</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $connection->close_connection();?>
</body>
</html>

<script>

    var select_box_element = document.querySelector('#select_box');

    dselect(select_box_element, {
        search: true
    });

</script>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>