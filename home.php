﻿<?php

require_once __DIR__.'/autoload.php';
require_once __DIR__.'/Controllers/User.php';
require_once __DIR__.'/config/config.php';

use Inc\SessionManager;
//use Controllers\User;
use Inc\MessageDisplay;

if( ! isset($session) ) {
	session_start();
	$session = new \Inc\SessionManager($_SESSION); // create session instance
}

$cleanObject = new \Inc\Clean();

$tokenField = $cleanObject->get_token_field("blogcontact");

if( null !== $session->get('PHOTO')){
		  $photo = $session->get('PHOTO');
}else{
		 $photo = "undraw_profile.svg";
}
?>

<!DOCTYPE html>
<html lang="FR">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>création Blog PHP</title>
    <!-- Favicon-->
<link rel="icon" type="image/x-icon" href="public/assets/favicon.ico" />
<!-- Font Awesome icons (free version)-->
<script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
<!-- Bootstrap Icons-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
<!-- Google fonts-->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="public/startbootstrap-sb-admin-2-gh-pages/fontawesome-free/css/all.min.css" rel="stylesheet">
<!-- SimpleLightbox plugin CSS-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
<!-- Core theme CSS (includes Bootstrap)-->
<link href="public/css/styles.css" rel="stylesheet" />

<style> 
.date {
    font-size: 11px
}
	
.bg-gray{
    background-color: #fafafa !important;
}

.comment-text {
    font-size: 12px
}

.fs-12 {
    font-size: 12px
}
		
.shadow-none {
    box-shadow: none
}
	
.name {
    color: #007bff
}
	
.cursor:hover {
    color: blue
}
	
.cursor {
    cursor: pointer
}

.user_snippet_small_profile_image_rounded_geo{
    border-radius:100px;
    width:30px;
    height:30px;
    position:absolute;
    top:-15px;
}

.user_snippet_small_profile_image_rounded_geo:hover{
      box-shadow: 0px 0px 3px 1px #72bf3b;
}
</style>
</head>
<body id="page-top">
       
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light  bg-white fixed-top " id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="accueil.html"><IMG SRC="public/images/LOGO-BLOG.png" width="160" height="80" ALT=""></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto my-2 my-lg-0">
                <!--  <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="home.php">Accueil</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php?action=listposts&from=front">Blog</a></li> -->
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link  px-0 px-lg-3 rounded" href="accueil.html">Accueil</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link  px-0 px-lg-3 rounded" href="listposts-front-post.html#posts">Blog</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link  px-0 px-lg-3 rounded" href="accueil.html#contact">Contact</a></li>
                <!--  <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="home.php?#contact">Contact</a></li> -->
            </ul>
        </div>
		<!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>
                <?php
                // IF USER IS LOGGED USE THE APPROPRIATE ACTION AND CONTROLLER ACCORDING TO THE USER ROLE
                $user = new \Controllers\User();

                if($user->is_Logged()) {
                    

                    if($user->is_Admin()){

                        $useraction = "adminposts";
                        $controllername = "postadmin";
                    }elseif($user->is_Guest()){

                        $useraction = "mycomments";
                        $controllername = "commentadmin";
                    }
                ?>
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $cleanObject->escapeoutput(SessionManager::getInstance()->get('PSEUDO')) ?></span>
                        <img class="user_snippet_small_profile_image_rounded_geo mx-1"
                            src="uploads/images/<?= $cleanObject->escapeoutput($photo) ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="index.php?action=myprofile&controller=useradmin">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                    
                            <a class="dropdown-item" href="index.php?action=<?= $useraction ?>&from=dropdown&controller=<?= $controllername ?>">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Tableau de Bord
                        </a>
                        
                    
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Se Deconnecter
                        </a>
                    </div>
                </li>
                <?php
                }else{
                ?>
                <li class="nav-item dropdown no-arrow"><a class="nav-link py-3 px-0 px-lg-3 " href="loginview-user.html#login"><i class="fas fa-user-alt  mx-2 text-gray-400"></i>Se Connecter</a></li>
                <li class="nav-item dropdown no-arrow"><a class="nav-link py-3 px-0 px-lg-1 " href="signinview-user.html#inscription"><i class="fa fa-sign-in-alt mx-2 text-gray-400"></i></i><small>S'inscrire</small></a></li>
                
                <?php
                }
                ?>
            </div>  
        </ul>
    </div> 
</nav>
<!-- Masthead-->
<header class="masthead">
    <div class="container px-4 px-lg-1 h-100">
        <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end">
                <h1 class="text-white font-weight-bold">Fathi abderrahim</h1>
                <hr class="divider" />
            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="text-white-75 mb-5">Conception & Développement de Sites Web</p>
                <a class="btn btn-bluedev btn-xl" href="#about">En Savoir Plus</a>
            </div>
        </div>
    </div>
</header>

<!-- About Section-->
<section class="page-section bg-bluedev text-white mb-0" id="about">
    <div class="container">
        <!-- About Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-white mb-lg-3">Qui sommes nous</h2>
        
        <div class="row">
            <div class="col-lg-4 ms-auto">
                <p class="text-white">
                    Formé à la programmation et plus particulièrement au développement web, j'ai eu une première expérience, dans ce domaine, en tant que développeur web. D'abords, au sein d'une équipe au début des années deux milles, ensuite en tant que freelance. Parallèlement je mettais en place mon projet de vente d'objets de décoration issus de l'artisanat Marocain. Cette activité a fini par occuper pratiquement la totalité de ma vie active et a durée près de quinze ans au cours desquels j'ai acquis des Compétences certaines, d'<B>autonomie</B>, d'<B>organisation</B>, de <B>communication</B>, ainsi que des compétences en vente telle la <B>négociation</B>, la <B>fidélisation</B> et le <B>marketing</B>. 
                </p>
            </div>
            <div class="col-lg-4 me-auto">
                <p class="text-white">Forcé de mettre fin à cette activité, pour des raisons indépendantes 
                    de ma volonté, me voilà de nouveau pleinement disponible  pour pratiquer ma passion de développeur web. Les choses ayant beaucoup évoluées dans ce domaine, mon parcours passe obligatoirement par une formation qui me permettra non seuleument  d'actualiser mes connaissances mais d'en acquérir de nouvelles afin d'être plus compétitif sur le marché du travail.
                    C'est pourquoi je suis actuellement, auprès d'<B>OpenClassrooms</B>, une formation de <B>Développeur d'applications Php / Symfony</B>.
                </p>
            </div>
        </div>
        <!-- About Section Button-->
        <div class="text-center mt-4">
            <a class="btn btn-xl btn-outline-bluedev" data-bs-toggle="modal" data-bs-target="#cvmodal">
                <i class="fas fa-eye me-2"></i>
                Téléchargez mon CV
            </a>
        </div>
    </div>
</section>
<!-- Contact Section-->
<section class="page-section" id="contact">
    <div class="container-fluid">
        <!-- Contact Section Heading-->
        <div class="row justify-content-center">
            <div class="col-lg-8 "> 
                <div class="card shadow mb-4">
                    <div class="card-header py-2">
                        <h3 class=" text-capitalize  m-0 font-weight-bold text-info">Contactez moi</h3>
                    </div>
                    <!-- Contact Section Form-->
                
                    <?php

                    // CALL TO FUNCTION is_alertMessage() TO CHECK IF WE HAVE AN ALERT MESSAGE
                    $messageDisplay = new \Inc\MessageDisplay();
                    $message = $messageDisplay->is_alertMessage();

                    if (($message) && ($message != "")){

                        echo $message;

                        $session->sessionvarUnset('actionmessage');
                        $session->sessionvarUnset('alert_flag');
                        
                    }
                    
                    ?>
                    <!-- * * * * * * * * * * * * * * *-->
                    <!-- * * SB Forms Contact Form * *-->
                    <!-- * * * * * * * * * * * * * * *-->
                    <!-- This form is pre-integrated with SB Forms.-->
                    <!-- To make this form functional, sign up at-->
                    <!-- https://startbootstrap.com/solution/contact-forms-->
                    <!-- to get an API token!-->
    
                    <div class="card-body">
                        <div class="col-lg-10 "> 
                            <?php

                            if(null !== SessionManager::getInstance()->get('errors')){
                                ?>
                                <div class="alert  text-danger my-2 alert-dismissible fade show" role="alert">
                                    <em>
                                <?php
                                        
                                            foreach(SessionManager::getInstance()->get('errors') as $key=>$value){

                                                echo $value.'<BR>';
                                            }
                                            SessionManager::getInstance()->sessionvarUnset('errors');
                                    ?>
                                    </em>
                                    <button type="button" class="btn-close justify-content-end" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php	
                            }
                            ?>

                            <form action="index.php?action=contactform&controller=user" method="post" id="contactForm" data-sb-form-api-token="API_TOKEN">
                                <!-- Name input-->
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="name" type="text" name="name" placeholder="votre nom..."   pattern="^[A-Za-z '-]+$" required />
                                    <label for="name">Votre Nom</label>
                                    <div class="invalid-feedback" data-sb-feedback="name:required">Merci de saisir votre nom.</div>
                                </div>
                                <!-- Email address input-->
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="email" type="email" name="email" placeholder="name@exemple.com" required />
                                    <label for="email">Adresse Email</label>
                                    <div class="invalid-feedback" data-sb-feedback="email:required">Merci de saisir votre adresse email.</div>
                                    <div class="invalid-feedback" data-sb-feedback="email:email">votre adresse est invalide.</div>
                                </div>
                                <!-- Phone number input-->
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="subject" type="text" name="subject" placeholder="objet du mail" pattern="^[A-Za-zÀ-ÿ '-]+$" required />
                                    <label for="subject">Objet du mail</label>
                                    <div class="invalid-feedback" data-sb-feedback="subject:required">Merci de saisir votre numéro de téléphone.</div>
                                </div>
                                <!-- Message input-->
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="message" type="text" name="message" placeholder="Entrez votre Message..." style="height: 10rem" required></textarea>
                                    <label for="message">Message</label>
                                    <div class="invalid-feedback" data-sb-feedback="message:required">Merci de saisir votre message.</div>
                                </div>
                                <!-- Submit success message-->
                                <!-- This is what your users will see when the form-->
                                <!-- has successfully submitted-->
                                <div class="d-none" id="submitSuccessMessage">
                                    <div class="text-center mb-3">
                                        <div class="fw-bolder">Votre mail a été envoyé!</div>
                                        
                                    </div>
                                </div>
                                <!-- Submit error message-->
                                <!---->
                                <!-- This is what your users will see when there is-->
                                <!-- an error submitting the form-->
                                <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">message d'erreur!</div></div>
                                <?= $tokenField;?>
                                <!-- Submit Button-->
                                <button class="btn btn-bluedev" type="submit">Envoyez</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Footer-->
       
<!-- DEBUT cvmodal -->
<div id="cvmodal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-primary-mod" data-dismiss="modal">Fermer</button>
            </div>
            <div class="modal-body">
                <embed src="public/documents/CV-Fathi-Abderrahim2.pdf" frameborder="0" width="100%" height="500">
            </div>
        </div>
    </div>
</div>
<!-- FIN cvmodal -->
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">&Ecirc;tes vous s&ucirc;r ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Cliquer sur Se Déconnecter pour vous déconnecter</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                <a class="btn btn-primary" href="index.php?action=userlogout&controller=user">Se Déconnecter</a>
            </div>
        </div>
    </div>
</div>
<footer class="footer text-center">
    <div class="container">
        <div class="row">
            <!-- Footer Location-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Adresse</h4>
                <p class="lead mb-0">
                    78 rue de la Jonquière
                    <br />
                    75017 Paris
                </p>
            </div>
            <!-- Footer Social Icons-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4"> Réseaux Sociaux</h4>
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-github"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a>
            </div>
            <!-- Footer About Text-->
            <div class="col-lg-4">
                <nav class="navbar navbar-expand-lg navbar-light   " id="mainNav">
                    <li class="nav-item "><a class="nav-link py-3 px-0 px-lg-3 " href="loginview-user.html#login"><i class="fas fa-user-alt  mx-2 text-gray-400"></i>Se Connecter</a></li>
                    <li class="nav-item "><a class="nav-link py-3 px-0 px-lg-1 " href="signinview-user.html#inscription"><i class="fa fa-sign-in-alt mx-2 text-gray-400"></i></i><small>S'inscrire</small></a></li>
                </nav>
            </div>
        </div>
    </div>
</footer> 
<!-- Copyright Section-->
<div class="copyright text-center text-white">
    <div class="container"><small>Copyright &copy; CAPDEV 2022</small></div>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<!-- * *                               SB Forms JS                               * *-->
<!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

<!-- TEMPLATE ADMIN -->
<!-- Bootstrap core JavaScript-->
<script src="public/startbootstrap-sb-admin-2-gh-pages/vendor/jquery/jquery.min.js"></script>
<script src="public/startbootstrap-sb-admin-2-gh-pages/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="public/startbootstrap-sb-admin-2-gh-pages/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="public/startbootstrap-sb-admin-2-gh-pages/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="public/startbootstrap-sb-admin-2-gh-pages/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="public/startbootstrap-sb-admin-2-gh-pages/js/demo/chart-area-demo.js"></script>
<script src="public/startbootstrap-sb-admin-2-gh-pages/js/demo/chart-pie-demo.js"></script>
</body>
</html>
