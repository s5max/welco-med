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
            $contactRequest = $bdd->prepare('INSERT INTO messages (lastname, firstname, email, object, message) VALUES(:lastname, :firstname, :email, :object, :message)');
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

        <?php include 'include/head.php'; ?>

        <!--Main content-->
        <main class=" normalsection">

            <!--First container-->
            <div class="container normalsection">

                <!--Section: Features v.4-->
                <section class="section mt-4 feature-box col-xs-12 normalsection" id="features">

                    <!--Secion heading-->
                    <h1 class="text-center font-up font-bold mt-1 wow fadeIn" data-wow-delay="0.2s">Contactez-nous !</h1><br>

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
                                        <div class="col-sm-6"><p style="color:green"><?php echo $success; ?></p></div>

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

        <?php include 'include/footer.php'; ?>

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