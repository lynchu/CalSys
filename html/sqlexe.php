<?php
    $host= 'database-1.cvot66pyfjis.us-east-1.rds.amazonaws.com';
    $db = 'final_project';
    $user = 'postgres';
    $password = 'OAjVnynUXrrPgJ0'; // change to your password
    
    try {
        $dsn = "pgsql:host=$host;port=5432;dbname=$db;";
        // make a database connection
        $conn = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    
        if ($conn) {
            echo "Connected to the $db database successfully!";
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    
    echo "<table style='border: solid 1px black;'>";
    echo "<tr><th>Id</th><th>tex_content</th></tr>";
    
    class TableRows extends RecursiveIteratorIterator {
      function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
      }
    
      function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
      }
    
      function beginChildren() {
        echo "<tr>";
      }
    
      function endChildren() {
        echo "</tr>" . "\n";
      }
    }
    
    try {
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT id, tex_content FROM original_data");
      $stmt->execute();
    
      // set the resulting array to associative
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
      }
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";
    
    ?>