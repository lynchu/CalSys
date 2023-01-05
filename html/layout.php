<?php
function chapter_list($row){
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

function question_list(){
    
}
?>