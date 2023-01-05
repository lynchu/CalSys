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
            die($e->getMessage());
		}
	}

    public function echo_chapter_list($row){
        // id, chapter_name
        $html = 
            '<div class="card mb-3">
                <div class="card-body bg-image hover-overlay ripple shadow-1-strong rounded" data-mdb-ripple-color="light">
                    <h6 class="card-title"> Chapter '.$row->id.'</h4>
                    <h5 class="card-text">'.$row->chapter_name.'</h3>
                    <a href="./questions_list.php?chapter='.$row->id.'" class="card-link stretched-link">
                    </a>
                </div>
            </div>';
        echo $html;
    }

    public function echo_questions($row, $chapter){
        // print_r($row);
        // echo '<br>';
        // row row-cols-1 row-cols-md-1 g-3 m-2 mb-3
        $html2 = '
        <div class="row row-cols-1 row-cols-md-1 m-2 mb-3 card text-center">
            <div class="card-header">
                Question ID '.$row->id.'
            </div>
            <div class="card-body">
                <h5 class="card-title">'.$row->chapter_name.'</h5>
                <p class="card-text">'.$row->tex_content.'</p>
            </div>
            <div class="card-body">
                <div class="gap-2 mx-auto">
                    <a href="view_edit.php?id='.$row->id.'">
                        <button class="col-1 btn btn-primary  " type="button">
                            Edit
                        </button>
                    </a>
                    <button class="col-1 btn btn-danger " type="button" data-bs-toggle="modal" data-bs-target="#exampleModal'.$row->id.'">
                        Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal'.$row->id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="delete_question.php?id='.$row->id.'&chapter='.$chapter.'">
                                        <button type="button" class="btn btn-danger">Delete</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-muted">
                Updated at "'.$row->updated_at.'"
            </div>
        </div>
        ';
        echo $html2;
    }

    public function chapter_dropdown($row){
        $html = '
            <option value="'.$row->id.'" > ch'.$row->id.'. '.$row->chapter_name.'</option>
        ';
        echo $html;
    }

    public function textbook_dropdown($row){
        $html = '
            <option value="'.$row->id.'" >'.$row->book_name.'</option>';
        echo $html;
    }

    public function close_connection(){
        $this->conn = NULL;
    }
}

?>