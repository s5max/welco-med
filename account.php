<?php
    require('include/connect.php');
    require('include/header.php');

    $recette = [];
    // view_menu.php?id=6
    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){

        $idUser = (int) $_SESSION['id'];

        // Jointure SQL permettant de récupérer la recette & le prénom & nom de l'utilisateur l'ayant publié
        $selectOne = $bdd->prepare('SELECT u.* FROM users AS u WHERE id = :id');
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

                    <a class="navbar-brand" href="home.php">
                        <strong><img src="img/logomin.png" class="normallogo"/></strong>
                    </a>

                    <div class="collapse navbar-collapse" id="navbarNav">

                        <!--Links-->
                        <ul class="navbar-nav mr-auto smooth-scroll">
                            <li class="nav-item">
                                <?php echo '<a class="nav-link" href="home.php">Accueil</a>';?>
                            </li>
                            <li class="nav-item">
                                <?php echo '<a class="nav-link" href="ad/ad_list.php">Voir les offres</a>';?>
                            </li>
                            <li class="nav-item">
                                <?php echo '<a class="nav-link" href="contact.php">Contactez-nous</a>';?>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#products" data-offset="100" data-toggle="modal" data-target="#modal-step1">Publier une annonce</a>
                            </li>
                            <li class="nav-item">
                                <?php if(isset($_SESSION['id']) && isset($_SESSION['email'])){echo '<a class="nav-link" href="account.php">Mon Compte</a>';} else {echo '<a class="nav-link" data-toggle="modal" data-target="#modal-reservation">S\'inscrire</a>';}?>
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
                            <h4 class="modal-title w-100">Formulaire d'inscription</h4>
                        </div>
                        <!--Body-->
                        <div class="modal-body" id="modal-content">
                            
                            <form id="subscribe" method="post" enctype="multipart/form-data">
                                
                                <select class="mdb-select colorful-select dropdown-default" name="profession1" id="profession1">
                                <option value="none">--- Choisir votre profession ---</option>
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
                                    <input type="text" name="department1" id="department1" class="form-control">
                                    <span><label for="department1">Département</label></span>
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
            
            
            
            <!--Modal step 1-->
            <div class="modal fade modal-ext" id="modal-step1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <!--Content-->
                    <div class="modal-content">
                       <!--Header-->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title w-100">Publier une annonce : Etape 1</h4>
                        </div>
                        <!--Body-->
                        <div class="modal-body" id="modal-step1-content">
                        
                        	<form id="step1Form" method="post" enctype="multipart/form-data">
                        	
								<select name="type" id="type" class="form-control">
									<option value="none" selected disabled>-- Type d'annonce --</option>
													<!-- On réutilise notre array() ci-dessus -->
									<optgroup label="Offre">
									<?php foreach($offer as $value){
											echo'<option value="'.$value[0].'">'.$value[1].'</option>';

										}//End foreach ?>
									<optgroup label="Demande">
									<?php foreach($demand as $value){
											echo'<option value="'.$value[0].'">'.$value[1].'</option>';

									}//End foreach ?>
								</select>

								<select name="profession" id="profession" class="form-control">
										<option value="none">--- Choisir votre proffession ---</option>
										<?php foreach($professionAvailable as $value){ echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';} ?>
								</select>

								<div class="md-form">
									<input type="text" id="department" name="department" class="form-control" value="Martinique" disabled>
									<label for="department">Département</label>
								</div>

								<div class="md-form">
									<select name="city" id="city" class="form-control">
										<option value="none" selected disabled>-- Commune --</option>
										<?php foreach ($cityAvailable as $value): ?>
											<option value="<?=$value['id'];?>"><?=$value['name'];?></option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="md-form">
									<input type="text" name="date_start" id="date_start" placeholder="jj/mm/aaaa">
									<label for="date_start">Date de début</label>
								</div>

								<div class="md-form">
									<input type="text" name="date_end" id="date_end" placeholder="jj/mm/aaaa">
									<label for="date_end">Date de fin</label>
								</div>

								<div class="text-center">

									<button id="step1" class="btn btn-lg btn-rounded btn-primary">Suivant</button>

								</div>
                      
							</form>
                       
                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Fermer*</button>
                            <p class="text-muted">*Les informations ne seront pas enregistrées</p>
                        </div>
                        
 		            </div>
                    <!--/Content-->
                </div>
            </div>
			<!--/Modal step 1-->
           
           
           
           
           	<!--Modal step 2-->
            <div class="modal fade modal-ext" id="modal-step2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <!--Content-->
                    <div class="modal-content">
                       <!--Header-->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title w-100">Publier une annonce : Etape 2</h4>
                        </div>
                        <!--Body-->
                        <div class="modal-body" id="modal-step2-content">
                        
                        	<form id="step2Form" method="post" enctype="multipart/form-data">
                        	
								<div class="md-form">
									<label for="opening">Heure d'Ouverture</label>
									<input type="text" name="opening" id="opening" placeholder="hh:mm">
								</div>

								<div class="md-form">
									<label for="closing">Heure de Fermeture</label>
									<input type="text" name="closing" id="closing" placeholder="hh:mm">
								</div>

								<div class="md-form">
									<label for="secretary">Présence d'une secrétaire</label>
									<span>Oui</span>
									<span>Non</span>
								</div>

								<label for="payment">Règlements Acceptés</label>

									<span>CB</span>
									<span>Chèque</span>
									<span>Espèces</span>

								<label for="access">Accès Handicapé</label><p>

									<span>Oui</span>
									<span>Non</span>

								<div class="text-center">

									<button id="step2" class="btn btn-lg btn-rounded btn-primary">Suivant</button>

								</div>
                      
							</form>
                       
                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Fermer*</button>
                            <p class="text-muted">*Les informations ne seront pas enregistrées</p>
                        </div>
                        
 		            </div>
                    <!--/Content-->
                </div>
            </div>
			<!--/Modal step 2-->
            
            
            
            <!--Modal step 3-->
            <div class="modal fade modal-ext" id="modal-step3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <!--Content-->
                    <div class="modal-content">
                       <!--Header-->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title w-100">Publier une annonce : Etape 3</h4>
                        </div>
                        <!--Body-->
                        <div class="modal-body" id="modal-step3-content">
                        
                        	<form id="step3Form" method="post" enctype="multipart/form-data">
                        	
								

								<div class="text-center">

									<button id="step3" class="btn btn-lg btn-rounded btn-primary">Suivant</button>

								</div>
                      
							</form>
                       
                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Fermer*</button>
                            <p class="text-muted">*Les informations ne seront pas enregistrées</p>
                        </div>
                        
 		            </div>
                    <!--/Content-->
                </div>
            </div>
			<!--/Modal step 3-->
           
           
           <!--Modal step 4-->
            <div class="modal fade modal-ext" id="modal-step4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <!--Content-->
                    <div class="modal-content">
                       <!--Header-->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title w-100">Publier une annonce : Etape 4</h4>
                        </div>
                        <!--Body-->
                        <div class="modal-body" id="modal-step4-content">
                        
                        	<form id="step4Form" method="post" enctype="multipart/form-data">
                        	
								

								<div class="text-center">

									<button id="step4" class="btn btn-lg btn-rounded btn-primary">Suivant</button>

								</div>
                      
							</form>
                       
                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Fermer*</button>
                            <p class="text-muted">*Les informations ne seront pas enregistrées</p>
                        </div>
                        
 		            </div>
                    <!--/Content-->
                </div>
            </div>
			<!--/Modal step 4-->
            
            
            

        </header>
        <!--/Navigation & Intro-->

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
   
    
<script>
				
	$('#step1').on('click',function(e){
		
		e.preventDefault();
		
		$.ajax({
			
			type	: 'post',
			url		: '/git/welco-med/import/check_step1.php',
			data	: {
				
				type		: $('#type').val(),
				profession	: $('#profession').val(),
				department	: $('#department').val(),
				city		: $('#city').val(),
				date_start	: $('#date_start').val(),
				date_end	: $('#date_end').val()
			},
			success : function(o){
				
				$('#modal-step1-content').prepend('<p class="text-danger">'+o+'</p>');
			}
			
		});
		
	});
	
	
	$('#step2').on('click',function(e){
		
		e.preventDefault();
		
		$.ajax({
			
			type	: 'post',
			url		: '/git/welco-med/import/check_step2.php',
			data	: {
				
//						: $('#').val(),
				
			},
			success : function(o){
				console.log()
				$('#modal-step2-content').prepend('<p class="text-danger">'+o+'</p>');
			}
			
		});
		
	});
	
	
	$('#step3').on('click',function(e){
		
		e.preventDefault();
		
		$.ajax({
			
			type	: 'post',
			url		: '/git/welco-med/import/check_step3.php',
			data	: {
				
//						: $('#').val(),
				
			},
			success : function(o){
				console.log()
				$('#modal-step3-content').prepend('<p class="text-danger">'+o+'</p>');
			}
			
		});
		
	});
	
	$('#step4').on('click',function(e){
		
		e.preventDefault();
		
		$.ajax({
			
			type	: 'post',
			url		: '/git/welco-med/import/check_step4.php',
			data	: {
				
//						: $('#').val(),
				
			},
			success : function(o){
				console.log()
				$('#modal-step4-content').prepend('<p class="text-danger">'+o+'</p>');
			}
			
		});
		
	});
				
</script>
    
    

    </body>

</html>