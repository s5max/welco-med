<?php

    require('include/connect.php');
    require('include/header.php');
    $contact =[]; // Contiendra les données du formulaire nettoyées
    $errors =[]; // Contiendra les éventuelles erreurs
    $display = true;
    $password = '';

    if(!empty($_POST)){

        foreach($_POST as $key => $value){
            $contact[$key] = trim(strip_tags($value));
        }

        if(strlen($contact['lastname']) < 2){
            $errors[] = 'Veuillez saisir votre nom !';
        }

        if(strlen($contact['firstname']) < 3){
            $errors[] = 'Veuillez saisir votre prénom !';
        }

        if(!filter_var($contact['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Veuillez saisir votre adresse email !';
        }

        if(strlen($contact['object']) < 2){
            $errors[] = 'Quel est le sujet de votre demande ?';
        }

        if(strlen($contact['message']) < 20 || strlen($contact['message']) > 150){
            $errors[] = 'Veuillez saisir un message compris entre 20 et 150 caractères !';
        }


        if(count($errors) === 0){

            // Ajout d'une ligne dans contact
            $contactRequest = $bdd->prepare('INSERT INTO contact (lastname, firstname, email, object, message) VALUES(:lastname, :firstname, :email, :object, :message)');
            $contactRequest->bindValue(':lastname', $contact['lastname']);
            $contactRequest->bindValue(':firstname', $contact['firstname']);
            $contactRequest->bindValue(':email', $contact['email']);
            $contactRequest->bindValue(':object', $contact['object']);
            $contactRequest->bindValue(':message', $contact['message']);


            if($contactRequest->execute()){
                $success = 'Votre message a été envoyé !';
                $display = false;
            }
            else {
                die;
            }
        }
        else {
            $errorsText = implode('<br>', $errors);
        }
    }

?>
<!DOCTYPE html>
<html lang="en" class="full-height">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>WelcoMed</title>

        <!-- Meta OG -->
        <meta property="og:title" content="Material Design Organic Cafe Landing Page">
        <meta property="og:description" content="Perfect for projects that have something in common with cafe's and restaurants.">
        <meta property="og:image" content="https://mdbootstrap.com/img/Live/MDB/13.03/cafe-fb.jpg">
        <meta property="og:url" content="https://mdbootstrap.com/live/_MDB/templates/Landing-Page/organic-cafe-landing-page.html">
        <meta property="og:site_name" content="mdbootstrap.com">
        <!-- /Meta OG -->

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:description" content="Perfect for projects that have something in common with cafe's and restaurants." />
        <meta name="twitter:title" content="Material Design Organic Cafe Landing Page" />
        <meta name="twitter:site" content="@MDBootstrap" />
        <meta name="twitter:image" content="https://mdbootstrap.com/img/Live/MDB/13.03/cafe-fb.jpg" />
        <meta name="twitter:creator" content="@MDBootstrap" />
        <!-- /Twitter Card -->    

        <!-- Police Roboto -->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

        <!-- Bootstrap core CSS -->
        <!-- <link href="css/bootstrap337.css" rel="stylesheet"> -->
        <link href='css/bootstrap.css' rel='stylesheet' />
        <link href="css/bootstrap4.min.css" rel="stylesheet"/>
        <link href='css/rotating.css' rel='stylesheet' />
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet"/>

        <!-- Material Design Bootstrap -->
        <link href="css/mdb.css" rel="stylesheet">

        <!-- Your custom styles (optional) -->
        <link href="css/style.css" rel="stylesheet">

    </head>

    <body class="cyan-skin intro-page cafe-lp">

        <!--Navigation & Intro-->
        <header class="normalheader">

            <!--Navbar-->
            <nav class="navbar fixed-top navbar-toggleable-md navbar-dark" id="normalnav">

                <div class="container">

                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span> 
                    </button>

                    <a class="navbar-brand" href="#">
                        <strong><img src="img/logomin.png" class="normallogo"/></strong>
                    </a>

                    <div class="collapse navbar-collapse" id="navbarNav">

                        <!--Links-->
                        <ul class="navbar-nav mr-auto smooth-scroll">
                            <li class="nav-item">
                                <a class="nav-link" href="#home">Accueil <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#features">Voir les offres</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#about" data-offset="100">Contactez-nous</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#products" data-offset="100">Publier une annonce</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#testimonials" data-offset="100">Mon Compte</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link wcomlink" href="#contact" data-target="#modal-contact">Welcomed Community</a>
                            </li>
                        </ul>

                        <!--Social Icons-->
                        <ul class="navbar-nav nav-flex-icons">
                            <li class="nav-item">
                                <a class="nav-link"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"><i class="fa fa-instagram"></i></a>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
            <!--/Navbar-->

            <!--Modal Reservation-->
            <div class="modal fade modal-ext" id="modal-reservation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <!--Content-->
                    <div class="modal-content">
                        <!--Header-->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title w-100">Resrervation Form</h4>
                        </div>
                        <!--Body-->
                        <div class="modal-body">
                            <div class="md-form">
                                <input type="text" id="form22" class="form-control">
                                <label for="form42">Your Full Name</label>
                            </div>

                            <div class="md-form">
                                <input type="text" id="form32" class="form-control">
                                <label for="form34">Your Email</label>
                            </div>

                            <div class="md-form">
                                <input type="text" id="form32" class="form-control">
                                <label for="form34">Your Phone Number</label>
                            </div>

                            <select class="mdb-select colorful-select dropdown-default">
                                <option value="1">One Person</option>
                                <option value="2">Two Persons</option>
                                <option value="3">Three Persons</option>
                                <option value="4">More</option>
                            </select>

                            <div class="text-center">
                                <button class="btn btn-lg btn-rounded btn-primary">Send Information</button>
                                <p class="text-muted">*Some dummy text goes here.</p>

                                <div class="call">
                                    <p>Or you prefer book a table by phone? <span class="cf-phone"><i class="fa fa-phone"></i>+01 234 565 280</span></p>
                                </div>
                            </div>
                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!--/Content-->
                </div>
            </div>
            <!--/Modal Reservation-->

        </header>
        <!--/Navigation & Intro-->

        <!--Main content-->
        <main class=" normalsection">

            <!--First container-->
            <div class="container normalsection">

                <!--Section: Features v.4-->
                <section class="section mt-4 feature-box col-xs-12 normalsection" id="features">

                    <!--Secion heading-->
                    <h1 class="text-center font-up font-bold mt-1 wow fadeIn" data-wow-delay="0.2s">Contactez nous !</h1><br>

                    <!-- Recherche -->

                </section>
                <!--/Section: Features v.4-->

                <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">

                <!--Section: Products-->

                

            </div>
            <!--/First container-->

            <!--Second container-->
            <div class="container-full whitesection">
                <div class="container">

                    <!--Section: About-->
                    <section class="section about mb-4" id="about"> 

                        <div class="row">
                            <h1 class="title normaltitle">WELCOMED</h1>
                                <div class="col-sm-12">
                                    <div class="row wow fadeIn" data-wow-delay="0.4s">
                                        <div class="col-sm-6">
                                        <p>Pour tout renseignement ou demande de contact, veuillez remplir ce formulaire. Nous vous répondrons dans les plus brefs délais.</p>

                                        <?php if(isset($success)): // La variable $success n'existe que lorsque tout est ok ?>
                                        <div class="col-sm-6"><p style="color:green"><?php echo $success; ?></p>

                                            <p style="color:white"><strong>Infos saisies :</strong></p>
                                            <ul>
                                                <?php 
                                                foreach($user as $key => $value){
                                                    if($key == 'lastname'){
                                                        echo '<li><i class="glyphicon glyphicon-user" aria-hidden="true"></i> '.strtoupper($value);
                                                    }
                                                    elseif($key == 'firstname'){
                                                        echo ' '.ucwords($value).'</li>';
                                                    }
                                                    elseif($key == 'email'){
                                                        echo '<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i> '.$value.'</li>';
                                                    }
                                                    elseif($key == 'phone'){
                                                        echo '<li><i class="glyphicon glyphicon-phone-alt" aria-hidden="true"></i> '.$value.'</li>';
                                                    }
                                                    elseif($key == 'address'){
                                                        echo '<li><i class="glyphicon glyphicon-home" aria-hidden="true"></i> '.$value.'</li>';
                                                    }
                                                    elseif($key == 'zipcode'){
                                                        echo '<li><i class="glyphicon glyphicon-info-sign" aria-hidden="true"></i> '.$value.'</li>';
                                                    }
                                                    elseif($key == 'city'){
                                                        echo '<li><i class="glyphicon glyphicon-globe" aria-hidden="true"></i> '.$value.'</li>';
                                                    }
                                                }
                                                ?>
                                            </ul></div>

                                        <?php endif; ?> 


                                        <?php if(isset($errorsText)): // La variable $errorsText n'existe que lorsqu'il y a des erreurs ?>
                                        <p style="color:red"><?php echo $errorsText; ?></p>
                                        <?php endif; ?>


                                        <?php
                                        if ($display == false){

                                        } else {

                                        ?>
                                            <form method="post" class="form-horizonthal" enctype="multipart/form-data">

                                                <div class="form-group">
                                                    <div class="col-sm-6">
                                                        <input name="lastname" required class="form-control" type="text" placeholder="Saisissez votre Nom">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input name="firstname" required class="form-control" type="text" placeholder="Saisissez votre Prénom">
                                                    </div>
                                                </div>

                                                <!-- Email -->
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input name="email" required class="form-control" type="email" placeholder="Saisissez votre Email">
                                                    </div>
                                                </div> 
                                                <!-- /.Email -->

                                                <!-- Sujet -->
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input name="object" required class="form-control" type="text" placeholder="Saisissez votre Sujet">
                                                    </div>
                                                </div>

                                                <!-- Message -->
                                                <div class="form-group">
                                                    <div class="col-xs-12">
                                                        <textarea id="message" name="message" rows="5" placeholder="Saisissez votre message" class="form-control"></textarea>           
                                                    </div>
                                                </div>
                                                    
                                                <div class="text-center">
                                                    <div class="col-sm-12">
                                                        <button type="submit" class="btn btn-primary">Envoyer votre message</button>
                                                    </div>
                                                </div>
                                            </form>

                                        <?php 
                                            }
                                        ?>
                                    </div>

                                    <iframe class="col-sm-6" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15442.480820502418!2d-61.0343062!3d14.6206985!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4905ada70da911c0!2sPiment+Sucr%C3%A9!5e0!3m2!1sfr!2s!4v1496434529644" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                            </div>

                    </section>
                    <!--/Section: About-->

                <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">

                <!--Section: Testimonials v.3-->

            </div>
            <!--/Second container-->

        </main>
        <!--/Main content-->

        <!--Footer-->
        <footer class="page-footer footer-tiles center-on-small-only pt-4 normalfooter">

            <!--Footer Links-->
            <div class="container mb-4">

                <!--First row-->
                <div class="row">

                    <!--First column-->
                    <div class="col-xl-4 col-lg-4 pt-1 pb-1 wow fadeIn" data-wow-delay="0.3s">

                        <a class="btn btn-lg btn-rounded btn-primary" data-toggle="modal" data-target="#modal-reservation">Inscription</a>
                        
                        <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">

                        <!--About-->
                        <h5 class="title mb-1 normaltitlefoot"><strong>A PROPOS DE NOUS</strong></h5>

                        <p>A remplir !</p>

                        <p class="mb-1-half"> A remplir !</p>
                        <!--/About -->

                    
                    </div>
                    <!--/First column-->

                    <hr class="w-100 hidden-lg-up">

                    <!--Second column-->
                    <div class="col-xl-3 offset-xl-1 col-lg-4 col-md-6 pt-1 pb-1 wow fadeIn" data-wow-delay="0.3s">

                        <div class="footer-socials">

                            <!--Facebook-->
                            <a type="button" class="btn-floating btn-small btn-primary"><i class="fa fa-facebook"></i></a>
                            <!--Twitter-->
                            <a type="button" class="btn-floating btn-small btn-primary"><i class="fa fa-twitter"></i></a>
                            <!--Google +-->
                            <a type="button" class="btn-floating btn-small btn-primary"><i class="fa fa-google-plus"></i></a>

                        </div>
                        <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">
                        <!--Info-->
                        <p><i class="fa fa-home mr-3"></i> New York, NY 10012, US</p>
                        <p><i class="fa fa-envelope mr-3"></i> info@example.com</p>
                        <p><i class="fa fa-phone mr-3"></i> + 01 234 567 88</p>
                        <p><i class="fa fa-print mr-3"></i> + 01 234 567 89</p>

                    </div>
                    <!--/Second column-->

                    <hr class="w-100 hidden-md-up">

                    <!--First column-->
                    <div class="col-xl-3 offset-xl-1 col-lg-4 col-md-6 t-1 pb-1 wow fadeIn" data-wow-delay="0.3s">

                        <!--Title-->
                        <h5 class="title mb-2 normaltitlefoot"><strong>Dernières recherches</strong></h5>

                        <!--Opening hours table-->
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Médecins</td>
                                </tr>
                                <tr>
                                    <td>Chirurgiens-dentistes</td>
                                </tr>
                                <tr>
                                    <td>Orthophonistes</td>
                                </tr>
                            </tbody>
                        </table>
                        

                    </div>
                    <!--/First column-->

                </div>
                <!--/First row-->

            </div>
            <!--/Footer Links-->

            <!--Copyright-->
            <div class="footer-copyright wow fadeIn" data-wow-delay="0.3s">
                <div class="container-fluid">
                    <p>© 2017 Copyright: Welcomed</p>
                </div>
            </div>
            <!--/Copyright-->

        </footer>
        <!--/Footer Links-->



        <!-- SCRIPTS -->

        <!-- JQuery -->
        <script src="js/jquery-1.10.2.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="js/tether.min.js"></script>

        <!-- Bootstrap core JavaScript -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/bootstrap4.min.js"></script>

        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="js/mdb.min.js"></script>

        <script>

            //Animation init
            new WOW().init();

            // Material Select Initialization
            $(document).ready(function() {
                $('.mdb-select').material_select();
            });

        </script>


<script type="text/javascript">
    $().ready(function(){
        $('[rel="tooltip"]').tooltip();

    });

    function rotateCard(btn){
        var $card = $(btn).closest('.card-container');
        console.log($card);
        if($card.hasClass('hover')){
            $card.removeClass('hover');
        } else {
            $card.addClass('hover');
        }
    }
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46172202-4', 'auto');
  ga('send', 'pageview');

</script>

    </body>

</html>