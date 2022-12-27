<?php
function chapter_list($row){
    // id, chapter_name
    $html = 
        '<div class="card mb-3">
            <div class="card-body bg-image hover-overlay ripple shadow-1-strong rounded" data-mdb-ripple-color="light">
                <h6 class="card-title"> Chapter '.$row->id.'</h4>
                <h5 class="card-text">'.$row->chapter_name.'</h3>
                <a href="#" class="btn btn-primary stretched-link ">
                    Card link
                </a>
            </div>
        </div>';

    $html2 = 
        '<div class="row no-gutters">
                <div class="col-md-4">
                    <img src="..." class="card-img" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>';
    echo $html;
}
?>