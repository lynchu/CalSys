<!DOCTYPE html>
<html lang="en">
<?php require_once('head.php') ?>
<body>

<div class="container">
    <!-- list chapter with card -->
    <?php
        require_once('class.php');
        $chapter_id = $_GET['chapter'];
        $connection = new db_connection;
        if($chapter_id==-1){
            $sql = '
                SELECT questions.id, questions.tex_content, question_chapter.chapter_id, chapters.chapter_name, questions.updated_at
                FROM question_chapter, questions, chapters
                where question_chapter.question_id = questions.id
                and question_chapter.chapter_id = chapters.id;
            ';
        } else{
            $sql = '
                SELECT questions.id, questions.tex_content, question_chapter.chapter_id, chapters.chapter_name, questions.updated_at
                FROM question_chapter, questions, chapters
                WHERE question_chapter.chapter_id = '.$chapter_id.'
                and question_chapter.question_id = questions.id
                and question_chapter.chapter_id = chapters.id;
            ';
        }
        $connection->sql_query($sql);
        $chapter = $chapter_id;
        if($chapter_id==-1) $chapter = 'ALL';
        $title = '
            <!-- chapter name -->
            <div class="px-4 py-5 my-5 text-center">
                <h1 class="display-5 fw-bold">Chapter '.$chapter.' </h1>
            </div>
        ';
        echo $title;
        foreach($connection->result as $row){
            $connection->echo_questions($row, $chapter_id);
            // print_r($row);
            // echo "<br>";
        }
        $connection->close_connection();
    ?>
</div>
    
</body>
</html>