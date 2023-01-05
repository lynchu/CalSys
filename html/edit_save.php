<?php
require_once('class.php');
$connection = new db_connection;
// print_r($_REQUEST);
$question_id = $_REQUEST['id'];
$chapter = $_REQUEST['chapter'];
$difficulty = $_REQUEST['difficulty'];
$textbook_id = $_REQUEST['textbook_id'];
$page = $_REQUEST['page'];
$tex_content = $_REQUEST['ques_text'];

$questions_sql = "
    UPDATE questions
    SET tex_content = '".$tex_content."', difficulty = ".$difficulty."
    WHERE id = ".$question_id.";
    ";
$connection->sql_query($questions_sql);

$question_chapter_sql = '
    UPDATE question_chapter
    SET chapter_id = '.$chapter.'
    WHERE question_id = '.$question_id.';
';
$connection->sql_query($question_chapter_sql);

$search_question_textbook_sql = '
    SELECT question_id
    FROM question_textbook
    WHERE question_id = '.$question_id.'
';
$connection->sql_query($search_question_textbook_sql);
$textbook_qID= $connection->result;
//echo '<br>';
//print_r($connection->result);
if($textbook_id != -1){
    if(empty($textbook_qID) && empty($page)){
        $question_textbook_sql = "
            INSERT INTO question_textbook(question_id, textbook_id)
            VALUES(".$question_id.",".$textbook_id.");
        ";
    }
    else if(empty($textbook_qID) && !empty($page)){
        $question_textbook_sql = "
            INSERT INTO question_textbook(question_id, textbook_id, page)
            VALUES(".$question_id.",".$textbook_id.", ".$page.");
        ";
    }
    else if(empty($page)){
        $question_textbook_sql = '
            UPDATE question_textbook
            SET textbook_id = '.$textbook_id.'
            WHERE question_id = '.$question_id.';
        ';
    }
    else{
        $question_textbook_sql = '
            UPDATE question_textbook
            SET textbook_id = '.$textbook_id.', page = '.$page.'
            WHERE question_id = '.$question_id.';
        ';
    }
}
else{
    if(!empty($textbook_qID)){
        $question_textbook_sql = '
            UPDATE question_textbook
            SET textbook_id = NULL
            WHERE question_id = '.$question_id.';
        ';
    }
}
/*$question_textbook_sql = '
    UPDATE question_textbook
    SET textbook_id = '.$textbook_id.', page = '.$page.'
    WHERE question_id = '.$question_id.';
';*/
$connection->sql_query($question_textbook_sql);

$url = 'questions_list.php?chapter=-1';
if (isset($url)) Header("Location: $url");
else Header("Location: index.php");
?>