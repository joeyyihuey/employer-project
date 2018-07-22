<?php
    session_start(); 
?>
<head>
    <title>Vecootech</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="animsition/dist/js/animsition.min.js" charset="utf-8"></script>
    <link href="animsition/dist/css/animsition.min.css" rel="stylesheet">
    <link href="src/css/login_page.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <script src="//cdnjs.cloudflare.com/ajax/libs/noty/3.1.2/noty.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/noty/3.1.2/noty.css">
    <script type="text/javascript" src="src/js/detail.js"></script>  


    <style>
        #Add_product_btn{
            position:fixed;
            bottom:0;
            right:0;
            margin-bottom: 10px;
        }


        #Add_quotation_btn{
            position:fixed;
            bottom:0;
            left:0;
            margin-bottom: 10px;
        }



    </style>


</head>

<div hidden>
<?php 
    $url_check = $_SERVER['REQUEST_URI'];
    $login_role = $_SESSION['login_role'];
    $full_name = $_SESSION['full_name'];
   
?>
</div>


<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" disabled>Vecootech</a>
        </div>

        <ul class="nav navbar-nav">
            <?php if ($login_role == "admin"):?>

             <li class="active"><a href="companies.php">Companies</a></li>
             <?php endif; ?>  

            <?php if ($login_role == "company"):?>
             <li class="active"><a href="users.php">Users</a></li>
            <?php endif; ?>  
        </ul>

        <?php if ($login_role != "admin" && $login_role != NULL):?>
        <ul class="nav navbar-nav">
            
            <li class="active"><a href="products.php">Product maintenance</a></li>
            <!-- <li class="active"><a href="#">Setting</a></li> -->
        </ul>
        <?php endif; ?>  






      

        <ul class="nav navbar-nav navbar-right">


            <?php if (isset($_SESSION['user_id'])):?>

                <li><a href="sign_out.php"><i class="fas fa-sign-out-alt"></i> Sign Out</a></li>
            <?php else:?>
               <li><a href="sign_up.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
               <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
           

            <?php endif; ?>  
        </ul>
    </div>
</nav>
  