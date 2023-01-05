<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'?>
<body>

<?php
    require_once('class.php');
    $connection = new db_connection;
?>

<div class="container">
    <!-- chapter list title -->
    <div class="py-5 text-center">
        <img src="https://cdn-icons-png.flaticon.com/512/1774/1774106.png" width="50" height="50" alt="">
        <h2>Create Question</h2>
        <p class="lead">為微積分題庫系統留下你的足跡吧！</p>
    </div>

    <div class="col-md-7 col-lg-10">
        <h4 class="mb-3">Information about the Question</h4>
        
        <form class="needs-validation" novalidate method="post" action="submit_question.php">          
            <div class="row g-3">

                <div class="col-md-6">
                    <label for="chapter" class="form-label">Chapter</label>
                    <select class="form-select" name="chapter" id="chapter" required>
                        <option value="">Choose...</option> 
                        <!-- chapter list -->
                        <?php 
                            $sql = '
                                SELECT id, chapter_name 
                                FROM chapters
                            ';
                            $connection->sql_query($sql);
                            foreach($connection->result as $row){
                                $connection->chapter_dropdown($row);
                            }
                        ?>
                    </select>
                    <div class="invalid-feedback">
                        Please select a chapter.
                    </div>
                </div>

                <div class="col-md-2">
                    <label for="difficulty" class="form-label">Difficulty</label>
                    <select class="form-select" name="difficulty" id="difficulty" required>
                        <option value="">Choose...</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select difficulty.
                    </div>
                </div>

                <div class="col-md-7">
                    <label for="TextbookName" class="form-label">Textbook</label>
                    <!--<select class="form-control select2">-->
                    <select name="TextbookName" class="form-select" id="TextbookName" required>
                    <!--<select class="form-select" id="TextbookName" required>-->
                        <option value="">Choose...</option>
                        <?php 
                            $sql = '
                                SELECT id, book_name 
                                FROM textbooks
                            ';
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
                    <input type="number" min="0" class="form-control" name="page" id="page" placeholder="Optional" value="">
                    <!--<small class="text-muted">Number only</small>-->
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
                        <textarea type="text" class="form-control form-control-lg" name="ques_text" id="ques_text" placeholder="" required></textarea>
                        <small class="text-muted">Latex only</small>
                        <div class="invalid-feedback">
                            Please enter question description
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            <button class="w-100 btn btn-primary btn-lg" type="submit">Submit</button>
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