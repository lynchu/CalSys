<?php
class db_connection{
	private $host;
	private $db;
	private $user;
	private $password; // change to your password
	private $conn;
	public $result;

	public function __construct(){
		$this->host = 'database-1.cvot66pyfjis.us-east-1.rds.amazonaws.com';
		$this->db = 'final_project';
		$this->user = 'postgres';
		$this->password = 'OAjVnynUXrrPgJ0'; // change to your password
		// build connection
		try {
			$dsn = "pgsql:host=$this->host;port=5432;dbname=$this->db;";
			// make a database connection
			$this->conn = new PDO($dsn, $this->user, $this->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function sql_query($sql){
		try {
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			// set the resulting array to associative
			$this->result = $stmt->fetchAll(PDO::FETCH_CLASS);
		} catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

    public function echo_chapter_list($row){
        // id, chapter_name
        $html = 
            '<div class="card mb-3">
                <div class="card-body bg-image hover-overlay ripple shadow-1-strong rounded" data-mdb-ripple-color="light">
                    <h6 class="card-title"> Chapter '.$row->id.'</h4>
                    <h5 class="card-text">'.$row->chapter_name.'</h3>
                    <a href="./questions_list.php?chapter='.$row->id.'" class="btn btn-primary stretched-link ">
                        Card link
                    </a>
                </div>
            </div>';
        echo $html;
    }

    public function echo_questions($row){
        // print_r($row);
        // echo '<br>';
        $html2 = '
        <div class="card text-center">
            <div class="card-header">
                Question '.$row->id.'
            </div>
            <div class="card-body">
                <h5 class="card-title">'.$row->chapter_name.'</h5>
                <p class="card-text">'.$row->tex_content.'</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            <div class="card-footer text-muted">
                Updated at "'.$row->updated_at.'"
            </div>
        </div>
        ';
        echo $html2;
    }

    public function close_connection(){
        $this->conn = NULL;
    }
}

?>