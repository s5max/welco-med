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

    $select = $bdd->prepare('SELECT * FROM user ORDER BY id ASC');

    if($select->execute()){
        $users = $select->fetchAll(PDO::FETCH_ASSOC);
    }
    else {
        echo 'Une erreur s\'est produite!';
        die; //alias de exit(); => die('Hello World');
    }

?>
<?php include '../include/adminhead.php'; ?>
<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li>
                            <a href="home.php"><i class="fa fa-fw fa-dashboard"></i> Panneau D'Administration</a>
                        </li>
                        <li class="active">
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
                                Panneau D'Administration
                            </h1>
                            <ol class="breadcrumb">
                                <li class="active">
                                    <i class="fa fa-dashboard"> Listes des Utilisateurs</i> 
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->

                    <table class="table table-inverse table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Rôle</th>
                                <th>Détail</th>
                                <th>Mettre à Jour</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>

                        <tbody>
                            <!-- foreach permettant d'avoir une ligne <tr> par ligne SQL -->
                            <?php foreach($users as $user): ?>

                                <tr>
                                    <td><?=$user['id']; ?></td>
                                    <td><?=strtoupper($user['lastname']); ?></td>
                                    <td><?=ucfirst($user['firstname']); ?></td>
                                    <td><?=ucfirst($user['wm_role']); ?></td>
                                    <td>
                                        <a href="users/adm_user.php?id=<?=$user['id']; ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
                                    </td>
                                    <td>
                                        <a href="users/adm_usersupdate.php?id=<?=$user['id']; ?>"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                    </td>
                                    <td>
                                        <!-- view_menu.php?id=6 -->
                                        <a href="users/adm_userdelete.php?id=<?=$user['id']; ?>" id="deleteb"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            
                            <?php endforeach; ?>
                        </tbody>
                    </table>
            </div>
                
<?php include '../include/adminfooter.php'; ?>