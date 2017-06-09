<?php
    require('../include/connect.php');
    require('../include/header.php');

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
            header('location: ../home.php');
    }

    $countUsers = $bdd->prepare('SELECT * FROM user');
        if($countUsers->execute()){
            $usersC = $countUsers->fetchAll(PDO::FETCH_ASSOC);
            $nbUsers = count($usersC);
    }

    $countAds = $bdd->prepare('SELECT * FROM ad');
        if($countAds->execute()){
            $adsC = $countAds->fetchAll(PDO::FETCH_ASSOC);
            $nbAds = count($adsC);
    }
    $countMsgU = $bdd->prepare('SELECT * FROM messages WHERE msgread = 0');
        if($countMsgU->execute()){
            $msgUC = $countMsgU->fetchAll(PDO::FETCH_ASSOC);
            $nbMsgU = count($msgUC);
    }
    $countMsgR = $bdd->prepare('SELECT * FROM messages WHERE msgread = 1');
        if($countMsgR->execute()){
            $msgRC = $countMsgR->fetchAll(PDO::FETCH_ASSOC);
            $nbMsgR = count($msgRC);
    }

?>
<?php include '../include/adminhead.php'; ?>
<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li class="active">
                            <a href="home.php"><i class="fa fa-fw fa-dashboard"></i> Panneau D'Administration</a>
                        </li>
                        <li>
                            <a href="adm_users.php"><i class="fa fa-fw fa-user"></i> Utilisateurs</a>
                        </li>
                        <li>
                            <a href="adm_ads.php"><i class="fa fa-fw fa-cutlery"></i> Annonces</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-envelope fa-arrows-v"></i> Contacts <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="demo" class="collapse">
                                <li>
                                    <a href="adm_unreadcontacts.php"><i class="fa fa-fw fa-envelope-o"></i> Nouveaux messages</a>
                                </li>
                                <li>
                                    <a href="adm_readcontacts.php"><i class="fa fa-fw fa-envelope-open-o"></i> Déja lus</a>
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
                            Panneau D'Administration <small>Bienvenue</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"> Accueil</i> 
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= $nbUsers; ?></div>
                                        <div>Utilisateurs!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="adm_users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir Détail</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= $nbAds; ?></div>
                                        <div>Annonces!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="adm_ads.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir Détails</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-envelope fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= $nbMsgU; ?></div>
                                        <div>Messages non lus!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="adm_unreadcontacts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir Détails</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-envelope-open fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= $nbMsgR; ?></div>
                                        <div>Messages lus!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="adm_readcontacts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir Détails</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
                
<?php include '../include/adminfooter.php'; ?>