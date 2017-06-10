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

    if(isset($_GET['id']) && !empty($_GET['id'])){

        $msgId = (int) $_GET['id'];

        $select = $bdd->prepare('SELECT * FROM messages WHERE id = :msgid');
        $select->bindValue(':msgid', $msgId, PDO::PARAM_INT);

        if($select->execute()){
            $msg = $select->fetch(PDO::FETCH_ASSOC);
        }
        else {
            // Erreur de développement
            var_dump($msg->errorInfo());
            die; // alias de exit(); => die('Hello world');
        }
    }

    $post = [];
    $errors = [];
    $success = '';
    if(!empty($_POST)){

        foreach($_POST as $key => $value){
            $post[$key] = trim(strip_tags($value));
        }

        if(isset($post['msgread'])){
            $check = 1;
        }

        if(count($errors) === 0)
        {

            $update = $bdd->prepare('UPDATE messages SET msgread = :msgread WHERE id = :id');
            $update->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
            $update->bindValue(':msgread', $check);


            if($update->execute())
            {
                $success = 'Le message a été marqué comme lu !';
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
                            <!-- <li>
                                <a href="#"><i class="fa fa-fw fa-user"></i> Profil</a>
                            </li> -->
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
                        <li>
                            <a href="../adm_users.php"><i class="fa fa-fw fa-user"></i> Utilisateurs</a>
                        </li>
                        <li>
                            <a href="../adm_ads.php"><i class="fa fa-fw fa-cutlery"></i> Annonces</a>
                        </li>
                        <li class="active">
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
                                    <i class="fa fa-dashboard"> Message</i> 
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->
                    <?php if($success == true): // La variable $success est envoyé via le controller?>
                        <?php echo '<div class="alert alert-success">Le message a été marqué comme lu.</div>'; ?>
                    <?php endif; ?>

                    <?php if(!empty($errors)): // La variable $errors est envoyé via le controller?>
                        <?php echo '<div class="alert alert-danger">'.implode('<br>', $errors).'</div>'; ?>
                    <?php endif; ?>

                    <?php if(!empty($msg)): ?>
                    <div class="col-md-12">
                        <div class="col-md-12 panel panel-default r-p">
                            <div class="panel-heading">
                                    <h1 class="panel-title"><i class="fa fa-user-circle fa-fw"></i> Objet</h1>
                            </div>
                            <h4 class="wmpad"><?php echo $msg['object']; ?></h2>

                            <ol class="breadcrumb">
                                <li class="active">
                                    <h4>Expéditeur :</h4>
                                </li>
                            </ol>
                            <h4 class="wmpad"><?php echo $msg['lastname'].' '.$msg['firstname']; ?></h2>

                            <ol class="breadcrumb">
                                <li class="active">
                                    <h4>Email :</h4>
                                </li>
                            </ol>
                            <h4 class="wmpad"><?php echo '<a href="mailto:'.$msg['email'].'">'.$msg['email'].'</a>'; ?></h4>
                               
                            <ol class="breadcrumb">
                                <li class="active">
                                    <h4>Message :</h4>
                                </li>
                            </ol>
                            <h4 class="wmpad"><?php echo $msg['message']; ?></h4>
                        </div>
                    </div>
                    <?php endif; ?>

                    <form id="read" method='post'>
                        <input type="checkbox" name="msgread" value="1">

                        <button type="submit">Marquer comme LU</button>
                    </form>
                    
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