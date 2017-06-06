<?php

if(!empty($_POST)){

	require('../include/connect.php');
	
	$select = $bdd->prepare('SELECT * FROM profession');

	if($select->execute()){

		$data = $select->fetchAll(PDO::FETCH_ASSOC);

	}
	
	$error = 0;
	
	$post = array_map('trim',array_map('strip_tags',$_POST));

	
	echo '<form id="subscribe" method="post" enctype="multipart/form-data">';
	
	if(!is_numeric($post['profession'])){
	
										 
	}
	else{
		echo '<div class="md-form"><input type="hidden" name="profession" id="profession1" class="form-control" value="'.$post['profession'].'"></div><div class="md-form"><input type="text" name="name" id="name" class="form-control" value="'.$post['name'].'" disabled><label for="name">Votre Profession</label></div>';
	}
	
/////////////////////////////////////////////////////
		
	if(strlen($post['firstname']) < 3 || strlen($post['firstname']) > 255){
		
		echo '<div class="md-form"><input type="text" name="firstname" id="firstname" class="form-control"><label for="firstname">Votre Nom</label></div><p>Votre nom ne peut pas contenir moins de 3 lettres</p>';
		
		$error++;
	}
	else{
		
		echo '<div class="md-form"><input type="text" name="firstname" id="firstname" class="form-control" value="'.$post['firstname'].'" disabled><label for="firstname">Votre Nom</label></div>';
	}
	
///////////////////////////////////////////////////
	
	if(strlen($post['lastname']) < 3 || strlen($post['lastname']) > 255){
		
		echo '<div class="md-form"><input type="text" name="lastname" id="lastname" class="form-control"><label for="lastname">Votre Prénom</label></div><p>Votre prénom ne peut pas contenir moins de 3 lettres</p>';
		
		$error++;
	}
	else{
		
		echo '<div class="md-form"><input type="text" name="lastname" id="lastname" class="form-control" for="lastname" value="'.$post['lastname'].'" disabled><label for="lastname">Votre Prénom</label></div>';
	}
	
////////////////////////////////////////////////////
	
	if(strlen($post['address']) < 5 || strlen($post['address']) > 255){
            
            echo '<div class="md-form"><input type="text" name="address" id="address" class="form-control"><label for="address">Adresse</label></div><p>Ceci n\'est pas une adresse valide</p>';
		
		$error++;
        }
	else{
		
		echo '<div class="md-form"><input type="text" name="address" id="address" class="form-control" value="'.$post['address'].'" disabled><label for="address">Adresse</label></div>';
	}
	
////////////////////////////////////////////////
	
	if(!is_numeric($post['zipcode']) || strlen($post['zipcode']) != 5){
            
            echo '<div class="md-form"><input type="text" name="zipcode" id="zipcode" class="form-control"><label for="zipcode">Code Postal</label></div><p>Le Code postal n\'est pas dans un format convenable</p>';
		
		$error++;
    }
	else{
		
            echo '<div class="md-form"><input type="text" name="zipcode" id="zipcode" class="form-control" value="'.$post['zipcode'].'" disabled><label for="zipcode">Code Postal</label></div>';  
	}
	
/////////////////////////////////////////////
	
	if(strlen($post['city']) < 3 || strlen($post['city']) > 255){
            
            echo '<div class="md-form"><input type="text" name="city" id="city1" class="form-control"><label for="city1">Ville</label></div><p>Le nom de la ville doit avoir entre 3 et 255 lettres</p>';
		
		$error++;
    }
	else{
		
		echo '<div class="md-form"><input type="text" name="city" id="city" class="form-control" value="'.$post['city'].'" disabled><label for="city">Ville</label></div>';
	}
        
/////////////////////////////////////////////
	
    if(strlen($post['department']) < 3 || strlen($post['department']) > 255){
            
            echo '<div class="md-form"><input type="text" name="department" id="department" class="form-control"><label for="department">Département</label></div><p>Le nom du département doit avoir entre 3 et 255 lettres</p>';
		
		$error++;
    }
	else{
		
            echo '<div class="md-form"><input type="text" name="department" id="department" class="form-control" value="'.$post['department'].'" disabled><label for="department">Département</label></div>';
	}
        
//////////////////////////////////////////////
	
    if(!is_numeric($post['telephone']) || strlen($post['telephone']) != 10){
            
            echo '<div class="md-form"><input type="text" name="telephone" id="telephone" class="form-control"><label for="telephone">Téléphone</label></div><p>Le numéro de téléphone n\'est pas dans un format convenable</p>';
		
		$error++;
    }
	else{
		
		echo '<div class="md-form"><input type="text" name="telephone" id="telephone" class="form-control" value="'.$post['telephone'].'" disabled><label for="telephone">Téléphone</label></div>';
	}
	
////////////////////////////////////////////
	
	if(!filter_var($post['email'],FILTER_VALIDATE_EMAIL)){
		
		echo '<div class="md-form"><input type="text" name="email" id="email" class="form-control"><label for="email">Email</label></div><p>L\'adresse email n\'est pas dans un format valide</p>';
		
		$error++;
	}
	else{

		//Vérifier que l'email n'existe pas
		$select = $bdd->prepare('SELECT email from users WHERE email = :email');

		$select->bindValue(':email',$post['email']);
		
		$select->execute();
		$email = $select->fetch(PDO::FETCH_ASSOC);

		if($email['email']){
			
			echo '<div class="md-form"><input type="text" name="email" id="email" class="form-control"><label for="email">Email</label></div><p>Cet email est déjà lié à un compte</p>';
			
			$error++;
		}else{
			
			echo '<div class="md-form"><input type="text" name="email" id="email" class="form-control" value="'.$post['email'].'" disabled><label for="email">Email</label></div>';
		}
	}
	
//////////////////////////////////////////////
	
	if(strlen($post['password']) < 6){
            echo '<div class="md-form"><input type="password" name="password" id="password" class="form-control"><label for="password">Mot de Passe</label></div><p>Le mot de passe doit contenir au moins 6 caractères</p>';
		
		$error++;
        }
        else{
            
            //Crypté le mot de passe
            $password = password_hash($post['password'], PASSWORD_DEFAULT);
            
			echo '<div class="md-form"><input type="password" name="password" id="password" class="form-control" value="'.$post['password'].'" disabled><label for="password">Mot de Passe</label></div>';
        }
	
	
	
	
	
	echo '<div class="text-center"><button class="btn btn-lg btn-rounded btn-primary" id="sbt">S\'inscrire</button></div></form>';
	
}//Fin de !empty $_POST



if($error === 0){
	
	$insert = $bdd->prepare('INSERT INTO user(profession_id,profession,firstname,lastname,address,city,zipcode,department,telephone,email,password,role)VALUES(:profession_id,:profession,:firstname,:lastname,:address,:city,:zipcode,:department,:telephone,:email,:password,:role)');

	$insert->bindValue(':profession_id',$post['profession']);
	$insert->bindValue(':profession',$post['name']);
	$insert->bindValue(':firstname',$post['firstname']);
	$insert->bindValue(':lastname',$post['lastname']);
	$insert->bindValue(':address',$post['address']);
	$insert->bindValue(':city',$post['city']);
	$insert->bindValue(':zipcode',$post['zipcode']);
	$insert->bindValue(':department',$post['department']);
	$insert->bindValue(':telephone',$post['telephone']);
	$insert->bindValue(':email',$post['email']);
	$insert->bindValue(':password',$password);
	$insert->bindValue(':role','user');

	if($insert->execute()){

		echo'<p>Bienvenue dans la communauté Welcomed<br><a href="/GIT/welco-med/login.php">Connectez-vous à votre espace personnel</a></p>';
		
	}
	
}
?>
<script>
	
			$('#sbt').click(function(e){
				
				e.preventDefault();
					
				$.ajax({
					  type: 'post',
					  url: '/GIT/welco-med/import/check.php',
					  data: { 

						  profession    : $('#profession1').val(),
						  name			: $('#name').val(),
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
					console.log(o);
					$('#modal-content').html(o);

				});
				
			});
			
			
</script>