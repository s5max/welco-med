<?php
    require('include/connect.php');
    require('include/header.php');

    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){

        $idUser = (int) $_SESSION['id'];

        // Jointure SQL permettant de récupérer la recette & le prénom & nom de l'utilisateur l'ayant publié
        $selectOne = $bdd->prepare('SELECT u.* FROM user AS u WHERE id = :id');
        $selectOne->bindValue(':id', $idUser, PDO::PARAM_INT);
        if($selectOne->execute()){
            $user = $selectOne->fetch(PDO::FETCH_ASSOC);
        }
        else {
            // Erreur de développement
            var_dump($selectOne->errorInfo());
            die; // alias de exit(); => die('Hello world');
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
                    <h1 class="text-center font-up font-bold mt-1 wow fadeIn" data-wow-delay="0.2s">WELCOMED</h1><br>

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
                            <h1 class="title normaltitle">Mon Compte</h1>
                                <div class="col-sm-12">
                                    <div class="row wow fadeIn" data-wow-delay="0.4s">
                                        <div class="col-sm-6">
                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Utilisateur :</h4>
                                                </li>
                                            </ol>
                                            <h2><?php echo $user['lastname'].' '.$user['firstname']; ?></h2>

                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Spécialité :</h4>
                                                </li>
                                            </ol>
                                            <h2><?php echo $user['profession']; ?></h2>

                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Téléphone :</h4>
                                                </li>
                                            </ol>
                                            <h2><?php echo $user['telephone']; ?></h2>
                                            
                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Email :</h4>
                                                </li>
                                            </ol>
                                            <h2><?php echo $user['email']; ?></h2>
                                        </div>
                                        <div class="col-sm-6">
                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Adresse :</h4>
                                                </li>
                                            </ol>
                                            <h2><?php echo $user['address']; ?></h2>
                                            
                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Ville :</h4>
                                                </li>
                                            </ol>
                                            <h2><?php echo $user['city']; ?></h2>
                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Code Postal :</h4>
                                                </li>
                                            </ol>
                                            <h2><?php echo $user['zipcode'].' '.$user['department']; ?></h2>
                                        </div>
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