<?php


$nameError="";
require("mysqli_connect.php");
session_start();
$id=$_SESSION['bookId'];

$query="SELECT bookName,bookAuthor,quantity,price FROM book where bookId='$id'";
$r=@mysqli_query($dbc,$query);
if($r){
    $row = mysqli_fetch_array($r);

$currentQuantity= $row['quantity'];
$price=$row['price'];
$bookName=$row['bookName'];
$bookAuthor=$row['bookAuthor']; 
}


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
    <link rel="stylesheet" href="CSS/index.css">
</head>

<body>
    <!-- navigation bar -->
    <nav class="navbar navbar-expand-lg bgColor p-0">
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
                        <a class="nav-link fontDark" aria-current="page" href="index.html">HOME</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link fontDark" href="store.php">STORE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fontDark" href="contact.html">CONTACT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1 class="fontDark headfonts text-center fs-3" >PLACE AN ORDER</h1>
        <!-- form for getting usewr details -->
        <form action="checkout.php" method="POST" >
        <div class="form-group d-flex p-1">
            <!-- first name and lastname -->
            <input type="text" class=" form-control m-2 fontDark parafonts" name="firstName" id="firstName" placeholder="First Name" required>
            <input type="text" class=" form-control m-2 fontDark parafonts" name="lastName" id="lastName" placeholder="Last Name" required>
        
        </div>
         <!-- payment option -->
         <div class="form-group d-flex p-1">
            <label class=" m-2 fontDark fontBold parafonts"> Pay By:</label>
         <div class="form-check m-2 ">
             <input class="form-check-input " type="radio" name="paymentOption" id="visa" value="Visa">
            <label class="form-check-label fontDark parafonts" for="visa">Visa</label>
        </div>
        <div class="form-check m-2 ">
             <input class="form-check-input " type="radio" name="paymentOption" id="masterCard" value="MasterCard">
            <label class="form-check-label fontDark parafonts" for="masterCard">MasterCard</label>
        </div>
        <div class="form-check m-2 ">
             <input class="form-check-input " type="radio" name="paymentOption" id="Debit" value="Debit">
            <label class="form-check-label fontDark parafonts" for="Debit">Debit</label>
        </div>
        </div>
        <!-- card number -->
        <div class="form-group d-flex p-1">
            <!-- first name and lastname -->
            <input type="text" class="form-control m-2 fontDark parafonts " name="cardNum" id="cardNum" placeholder="Card Number E.x, xxxx-xxxx-xxxx-xxxx" required>
            <span class="fontPink"><?php echo $nameError;?></span>
        </div>

         <!-- quantity -->
         <div class="form-group d-flex p-1">
            <!-- quantity and  price per head-->
       
            <input type="number" min="1" max="<?php echo $currentQuantity;?>" name="quantity" class=" form-control m-2 fontDark parafonts" id="quantity" placeholder="Quantity">
            <input type="text"  value="<?php if (isset($price)) {echo $price.' (Per Unit)';}?>" class="form-control m-2 fontDark parafonts" id="price" disabled>

        </div>
        <input type="submit" name="submit"  value="Submit" class="fontDark btn m-2 fs-5" <?php if(isset($_POST['submit'] ))  {echo "disabled";} ?>>
        
</form>
<?php
                
             // including database connection file
             if($_SERVER['REQUEST_METHOD']=='POST')
             {
             
   if(!empty($_POST['firstName']) || !empty($_POST['lastName']) || !empty($_POST['paymentOption']) || !empty($_POST['quantity'])){
 
    $firstName=mysqli_real_escape_string($dbc,strip_tags(trim($_POST['firstName'])));
    $lastName=mysqli_real_escape_string($dbc,strip_tags(trim($_POST['lastName'])));
    $paymentOption=mysqli_real_escape_string($dbc,strip_tags(trim($_POST['paymentOption'])));
    $cardNum=mysqli_real_escape_string($dbc,strip_tags(trim($_POST['cardNum'])));
    $quantity=mysqli_real_escape_string($dbc,strip_tags(trim($_POST['quantity'])));

    // echo $paymentOption;
    // echo $_POST["firstName"];

    // calculating total including tax
    $total=round($quantity*$price+($quantity*$price*0.13),2);
    // $pattern='/[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}/';
    // if(preg_match($pattern,$firstName)){
    //     $nameError="EWrror!";
    // }
    $qua=$currentQuantity-$quantity;
     //inserting data into database
     $q="INSERT INTO orders(firstName,lastName,paymentOption,cardNum,total,bookId,quantity) values('$firstName','$lastName','$paymentOption','$cardNum','$total','$id','$quantity')";
     $r=@mysqli_query($dbc,$q);
     if($r){
        // for updating quantity in book table
        $q1 = "UPDATE book SET quantity='$qua' WHERE bookId='$id'";
        if(mysqli_query($dbc, $q1)){
           $success="Order placed successfully!";
        } else {
            echo "ERROR: Could not able to execute $q1. " . mysqli_error($dbc);
        }

     }else{
        echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q .'</p>';
     }
    }
?>
<fieldset class="headfonts fontDark cardBorder p-2 m-2 mb-5">
    <legend class="headfonts fontDark fontBold" >ORDER SUMMARY</legend>
        <p class="headfonts fontDark fs-5 fontBold p-1"><?php echo strtoupper($firstName)." ".strtoupper($lastName);?></p>
        <p class="parafonts fontDark p-1"><?php echo "Payment done by: ".strtoupper($paymentOption)." card ending with xxxx-xxxx-xxxx-".substr($cardNum,-4);?></p>
        <p class="parafonts fontDark p-1"><?php echo "Subtotal: ".$quantity." * ".$price;?></p>   
        <p class="parafonts fontDark p-1"><?php echo "Order Total: ".$total."  Including tax(13%)";?></p>
        <p class="parafonts fontDark p-1"><?php echo "Purchased Item: ".$bookName." by ".$bookAuthor;?></p>
        <p class="parafonts fontPink fontBold p-1"><?php echo $success;?></p>
        <a href="index.html" class="fontDark btn m-2 fs-5">Continue Shopping!<a>
</fieldset>
<?php
session_destroy();
?>

   
    <?php
    
}?>
 <p class="fontDark parafonts text-end fs-5 pe-5">Made with <span class="fontPink fs-1 ">&hearts; </span> by
        Saniya
        Memon- 2022</p>
    <!-- bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>

</body>

</html>
