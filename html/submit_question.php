<?php
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
require_once('class.php');
$connection = new db_connection;


// $chapter = $_POST['chapter'];
// $difficulty = $_POST['difficulty'];
// $textbook = $_POST['textbook'];
// $page = $_POST['page'];
//print_r($_REQUEST);
$chapter = $_REQUEST['chapter'];
$difficulty = $_REQUEST['difficulty'];
$textbook = $_REQUEST['TextbookName'];
$page = $_REQUEST['page'];
$ques_text = $_REQUEST['ques_text'];
//echo $chapter;
//echo $difficulty;
//echo $textbook;
//echo $page;
//echo $ques_text;
//echo "<br>";
/* insert new question */
$questions_insert_sql = "
    INSERT INTO questions(tex_content, difficulty)
    VALUES('".$ques_text."', ".$difficulty.");";
$connection->sql_query($questions_insert_sql);

/* select new question's id */
$questions_id_sql = '
    SELECT id, created_at
    FROM questions
    ORDER BY created_at DESC LIMIT 1;';
$connection->sql_query($questions_id_sql);
$ques = $connection->result;
//print_r($ques['0']);
//echo "<br>".$ques['0']->id;

$question_chapter_sql = "
    INSERT INTO question_chapter(question_id, chapter_id)
    VALUES(".$ques['0']->id.", ".$chapter.");";
$connection->sql_query($question_chapter_sql);
if(empty($page)){
    $question_textbook_sql = "
        INSERT INTO question_textbook(question_id, textbook_id)
        VALUES(".$ques['0']->id.",".$textbook.");
    ";
}else{
    $question_textbook_sql = "
        INSERT INTO question_textbook(question_id, textbook_id, page)
        VALUES(".$ques['0']->id.",".$textbook.", ".$page.");
    ";
}
$connection->sql_query($question_textbook_sql);
//}
?>