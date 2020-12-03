<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        include __DIR__.'/GlobalInclusions.html';
    ?>
    <title>Document</title>
</head>
<body style="background: black;">
    <?php include __DIR__.'/navbar.php'; ?>
    <div id="carouselExampleCaptions" class="carousel slide carousel-fade"data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0"   class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active" style="height: 80vh; box-sizing: border-box;">
                <img  src="./assets/imgs/c2.jpg" class="d-block w-100 h-100" alt="...">
            </div>
            <div class="carousel-item" style="height: 80vh; box-sizing: border-box;">
                <img src="./assets/imgs/c1.jpg" class="d-block w-100 h-100" alt="...">
            </div>
            <div class="carousel-item" style="height: 80vh; box-sizing: border-box;">
                <img src="./assets/imgs/c3.jpg" class="d-block w-100 h-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container mt-5">
        <div>
            <h1 style="color: white" class="display-4">Features</h1>
            <div id="carouselExampleFade" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <h4 class="h4 w-100" style="color: rgb(90, 90, 90)">Receivers can login to the application to find out if any hospital is currently possessing their blood type</h3>
                    </div>
                    <div class="carousel-item">
                        <h3 class="h3 w-100" style="color: rgb(90, 90, 90)">Hospitals can login to the application to add or remove information about the blood samples that they possess so that receivers can access it</h3>
            
                    </div>
                </div>
                
            </div>
        </div>
        <button class="btn btn-danger mt-4" onclick="location.href = './AvailableSamples.php'">Check Available Blood Sample</button>
    </div>
    <div class="mt-5" style="height: 30px; background: rgb(22, 22, 22); text-align: right;">
        <p class="card-text"><small class="text-muted">created by Ayush Jain</small></p>
    </div>
    
    <?php
        if(array_key_exists('message', $_SESSION) && $_SESSION['message'] != "")
            echo "<script>alert(\"".$_SESSION["message"]."\")</script>";
        $_SESSION['sample_id'] = null;
        $_SESSION['message'] = "";

    ?>
</body>
</html>