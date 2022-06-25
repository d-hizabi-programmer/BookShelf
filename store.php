<?php
// requiring database connection file
require("mysqli_connect.php");

// query to select data from table
$q1="SELECT * FROM book";

// executing query
$r = @mysqli_query ($dbc, $q1); 

    // checking wether $r is not empty
if($r){
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title>THEBOOKTOWN- Let's get lost in the pages</title>

    <!-- logo in browser tab -->
    <link rel="icon" href="images/logo.png">

    <!-- linking bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!-- linking google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- linking custom style sheeet -->
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
    <!-- navigation bar -->
    <nav class="navbar navbar-expand-lg bgColor">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/BRAND.png" alt="TheBooktown-Let's get lost in the pages" width="300" height="70">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 headfonts fontBold fontDark">
                    <li class="nav-item">
                        <a class="nav-link fontDark " aria-current="page" href="index.html">HOME</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link fontDark activ" href="#">STORE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fontDark" href="contact.html">CONTACT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- heading -->
    <h1 class=" fontDark headfonts text-center fs-3">NEW <span class="fontPink fontBold">&</span> TRENDING!</h1>
    <p class=" fontPink parafonts text-center fs-5">Explore the new world from Authors</p>
    <!-- cards for displaying data from databse -->
    
 <div class="container-fluid d-flex flex-wrap justify-content-evenly align-items-center">
    <?php 
     // creating loop
     while($row=mysqli_fetch_array($r)){
        $imgSrc="images/".$row['bookName']."jpg";
    ?>
        <div class="card mb-3 m-auto" style="max-width: 350px;">
         <div class="row g-2">
             <div class="col-md-4">
                 <img src="images/War and peace.jpg" class="img-fluid" alt="<?php echo $row["bookName"].' by '.$row["bookAuthor"]?>">
            </div>
        <div class="col-md-8">
         <div class="card-body">
         <h5 class="card-title"><?php echo $row["bookName"]; ?></h5>
        <p class="card-text"><?php echo $row["bookAuthor"];?></p>
        
       </div>
     </div>
   </div>
     </div>
   <?php
   }   

mysqli_free_result($r);
     }
 ?>
   
</div>


    <!-- bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>
</html>
