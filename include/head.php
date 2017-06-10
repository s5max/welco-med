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
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <?php echo '<a class="nav-link" href="home.php">Accueil</a>';?>
                            </li>
                            <li class="nav-item">
                                <?php echo '<a class="nav-link" href="ad/index.php">Voir les offres</a>';?>
                            </li>
                            <li class="nav-item">
                                <?php echo '<a class="nav-link" href="contact.php">Contactez-nous</a>';?>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-offset="100" data-toggle="modal" data-target="#modal-step1">Publier une annonce</a>
                            </li>
                            <li class="nav-item">
                                <?php if(isset($_SESSION['user']['id']) && isset($_SESSION['email'])){echo '<a class="nav-link" href="account.php">Mon Compte</a>';} else {echo '<a class="nav-link" data-toggle="modal" data-target="#modal-reservation">Se Connecter</a>';}?>
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
                                    <label for="department1">Département</label>
                                </div>

                                <div class="md-form">
                                    <input type="text" name="telephone" id="telephone1" class="form-control">
                                    <label for="telephone1">Téléphone</label>
                                </div>

                                <div class="md-form">
                                    <input type="text" name="email" id="email1" class="form-control">
                                    <label for="email1">Email</label>
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
            
             <!--Modal log-->
            <div class="modal fade modal-ext" id="modal-log" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <!--Content-->
                    <div class="modal-content">
                       <!--Header-->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title w-100">Se Connecter</h4>
                        </div>
                        <!--Body-->
                        <div class="modal-body" id="modal-log-content">
                            <div class="md-form">
                                <input type="text" id="email_log" name="email_log" class="form-control">
                                <label for="form42">Email</label>
                            </div>

                            <div class="md-form">
                                <input type="password" id="password_log" name="password_log" class="form-control">
                                <label for="password_log">Mot de passe</label>
                            </div>

                            <div class="text-center">
                               
                                <button id="log" class="btn btn-lg btn-rounded btn-primary">Connexion</button>
                               
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
            <!--/Modal log-->           
            
            
            
            
            

        </header>
        <!--/Navigation & Intro-->