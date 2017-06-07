<?php
session_start();
    if(!empty($_POST)){
        
		require('../include/connect.php');
		
        $error = [];
        
        $post = array_map('trim',array_map('strip_tags',$_POST));
        
		
        
        //email
        if(!filter_var($post['email'],FILTER_VALIDATE_EMAIL)){
            $error[] = 'L\'adresse email n\'est pas dans un format valide';
        }
        
        if(count($error) === 0){
            
            $select = $bdd->prepare('SELECT * FROM user WHERE email = :email LIMIT 1');
            
            $select->bindValue(':email',$post['email']);
            
            if($select->execute()){
                
                $user = $select->fetch(PDO::FETCH_ASSOC);

                if(password_verify($post['password'],$user['password'])){
                    unset($user['password']);
                    
                    $_SESSION['user'] = $user;
                    
//                    header('location:/WELCOMED2/user/index.php');
					
                    echo '<p>Vous êtes maintenant connecté à votre compte!</p><button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Reprendre là où j\'en étais</button>
					<script>$(\'#no-log\').css(\'display\',\'none\');$(\'#contact\').removeAttr(\'disabled\');</script>';
                
                }
                else{
                    
                    echo 'Votre identifiant et/ou votre mot de passe sont incorrectes';
					echo'<div class="md-form">
                                <input type="text" id="email_log" name="email_log" class="form-control">
                                <label for="form42">Email</label>
                            </div>

                            <div class="md-form">
                                <input type="password" id="password_log" name="password_log" class="form-control">
                                <label for="password_log">Mot de passe</label>
                            </div>
							 <div class="text-center">
                               
                                <button id="log" class="btn btn-lg btn-rounded btn-primary">Connexion</button>
                               
                            </div>';
                }
            }//$select->execute()
			else{
				
				echo '<p>Cet Email ne correspond à aucun Compte</p>
				<a class="btn btn-lg btn-rounded btn-primary" data-toggle="modal" data-target="#modal-reservation">Créer un compte</a>';
				
			}
            
        }else //(count($error) === 0)
		{
			echo implode($error,'<br>');
			echo'<div class="md-form">
                                <input type="text" id="email_log" name="email_log" class="form-control">
                                <label for="form42">Email</label>
                            </div>

                            <div class="md-form">
                                <input type="password" id="password_log" name="password_log" class="form-control">
                                <label for="password_log">Mot de passe</label>
                            </div>
							 <div class="text-center">
                               
                                <button id="log" class="btn btn-lg btn-rounded btn-primary">Connexion</button>
                               
                            </div>';
		
		}//Fin (count($error) === 0)
        
    }




?>

<script>

	$('#log').on('click', function(e){
				
		e.preventDefault();

			$.ajax({
				  type: 'post',
				  url: '/GIT/welco-med/import/log.php',
				  data: { 

					  email			: $('#email_log').val(),
					  password		: $('#password_log').val(),

				  }

			}).done(function(o){
				console.log(o);
				$('#modal-log-content').html(o);

			});


	});

</script>