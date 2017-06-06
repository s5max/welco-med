<?php

	require('include/connect.php');
	
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
        <link href="css/bootstrap4.min.css" rel="stylesheet">

        <!-- Material Design Bootstrap -->
        <link href="css/mdb.css" rel="stylesheet">

        <!-- Your custom styles (optional) -->
        <link href="css/style.css" rel="stylesheet">

    </head>

    <body class="cyan-skin intro-page cafe-lp">

        <!--Navigation & Intro-->
        <header>

            <!--Navbar-->
            <nav class="navbar fixed-top navbar-toggleable-md navbar-dark scrolling-navbar">

                <div class="container">

                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span> 
                    </button>

                    <a class="navbar-brand" href="#">
                        <strong><img src="img/logomin.png" class="welcologo"/></strong>
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

            <!--Mask-->
            <div class="view intro" id="home">
                <div class="hm-black-strong-1">
                    <div class="full-bg-img flex-center">
                        <div class="container">
                            <div class="row smooth-scroll">
                                <div class="col-md-12 text-center pt-3 wow fadeIn" data-wow-delay="0.2s">
                                    <h1 class="white-text brand-name font-up font-bold hwelcomed">Welcomed</h1>
                                    <div class="row">
                                        <div class="col-md-12 div-color">
                                            <div class="divider-new div-blue">
                                                <i class="fa fa-heartbeat fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class="font-up white-text mb-2 hwelcomed">Une expérience libérale sous le Soleil de Martinique</h2>
                                    <a href="#features" class="btn bienvenue" data-offset="100">Bienvenue</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                            <h4 class="modal-title w-100">Formulaire d'inscription</h4>
                        </div>
                        <!--Body-->
                        <div class="modal-body" id="modal-content">
							
                       		<form id="subscribe" method="post" enctype="multipart/form-data">
								
								<select class="mdb-select colorful-select dropdown-default" name="profession1" id="profession1">
								<option value="none">--- Choisir votre proffession ---</option>
								<?php foreach($professionAvailable as $value){ echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';} ?>
								</select>
								
								<div class="md-form">
									<input type="text" name="firstname" id="firstname" class="form-control">
									<label for="firstname">Votre Nom</label>
								</div>

								<div class="md-form">
									<input type="text" name="lastname" id="lastname" class="form-control">
									<label for="lastname">Votre Prénom</label>
								</div>

								<div class="md-form">
									<input type="text" name="address" id="address" class="form-control">
									<label for="address">Adresse</label>
								</div>

								<div class="md-form">
									<input type="text" name="zipcode" id="zipcode" class="form-control">
									<label for="zipcode">Code Postal</label>
								</div>

								<div class="md-form">
									<input type="text" name="city1" id="city1" class="form-control">
									<label for="city1">Ville</label>
								</div>

								<div class="md-form">
									<input type="text" name="department" id="department" class="form-control">
									<label for="department">Département</label>
								</div>

								<div class="md-form">
									<input type="text" name="telephone" id="telephone" class="form-control">
									<label for="telephone">Téléphone</label>
								</div>

								<div class="md-form">
									<input type="text" name="email" id="email" class="form-control">
									<label for="email">Email</label>
								</div>

								<div class="md-form">
									<input type="password" name="password" id="password" class="form-control">
									<label for="password">Mot de Passe</label>
								</div>

								<div class="text-center">
									<button class="btn btn-lg btn-rounded btn-primary" id="sbt">S'inscrire</button>
							<!--                                <p class="text-muted">*Some dummy text goes here.</p>-->
								</div>
							</form>
                       
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
                    <h1 class="text-center font-up font-bold mt-1 wow fadeIn" data-wow-delay="0.2s">Vivez votre passion au soleil !</h1><br>

                    <!--Section description-->
                    <p class="text-center font-up font-bold mb-2 wow fadeIn" data-wow-delay="0.2s">Rechercher parmi nos <?=$adNb.' annonces en cours de validité'?></p>

                    <!-- Recherche -->
                    
                    <div class="row wow fadeIn" data-wow-delay="0.4s">
                        <form method="post" class="form-horizonthal col-xs-12" enctype="multipart/form-data">

                                <div class="form-group">
                                        <div class="col-sm-4">
                                            <select name="profession" id="profession" class="form-control">
                                                <option value="0" selected disabled>-- Profession --</option>
                                                <!-- On réutilise notre array() ci-dessus -->
                                                <?php foreach ($professionAvailable as $value): 
														if(in_array($value['id'],$professionList)){
												?>
                                                    <option value="<?=$value['id'];?>"><?=$value['name'];?></option>
                                                <?php 	}
													   endforeach; 
												?>
                                            </select>
                                        </div>
                                            

                                        <div class="col-sm-4">
                                            <select name="type" id="type" class="form-control">
                                                <option value="0" selected disabled>-- Type d'annonce --</option>
                                                <!-- On réutilise notre array() ci-dessus -->
                                                <optgroup label="Offre">
                                                <?php foreach($offer as $value){if(in_array($value[0],$offerList)){echo'<option value="'.$value[0].'">'.$value[1].'</option>';}} ?>
                                                <optgroup label="Demande">
                                                <?php foreach($offer as $value){if(in_array($value[0],$offerList)){echo'<option value="'.$value[0].'">'.$value[1].'</option>';}} ?>
                                            </select>
                                        </div>
                                    

                                        <div class="col-sm-4">
											<select name="city" id="city" class="form-control">
												<option value="0" selected disabled>-- Commune --</option>
												<!-- On réutilise notre array() ci-dessus -->
												<?php foreach ($cityAvailable as $key => $value): 
														if(in_array($value['id'],$cityList)){
												?>
													<option value="<?=$value['id'];?>"><?=$value['name'];?></option>
												<?php	}
															endforeach; 
												?>
											</select>
                                        </div>
                                
                            
                            

                        </div>
                            <div class="text-center">
                               <p id="nbAd"></p>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Rechercher</button>
                                </div>
                            </div>
                        
                    </form>
                    </div>

                </section>
                <!--/Section: Features v.4-->

                <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">

                <!--Section: Products-->
                <section class="section" id="products">

                    <!--Secion heading-->
                    <!-- <h1 class="text-center font-up font-bold mt-5 wow fadeIn" data-wow-delay="0.2s">&nbsp; </h1> -->

                    <!--Section description-->
                    <p class="text-center font-up font-bold mb-4 wow fadeIn" data-wow-delay="0.2s">&nbsp; </p>

                    <!--First row-->
                    <div class="row text-center">

                        <!--First column-->
                        <div class="col-lg-4 col-md-12 mb-r wow fadeIn" data-wow-delay="0.4s">

                            <!--Card-->
                            <div class="card card-cascade wider">

                                <!--Card image-->
                                <div class="view overlay hm-white-slight">
                                    <img src="img/pic-doc.jpg" class="img-fluid">
                                    <a href="#!">
                                        <div class="mask"></div>
                                    </a>
                                </div>
                                <!--/Card image-->

                                <!--Card content-->
                                <div class="card-block text-center">
                                    <!--Title-->
                                    <h4 class="card-title"><strong>Médecins</strong></h4>

                                </div>
                                <!--/.Card content-->

                            </div>
                            <!--/.Card-->


                        </div>
                        <!--/First column-->

                        <!--First column-->
                        <div class="col-lg-4 col-md-6 mb-r wow fadeIn" data-wow-delay="0.4s">

                            <!--Card-->
                            <div class="card card-cascade wider">

                                <!--Card image-->
                                <div class="view overlay hm-white-slight">
                                    <img src="img/pic-kiné.jpg" class="img-fluid">
                                    <a href="#!">
                                        <div class="mask"></div>
                                    </a>
                                </div>
                                <!--/Card image-->

                                <!--Card content-->
                                <div class="card-block text-center">
                                    <!--Title-->
                                    <h4 class="card-title"><strong>Kinésithérapeutes</strong></h4>

                                </div>
                                <!--/.Card content-->

                            </div>
                            <!--/.Card-->


                        </div>
                        <!--/First column-->

                        <!--First column-->
                        <div class="col-lg-4 col-md-6 mb-r wow fadeIn" data-wow-delay="0.4s">

                            <!--Card-->
                            <div class="card card-cascade wider">

                                <!--Card image-->
                                <div class="view overlay hm-white-slight">
                                    <img src="img/pic-nurse.jpg" class="img-fluid">
                                    <a href="#!">
                                        <div class="mask"></div>
                                    </a>
                                </div>
                                <!--/Card image-->

                                <!--Card content-->
                                <div class="card-block text-center">
                                    <!--Title-->
                                    <h4 class="card-title"><strong>Infirmiers / ères</strong></h4>

                                </div>
                                <!--/.Card content-->

                            </div>
                            <!--/.Card-->


                        </div>
                        <!--/First column-->

                    </div>
                    <!--/First row-->

                    <!--First row-->
                    <div class="row text-center">

                        <!--First column-->
                        <div class="col-lg-4 col-md-12 mb-r wow fadeIn" data-wow-delay="0.4s">

                            <!--Card-->
                            <div class="card card-cascade wider">

                                <!--Card image-->
                                <div class="view overlay hm-white-slight">
                                    <img src="img/pic-ortho.jpg" class="img-fluid">
                                    <a href="#!">
                                        <div class="mask"></div>
                                    </a>
                                </div>
                                <!--/Card image-->

                                <!--Card content-->
                                <div class="card-block text-center">
                                    <!--Title-->
                                    <h4 class="card-title"><strong>Orthophonistes</strong></h4>

                                </div>
                                <!--/.Card content-->

                            </div>
                            <!--/.Card-->


                        </div>
                        <!--/First column-->

                        <!--First column-->
                        <div class="col-lg-4 col-md-6 mb-r wow fadeIn" data-wow-delay="0.4s">

                            <!--Card-->
                            <div class="card card-cascade wider">

                                <!--Card image-->
                                <div class="view overlay hm-white-slight">
                                    <img src="img/pic-pedi.jpg" class="img-fluid">
                                    <a href="#!">
                                        <div class="mask"></div>
                                    </a>
                                </div>
                                <!--/Card image-->

                                <!--Card content-->
                                <div class="card-block text-center">
                                    <!--Title-->
                                    <h4 class="card-title"><strong>Pédiatres</strong></h4>

                                </div>
                                <!--/.Card content-->

                            </div>
                            <!--/.Card-->


                        </div>
                        <!--/First column-->

                        <!--First column-->
                        <div class="col-lg-4 col-md-6 mb-r wow fadeIn" data-wow-delay="0.4s">

                            <!--Card-->
                            <div class="card card-cascade wider">

                                <!--Card image-->
                                <div class="view overlay hm-white-slight">
                                    <img src="img/pic-dentist.png" class="img-fluid">
                                    <a href="#!">
                                        <div class="mask"></div>
                                    </a>
                                </div>
                                <!--/Card image-->

                                <!--Card content-->
                                <div class="card-block text-center">
                                    <!--Title-->
                                    <h4 class="card-title"><strong>Chirurgiens-dentistes</strong></h4>

                                </div>
                                <!--/.Card content-->

                            </div>
                            <!--/.Card-->


                        </div>
                        <!--/First column-->

                    </div>
                    <!--/First row-->

                </section>
                <!--Section: Products-->
                

            </div>
            <!--/First container-->

            <!--Streak-->
            <div class="streak streak-photo streak-large view photo-1 hr-streak" id="home">
                <div class="hm-black-strong-1">
                    <div class="mask flex-center">
                        <div class="container">
                            <!--First row-->
                            <div class="row text-white flex-center text-center mt-1 wow fadeIn" data-wow-delay="0.4s">
                                <h1 class="brand-name font-up">Eat better - feel better</h1>
                                <hr class="hr-light w-100">
                                <h2 class="font-up pt-1"><strong>We make healty coffee and food</strong></h2>
                            </div>
                            <!--/First row-->
                        </div>
                    </div>
                </div>
            </div>
            <!--/Streak-->

            <!--Second container-->
            <div class="container">

                <!--Section: About-->
                <section class="section about mb-4" id="about"> 

                    <!--Secion heading-->
                    <h1 class="text-center font-up font-bold mt-1 wow fadeIn" data-wow-delay="0.2s">About us</h1>

                    <!--Section description-->
                    <p class="text-center font-up font-bold mb-4 wow fadeIn" data-wow-delay="0.2s">With love to nature</p>

                    <!--First row-->
                    <div class="row">

                        <!--First column column-->
                        <div class="col-xl-5 col-lg-6 pb-1 wow fadeIn" data-wow-delay="0.4s">

                            <!--Description-->
                            <p align="justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo animi soluta ratione quisquam, dicta ab cupiditate iure eaque? Repellendus voluptatum, magni impedit eaque animi maxime.</p>

                            <p align="justify">Nemo animi soluta ratione quisquam, dicta ab cupiditate iure eaque? Repellendus voluptatum, magni impedit eaque delectus, beatae maxime temporibus maiores quibusdam quasi rem magnam ad perferendis iusto sint tempora.</p>

                            <ul>
                                <li>Nemo animi soluta ratione</li>
                                <li>Beatae maxime temporibus</li>
                                <li>Consectetur adipisicing elit</li>
                            </ul>

                        </div>
                        <!--/First column-->

                        <!--Column column-->
                        <div class="col-xl-5 offset-xl-1 col-lg-6 wow fadeIn" data-wow-delay="0.4s">

                            <!--Image-->
                            <img src="https://mdbootstrap.com/img/Photos/Horizontal/Food/4-col/img%20%2856%29.jpg" class="img-fluid" alt="My photo">

                        </div>
                        <!--/Column column-->

                    </div>
                    <!--/First row-->

                </section>
                <!--/Section: About-->

                <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">

                <!--Section: Testimonials v.3-->
                <section class="section team-section" id="testimonials">

                    <!--Secion heading-->
                    <h1 class="text-center font-up font-bold mt-1 wow fadeIn" data-wow-delay="0.2s">Testimonials</h1>

                    <!--Section description-->
                    <p class="text-center font-up font-bold mb-4 wow fadeIn" data-wow-delay="0.2s">What happy customers say</p>

                    <!--First row-->
                    <div class="row text-center">

                        <!--First column-->
                        <div class="col-md-4 mb-r wow fadeIn" data-wow-delay="0.4s">

                            <div class="testimonial">
                                <!--Avatar-->
                                <div class="avatar">
                                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(20).jpg" class="rounded-circle img-fluid">
                                </div>

                                <!--Content-->
                                <h4>Anna Deynah</h4>
                                <p><i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic tenetur quae quaerat ad velit ab.</p>

                                <!--Review-->
                                <div class="grey-text">
                                    <i class="fa fa-star"> </i>
                                    <i class="fa fa-star"> </i>
                                    <i class="fa fa-star"> </i>
                                    <i class="fa fa-star"> </i>
                                    <i class="fa fa-star-half-full"> </i>
                                </div>
                            </div>
                        </div>
                        <!--/First column-->

                        <!--Second column-->
                        <div class="col-md-4 mb-r wow fadeIn" data-wow-delay="0.4s">
                            <div class="testimonial">
                                <!--Avatar-->
                                <div class="avatar">
                                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(9).jpg" class="rounded-circle img-fluid">
                                </div>

                                <!--Content-->
                                <h4>John Doe</h4>
                                <p><i class="fa fa-quote-left"></i> Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi.</p>

                                <!--Review-->
                                <div class="grey-text">
                                    <i class="fa fa-star"> </i>
                                    <i class="fa fa-star"> </i>
                                    <i class="fa fa-star"> </i>
                                    <i class="fa fa-star"> </i>
                                    <i class="fa fa-star"> </i>
                                </div>
                            </div>
                        </div>
                        <!--/Second column-->

                        <!--Third column-->
                        <div class="col-md-4 mb-r wow fadeIn" data-wow-delay="0.4s">
                            <div class="testimonial">
                                <!--Avatar-->
                                <div class="avatar">
                                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(19).jpg" class="rounded-circle img-fluid">
                                </div>
                                <!--Content-->
                                <h4>Maria Kate</h4>
                                <p><i class="fa fa-quote-left"></i> At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti.</p>

                                <!--Review-->
                                <div class="grey-text">
                                    <i class="fa fa-star"> </i>
                                    <i class="fa fa-star"> </i>
                                    <i class="fa fa-star"> </i>
                                    <i class="fa fa-star"> </i>
                                    <i class="fa fa-star-o"> </i>
                                </div>

                            </div>
                        </div>
                        <!--/Third column-->

                    </div>
                    <!--/First row-->

                </section>
                <!--/Section: Testimonials v.3-->

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
<!--
<<<<<<< HEAD:home.php
                        <a class="btn btn-lg btn-rounded btn-primary" data-toggle="modal" data-target="#modal-reservation">S'inscrire</a>
=======
                        
>>>>>>> front2_clone:home.html
-->

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
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="js/tether.min.js"></script>

        <!-- Bootstrap core JavaScript -->
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
        
        <script>
			
			$('#profession').on('change',function(){
				
				$.ajax({
					
					type	: 'post',
					url		: '/GIT/welco-med/import/select.php',
					data	: {
							profession_id	: $('#profession').val(),
							offer_id	: $('#type').val(),
							city_id	: $('#city').val()
					},
					success	: function(r){
						console.log(r);
						$('#nbAd').html(r);
					}
				});
			});
			
/////////////////////////////////////////
			
			$('#type').on('change',function(){
				
				$.ajax({
					
					type	: 'post',
					url		: '/GIT/welco-med/import/select.php',
					data	: {
							profession_id	: $('#profession').val(),
							offer_id	: $('#type').val(),
							city_id	: $('#city').val()	
					},
					success	: function(r){
						console.log(r);
						$('#nbAd').html(r);
					}
				});
			});
			
/////////////////////////////////////////
			
			$('#city').on('change',function(){
				
				$.ajax({
					
					type	: 'post',
					url		: '/GIT/welco-med/import/select.php',
					data	: {
							profession_id	: $('#profession').val(),
							offer_id	: $('#type').val(),
							city_id	: $('#city').val()	
					},
					success	: function(r){
						console.log(r);
						$('#nbAd').html(r);
					}
				});
			});
			
//////////////////////////////////////////////////////////
		
			$('#sbt').on('click', function(e){
				
				e.preventDefault();
				
				var profession = $('#profession1').val();
				
				if(profession === 'none'){
					
					$('#modal-content').append('<p>Vous devez choisir un métier avant de valider le formulaire');
				}
				else{
					
					$.ajax({
						  type: 'post',
						  url: '/GIT/welco-med/import/check.php',
						  data: { 

							  profession    : $('#profession1').val(),
							  name			: $('#profession1 option:selected').text(),
							  firstname		: $('#firstname').val(),
							  lastname		: $('#lastname').val(),
							  address		: $('#address').val(),
							  zipcode		: $('#zipcode').val(),
							  city			: $('#city1').val(),
							  department	: $('#department').val(),
							  telephone		: $('#telephone').val(),
							  email			: $('#email').val(),
							  password		: $('#password').val(),

						  }

					}).done(function(o){
						//console.log(o);
						$('#modal-content').html(o);

					});
					
				}
				
			});
			
			
		</script>

    </body>

</html>