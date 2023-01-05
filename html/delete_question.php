<!DOCTYPE html>
<html lang="en">
<?php require_once('head.php') ?>

<body>

<div class="container">
    <div class="spinner-border m-5" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<?php
    require_once('class.php');
    $url = 'questions_list.php?chapter='.$_REQUEST['chapter'];
    $question_id = $_REQUEST['id'];
    $sql = '
        delete from questions
        where id = '.$question_id.';
    ';
    $connection = new db_connection;
    $connection->sql_query($sql);

    if (isset($url)) Header("Location: $url");
    else Header("Location: index.php");

?>

</body>
</html>