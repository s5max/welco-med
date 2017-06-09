<?php
    require('../../include/connect.php');
    require('../../include/header.php');

    if(isset($_SESSION['id']) && ($_SESSION['role'] == 'admin')){

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
    }   else {
        header('location: ../../home.php');
    }

    $errors = [];
    $wm_user = []; // Contiendra les données épurées
    $success = '';
    $rol = '';


    $role = [
        'admin' => 'Admin',
        'user'  => 'User'
    ];

    $city = [
        'Ajoupa Bouillon'   =>  'Ajoupa Bouillon',
        'Anse d\'Arlets'    =>  'Anse d\'Arlets',
        'Basse Pointe'      =>  'Basse Pointe',
        'Carbet'            =>  'Carbet',
        'Case Pilote'       =>  'Case Pilote',
        'Diamant'           =>  'Diamant',
        'Ducos'             =>  'Ducos',
        'Fond Saint Denis'  =>  'Fond Saint Denis',
        'Fort de France'    =>  'Fort de France',
        'François'          =>  'François',
        'Gros Morne'        =>  'Gros Morne',
        'Lamentin'          =>  'Lamentin',
        'Lorrain'           =>  'Lorrain',
        'Macouba'           =>  'Macouba',
        'Marigot'           =>  'Marigot',
        'Marin'             =>  'Marin',
        'Morne Rouge'       =>  'Morne Rouge',
        'Morne Vert'        =>  'Morne Vert',
        'Précheur'          =>  'Précheur',
        'Rivière Pilote'    =>  'Rivière Pilote',
        'Rivière Salée'     =>  'Rivière Salée',
        'Robert'            =>  'Robert',
        'Saint Anne'        =>  'Saint Anne',
        'Saint ESprit'      =>  'Saint ESprit',
        'Saint Joseph'      =>  'Saint Joseph',
        'Saint Luce'        =>  'Saint Luce',
        'Sainte Marie'      =>  'Sainte Marie',
        'Saint Pierre'      =>  'Saint Pierre',
        'Schoelcher'        =>  'Schoelcher',
        'Trinité'           =>  'Trinité',
        'Trois Ilets'       =>  'Trois Ilets',
        'Vauclin'           =>  'Vauclin',
        'Vert-Pré'          =>  'Vert-Pré'
    ];

    if(isset($_GET['id']) && !empty($_GET['id'])){

        $userid = (int) $_GET['id'];

        $updateU = $bdd->prepare('SELECT * FROM user WHERE id = :userid');
        $updateU->bindValue(':userid', $userid, PDO::PARAM_INT);

        if($updateU->execute()){
            $userr = $updateU->fetch(PDO::FETCH_ASSOC);

        }
        else {
            // Erreur de développement
            var_dump($userr->errorInfo());
            die; // alias de exit(); => die('Hello world');
        }
    }

    if(!empty($_POST)){

        foreach($_POST as $key => $value){
            $wm_user[$key] = trim(strip_tags($value));
        }

        if(empty($wm_user['lastname'])){
            $errors[] = 'Entrez un nom !';
        }

        if(empty($wm_user['firstname'])){
            $errors[] = 'Entrez un prénom !';
        }

        if(!is_numeric($wm_user['telephone']) || strlen($wm_user['telephone']) < 10){
            $errors[] = 'Entrez un numéro de téléphone valide !';
        }

        if(!filter_var($wm_user['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Entrez un email valide !';
        }

        if(strlen($wm_user['address'])  < 3){
            $errors[] = 'Entrez une adresse valide !';
        }

        if(!is_numeric($wm_user['zipcode']) || strlen($wm_user['zipcode']) != 5){
            $errors[] = 'Entrez un code postal valide !';
        }

        if(empty($wm_user['city'])){
            $errors[] = 'Entrez une ville !';
        }

        if(empty($wm_user['department'])){
            $errors[] = 'Entrez un departement !';
        }

        if(isset($wm_user['wm_role'])){
            $rol = $wm_user['wm_role'];

        }

        if(count($errors) === 0)
        {

            $update = $bdd->prepare('UPDATE user SET wm_role = :wm_role WHERE id = :id');
            $update->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
            $update->bindValue(':wm_role', $rol);


            if($update->execute())
            {
                $success = 'Le compte a été mis à jour !';
            }
            else
            {
                var_dump($update->errorInfo());
            }
        }
        else
        {
            $textErrors = implode('<br>', $errors);
        }
    }
    // endif $_GET['id']

?><!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="pmdmp">
        <title>Welcomed</title>

    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../../css/bootstrap337.css">
    <!-- Custom CSS -->
        <link rel="stylesheet" href="../../css/sb-admin.css">
        <link rel="stylesheet" href="../../css/plugins/morris.css') ?>">
        <link rel="stylesheet" href="../../css/styleadmin.css">
        <link rel="stylesheet" href="../../font-awesome/css/font-awesome.min.css">

    </head>
    <body>
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../home.php">Welcomed</a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i> <?php echo $user['firstname'].' '.$user['lastname'];?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#"><i class="fa fa-fw fa-user"></i> Profil</a>
                            </li>
                            <li>
                                <a href="../adm_unreadcontacts.php"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="../logout.php?logout=yes"><i class="fa fa-fw fa-power-off"></i> Déconnexion</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li>
                            <a href="../home.php"><i class="fa fa-fw fa-dashboard"></i> Panneau D'Administration</a>
                        </li>
                        <li class="active">
                            <a href="../adm_users.php"><i class="fa fa-fw fa-user"></i> Utilisateurs</a>
                        </li>
                        <li>
                            <a href="../adm_ads.php"><i class="fa fa-fw fa-cutlery"></i> Annonces</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-envelope fa-arrows-v"></i> Contacts <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="demo" class="collapse">
                                <li>
                                    <a href="../adm_unreadcontacts.php"><i class="fa fa-fw fa-envelope-o"></i> Nouveaux messages</a>
                                </li>
                                <li>
                                    <a href="../adm_readcontacts.php"><i class="fa fa-fw fa-envelope-open-o"></i> Déja lus</a>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>

            <div id="page-wrapper">
            
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Panneau D'Administration
                            </h1>
                            <ol class="breadcrumb">
                                <li class="active">
                                    <i class="fa fa-dashboard"> Mettre à jour l'utilisateur</i> 
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->

                    <div class="col-xs-12">
        <?php if($success == true): // La variable $success est envoyé via le controller?>
        <?php echo '<div class="alert alert-success">Le compte a été mis à jour.</div>'; ?>
        <?php endif; ?>

        <?php if(!empty($errors)): // La variable $errors est envoyé via le controller?>
        <?php echo '<div class="alert alert-danger">'.implode('<br>', $errors).'</div>'; ?>
        <?php endif; ?>

        <p>(<span class="requis">*</span>) : Champ requis</p>
        <form id="udpdate" class="form-horizontal col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1" method="post">
            <fieldset>

                <!-- Form Name -->

                <!-- Lastname -->
                <div class="form-group">
                    <div class="col-xs-12">
                        <label>Nom :</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="lastname" value="<?=$userr['lastname']; ?>">
                        </div>
                    </div>
                </div>

                <!-- Firstname -->
                <div class="form-group">
                    <div class="col-xs-12">
                        <label>Prénom :</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="firstname" value="<?=$userr['firstname']; ?>">
                        </div>
                    </div>
                </div>

                <!-- Profession -->
                <div class="form-group">
                    <div class="col-xs-12">
                        <label>Profession :</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="profession" value="<?=$userr['profession']; ?>">
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <div class="col-xs-12">
                        <label>Email :</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            <input type="email" class="form-control" name="email" value="<?=$userr['email']; ?>">
                        </div>
                    </div>
                </div>

                <!-- Phone -->
                <div class="form-group">
                    <div class="col-xs-12">
                        <label>Téléphone :</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="telephone" value="<?=$userr['telephone']; ?>">
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="form-group">
                    <div class="col-xs-12">
                        <label>Adresse :</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="address" value="<?=$userr['address']; ?>">
                        </div>
                    </div>
                </div>

                <!-- Zipcode -->
                <div class="form-group">
                    <div class="col-xs-12">
                        <label>Code Postal :</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="zipcode" value="<?=$userr['zipcode']; ?>">
                        </div>
                    </div>
                </div>

                <!-- Ville -->
                <div class="form-group">
                    <div class="col-xs-12">
                        <label>Ville :</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="city" value="<?=$userr['city']; ?>">
                        </div>
                    </div>
                </div>

                <!-- Departement -->
                <div class="form-group">
                    <div class="col-xs-12">
                        <label>Département :</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-globe" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="department" value="<?=$userr['department']; ?>">
                        </div>
                    </div>
                </div>

                <!-- Role -->
                <div class="form-group">
                    <div class="col-xs-12">
                        <label>Role : <span class="requis">*</span></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                            <select name="wm_role" class="form-control" required>
                                <option value="" disabled selected>Rôle</option>
                                <?php foreach($role as $key => $value) : ?>
                                <option value="<?=$key; ?>"><?=$value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Bouton d'envoi -->
                <div class="col-xs-12" style="text-align:center">
                    <button type="submit" class="btn btn-primary" id="button">Mettre à jour</button>
                </div>
            </fieldset>
        </form>
    </div>
                </div>
                    
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="../../js/jquery-1.11.1.js"></script>
        <!-- Bootstrap JS -->
        <script src="../../js/bootstrap.min.js"></script>
        
        <!-- Script JS -->
        <script src="../../js/script.js"></script>
        <script src="../../js/button.js"></script>
        
        <!-- Morris Charts JS -->
        <script src="../../js/plugins/morris/raphael.min.js"></script>
        <script src="../../js/plugins/morris/morris.min.js"></script>
        <script src="../../js/plugins/morris/morris-data.js"></script>
    
    </body>
</html>