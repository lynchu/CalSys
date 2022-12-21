<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Site Selection</title>
    <style>
        .card-area {
            background-color: #eee;
        }
        .h1{
            color: #545454;
        }
        .a{
            color: #545454;
        }
        .p{
            color: #545454;
        }
        .card {
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="m-3 mb-3">
            <h1 class="text-center">Site Selection</h1>
        </div>
        <div class="card card-area m-3 mb-3">
            <div class="row row-cols-1 row-cols-md-2 g-3 m-2 mb-3 ">
                <div class="col">
                    <div class="card h-100">
                        <img src="https://images.pexels.com/photos/777001/pexels-photo-777001.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Site Main</h5>
                            <p class="card-text">This is the main site. "main" is the current branch.</p>
                        </div>
                        <div class="card-footer">
                            <a href="./site_main/index.html" class="btn btn-primary">Go Site Main</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="https://images.pexels.com/photos/1714208/pexels-photo-1714208.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Site Alpha</h5>
                            <p class="card-text">For test the website. "dev-lynn" is current branch.</p>
                        </div>
                        <div class="card-footer">
                            <a href="./site_alpha/index.php" class="btn btn-primary">Go Site Alpha</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>