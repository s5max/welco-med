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

    if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
    $msg_id = (int) $_GET['id'];

    // On sélectionne l'utilisateur pour être sur qu'il existe et faire un rappel
    $select = $bdd->prepare('SELECT * FROM messages WHERE id = :id');
    $select->bindValue(':id', $msg_id, PDO::PARAM_INT);

    if($select->execute()){
        $my_msg = $select->fetch(PDO::FETCH_ASSOC);
    }
    if(!empty($_POST)){
        // Si la valeur du champ caché ayant pour name="action" est égale a delete, alors je supprime
        if(isset($_POST['action']) && $_POST['action'] === 'delete'){
            $delete = $bdd->prepare('DELETE FROM messages WHERE id = :id');
            $delete->bindValue(':id', $msg_id, PDO::PARAM_INT);

            if($delete->execute()){
                $success = '<div class="alert alert-success">Le message a été supprimé !</div>';
                header("refresh:5;url=../adm_unreadcontacts.php");
            }
            else {
                var_dump($delete->errorInfo()); 
                die;
            }
        }
    }
}

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
                                    <i class="fa fa-dashboard"> Supprimer le message</i> 
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->
            
                    <?php if(!isset($my_msg) || empty($my_msg)): ?>
                        <p style="color:red">Désolé, aucun message correspondant</p>
        
                    <?php elseif(isset($success)): ?>
                        <?php echo $success; ?>

                    <?php else: ?>
                    <div class="col-xs-12 deleteuser">
                        <h2>Voulez-vous supprimer ce message ?</h2>

                    <form method="post">
                        
                        <input type="hidden" name="action" value="delete">

                        <!-- history.back() permet de revenir à la page précédente -->
                        <button type="button" class="btn btn-default" onclick="javascript:history.back();">Annuler</button>
                        <input type="submit" class="btn btn-primary" value="Supprimer ce message">
                    </form>
                    </div>

                    <?php endif; ?>

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