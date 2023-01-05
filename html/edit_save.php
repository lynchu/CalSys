<?php
require_once('class.php');
$connection = new db_connection;
print_r($_REQUEST);
$question_id = $_REQUEST['id'];
$chapter = $_REQUEST['chapter'];
$difficulty = $_REQUEST['difficulty'];
$textbook_id = $_REQUEST['textbook_id'];
$page = $_REQUEST['page'];
$tex_content = $_REQUEST['ques_text'];

/*$questions_sql = '
    UPDATE questions
    SET tex_content = '.$', difficulty = '. $difficulty.'
    WHERE id = '';
';
$question_textbook_sql = '
    UPDATE question_textbook
    SET book
';*/
?>