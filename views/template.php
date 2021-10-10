<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title><?=$this->e($title)?></title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script> -->

</head>
        <header> 
            <nav class="" style="padding-right: 150px; padding-top: 10px;">       
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" href="/register"><?php if(empty($_SESSION["auth_user_id"]) or $_SESSION["auth_roles"]=='1'){echo 'Register';}?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php if(isset($_SESSION["auth_user_id"])){echo '/logout';} else {echo '/login';}?>">
                            <?php 
                            if(isset($_SESSION["auth_user_id"])){echo 'Logout';} else {echo 'Login';}?>
                        </a>         
                    </li>
                </ul>
            </nav>
            <div class="flashes">
                <?php echo flash()->display(); ?>
            </div>
        </header>
<body>
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="index.php"><img src="img/core-img/logo.png" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>


        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="/"><img src="img/core-img/logo.png" alt=""></a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li class="<?php if(empty($_GET['category'])){echo 'active';}?>"><a href="/">All products</a></li>
                </ul>

                <!--  Catagories  -->
                <div class="catagories-menu">
                    <ul>
                        <li class="<?php if(isset($_GET['category']) and $_GET['category']=='Chairs'){echo 'active';}else{'';} ?>"><a href="/home?category=Chairs">Chairs</a></li>
                        <li class="<?php if(isset($_GET['category']) and $_GET['category']=='Beds'){echo 'active';}else{'';} ?>"><a href="/home?category=Beds">Beds</a></li>
                        <li class="<?php if(isset($_GET['category']) and $_GET['category']=='Tables'){echo 'active';}else{'';} ?>"><a href="/home?category=Tables">Tables</a></li>
                        <li class="<?php if(isset($_GET['category']) and $_GET['category']=='Accesories'){echo 'active';}else{'';} ?>"><a href="/home?category=Accesories">Accesories</a></li>
                        <li class="<?php if(isset($_GET['category']) and $_GET['category']=='Decor'){echo 'active';}else{'';} ?>"><a href="/home?category=Decor">Decor</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Header Area End -->


<?=$this->section('content')?>


    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix" style="width:100%">
        <div class="container">
            <div class="row align-items-center">
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="index.html"><img src="img/core-img/logo2.png" alt=""></a>
                        </div>
                        <!-- Copywrite Text -->
                        <p class="copywrite">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> & Re-distributed by <a href="https://themewagon.com/" target="_blank">Themewagon</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>

</body>
</html>