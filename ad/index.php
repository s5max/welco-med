<?php

	require('../include/connect.php');
	
	$select = $bdd->prepare('SELECT profession_id,offer_id,city_id FROM ad');

	if($select->execute()){

		$ads = $select->fetchAll(PDO::FETCH_ASSOC);
	
		$adNb = count($ads);
	$professionList = [];
	$offerList = [];
	$cityList = [];
		
	foreach($ads as $a){

		$professionList[]=$a['profession_id'];
		$offerList[]=$a['offer_id'];
		$cityList[]=$a['city_id'];

	}
	
	$professionList = array_unique($professionList);
	$offerList = array_unique($offerList);
	$cityList = array_unique($cityList);

	}

	$select = $bdd->prepare('SELECT * FROM profession');

	if($select->execute()){

		$professionAvailable = $select->fetchAll(PDO::FETCH_ASSOC);

	}

	$select = $bdd->prepare('SELECT * FROM offer');

	if($select->execute()){

		$offerAvailable = $select->fetchAll(PDO::FETCH_ASSOC);

		$offer = [];
		$demand = [];
		foreach($offerAvailable as $value){
			if($value['id']<5){
				$offer[] = [$value['id'],$value['type']];
			}
			elseif($value['id']>4){
				$demand[] = [$value['id'],$value['type']];
			}
		}
		
	}

	$select = $bdd->prepare('SELECT * FROM city');

	if($select->execute()){

		$cityAvailable = $select->fetchAll(PDO::FETCH_ASSOC);

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
        <link href="../css/bootstrap4.min.css" rel="stylesheet">

        <!-- Material Design Bootstrap -->
        <link href="../css/mdb.css" rel="stylesheet">

        <!-- Your custom styles (optional) -->
        <link href="../css/style.css" rel="stylesheet">

    </head>

    <body class="cyan-skin intro-page cafe-lp">

        <!--Navigation & Intro-->
        <header class="normalheader">

            <!--Navbar-->
            <nav class="navbar fixed-top navbar-toggleable-md navbar-dark scrolling-navbar">

                <div class="container">

                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span> 
                    </button>

                    <a class="navbar-brand" href="#">
                        <strong><img src="../img/logomin.png" class="welcologo"/></strong>
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
        <main>

            <!--First container-->
            <div class="container">

                <!--Section: Features v.4-->
                <section class="section mt-4 feature-box col-xs-12" id="features">

                    <!--Secion heading-->
                    <h1 class="text-center font-up font-bold mt-1 wow fadeIn" data-wow-delay="0.2s">&nbsp;</h1><br>

                    <!--Section description-->
                    <p class="text-center font-up font-bold mb-2 wow fadeIn" data-wow-delay="0.2s">Découvrez nos offres !</p>

                    <!-- Recherche -->
                    
                    <div class="row wow fadeIn" data-wow-delay="0.4s">
                        <form method="post" class="form-horizonthal col-xs-12" enctype="multipart/form-data">

                                <div class="form-group">
                                        <div class="col-sm-3">
                                            <select name="profession" id="profession" class="form-control">
                                                <option value="" selected disabled>-- Profession --</option>
                                                <!-- On réutilise notre array() ci-dessus -->
                                                <?php foreach ($specialityAvailable as $key => $value): ?>
                                                    <option value="<?=$key;?>"><?=$value;?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                            

                                        <div class="col-sm-3">
                                            <select name="type" id="type" class="form-control">
                                                <option value="" selected disabled>-- Type d'offre --</option>
                                                <!-- On réutilise notre array() ci-dessus -->
                                                <?php foreach ($specialityAvailable as $key => $value): ?>
                                                    <option value="<?=$key;?>"><?=$value;?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    

                                        <div class="col-sm-3">
                                        <select name="city" id="city" class="form-control">
                                            <option value="" selected disabled>-- Commune --</option>
                                            <!-- On réutilise notre array() ci-dessus -->
                                            <?php foreach ($specialityAvailable as $key => $value): ?>
                                                <option value="<?=$key;?>"><?=$value;?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        </div>
                                
                            
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary">Rechercher</button>
                                </div>
                            

                        </div>
                        
                    </form>
                    </div>

                </section>
                <!--/Section: Features v.4-->

                <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">

                <!--Section: Products-->

                

            </div>
            <!--/First container-->

            <!--Second container-->
            <div class="container">

                <!--Section: About-->
                <section class="section about mb-4" id="about"> 

                    <!--Secion heading-->
                    <h1 class="text-center font-up font-bold mt-1 wow fadeIn" data-wow-delay="0.2s">About us</h1>

                    <!--Section description-->
                    <p class="text-center font-up font-bold mb-4 wow fadeIn" data-wow-delay="0.2s">With love to nature</p>

                    <!--First row-->

                </section>
                <!--/Section: About-->

                <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">

                <!--Section: Testimonials v.3-->

            </div>
            <!--/Second container-->

        </main>
        <!--/Main content-->

        <!--Footer-->
        <footer class="page-footer footer-tiles center-on-small-only pt-4">

            <!--Footer Links-->
            <div class="container mb-4">

                <!--First row-->
                <div class="row">

                    <!--First column-->
                    <div class="col-xl-4 col-lg-4 pt-1 pb-1 wow fadeIn" data-wow-delay="0.3s">

                        <a class="btn btn-lg btn-rounded btn-primary" data-toggle="modal" data-target="#modal-reservation">Inscription</a>
                        
                        <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">

                        <!--About-->
                        <h5 class="title mb-1"><strong>A PROPOS DE NOUS</strong></h5>

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
                        <h5 class="title mb-2"><strong>Dernières recherches</strong></h5>

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
                    © 2017 Copyright: <a href="https://www.MDBootstrap.com" rel="nofollow"> MDBootstrap.com </a>
                </div>
            </div>
            <!--/Copyright-->

        </footer>
        <!--/Footer Links-->



        <!-- SCRIPTS -->

        <!-- JQuery -->
        <script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>

        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="../js/tether.min.js"></script>

        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="../js/bootstrap4.min.js"></script>

        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="../js/mdb.min.js"></script>

        <script>

            //Animation init
            new WOW().init();

            // Material Select Initialization
            $(document).ready(function() {
                $('.mdb-select').material_select();
            });

        </script>

    </body>

</html>