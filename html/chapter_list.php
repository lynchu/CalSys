<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'?>
<style>
    .card:hover {
        background-color: #eee;
    }
</style>
<body>

<div class="container">
    <!-- chapter list title -->
    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold">Chapters List</h1>
        <p class="lead mb-4">
            微積分是數學中一個重要的領域，
            它涉及到許多技巧和方法，
            包括基礎和極限、微分、微分的應用、參數方程和極坐標、無限積分、有限和不完全積分、積分的應用、序列和級數、多重積分和偏微分方程。
            這些工具和方法在解決各種數學和物理問題中都非常有用，
            包括解析幾何、物理學、工程學和許多其他領域。
            此外，微積分還與向量微積分和微積分方程有密切聯繫，這是另一個重要的數學領域。 by chatGPT
        </p>
    </div>
    <!-- list chapter with card -->
    <div class="card-area m-3 mb-3">
        <div class="row row-cols-1 row-cols-md-1 g-3 m-2 mb-3 ">
            <div class="card mb-3">
                <div class="card-body bg-image hover-overlay ripple shadow-1-strong rounded" data-mdb-ripple-color="light">
                    <h6 class="card-title"> All Chapter</h4>
                    <h5 class="card-text">All Questions</h3>
                    <a href="./questions_list.php?chapter=-1" class="card-link stretched-link">
                    </a>
                </div>
            </div>

            <?php 
                require_once('class.php');
                $connection = new db_connection;
                $sql = '
                    SELECT id, chapter_name 
                    FROM chapters
                ';
                $connection->sql_query($sql);
                foreach($connection->result as $row){
                    $connection->echo_chapter_list($row);
                }
                $connection->close_connection();
            ?>
        </div>
    </div>
</div>

</body>
</html>