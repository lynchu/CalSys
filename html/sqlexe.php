<?php


$connection = new db_connection;
$sql = 'SELECT id, chapter_name FROM chapters';
$connection->sql_query($sql);
print_r($connection->result);

// $host= 'database-1.cvot66pyfjis.us-east-1.rds.amazonaws.com';
// $db = 'final_project';
// $user = 'postgres';
// $password = 'OAjVnynUXrrPgJ0'; // change to your password

// // build connection
// try {
//   $dsn = "pgsql:host=$host;port=5432;dbname=$db;";
//   // make a database connection
//   $conn = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

//   if ($conn) {
//       // echo "Connected to the $db database successfully!";
//   }
// } catch (PDOException $e) {
//   die($e->getMessage());
// }

// include 'layout.php';

// try {
//   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   $stmt = $conn->prepare("SELECT id, chapter_name FROM chapters");
//   $stmt->execute();

//   // set the resulting array to associative
//   $result = $stmt->fetchAll(PDO::FETCH_CLASS);
//   foreach($result as $row){
//     chapter_list($row);
//   }
// } catch(PDOException $e) {
//   echo "Error: " . $e->getMessage();
// }
// $conn = null;
?>