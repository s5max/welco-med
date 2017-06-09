<?php
session_start();

if(!empty($_POST)){
	

	$error = [];
	
	$post = array_map('trim',array_map('strip_tags',$_POST));
       
    //Vérification step 4
        
        //Titre
        if(strlen($post['title']) < 5 || strlen($post['title']) > 40){
            
            $error[] = 'Le nombre de caractères du titre doit être compris entre 5 et 40';
        }
        
        //description
        if(strlen($post['description']) < 5 || strlen($post['description']) > 750){
            
            $error[] = 'Souscrivez à l\'offre Premium pour écrire un texte plus grand';
        }
        
        //nom contact
        if(strlen($post['name']) < 3 || strlen($post['name']) > 64){
            
            $error[] = 'Le nombre de caractères du nom de votre contact doit être compris entre 3 et 255';
        }
        else{
            $post['name'] = ucfirst($post['name']);
        }
        
        
        //email
        if(!filter_var($post['email'],FILTER_VALIDATE_EMAIL)){
            $error[] = 'L\'adresse email n\'est pas dans un format valide';
        }
        
        
        //telephone contact
        if(!is_numeric($post['telephone'])){
			
            $error[] = 'Le numéro n\'est pas dans un format convenable';   
        }
	
		if(strlen($post['telephone']) != 10){
			
            $error[] = 'Le numéro n\'est pas dans un format convenable';   
        }
	
	
	
		if(count($error) === 0){
			
			require('../include/connect.php');
			
			foreach($post as $k => $v){
				$_SESSION['post']['detail'][$k] = $v;
			}
			
			$insert = $bdd->prepare('INSERT INTO ad(user_id,profession_id,offer_id,city_id,detail)VALUES(:user_id,:profession_id,:offer_id,:city_id,:detail)');
			
			$insert->bindValue(':user_id',$_SESSION['user']['id']);
			$insert->bindValue(':profession_id',$_SESSION['post']['info']['profession']);
			$insert->bindValue(':offer_id',$_SESSION['post']['info']['type']);
			$insert->bindValue(':city_id',$_SESSION['post']['info']['city']);
			
			
			$detail = json_encode($_SESSION['post']['detail']);
            
            $insert->bindValue(':detail',$detail);
            
            if($insert->execute()){
                
                echo 'Votre Annonce a bien été enregistrée';
            }
			
		}
		else{
			
			echo implode($error,'<br>');
		}
	
	}


?>


<script>

$('#step4').on('click',function(e){
		
		e.preventDefault();
		
		$.ajax({
			
			type	: 'post',
			url		: '/git/welco-med/import/check_step4.php',
			data	: {
				
						title: $('#title').val(),
						description: $('#description').val(),
						name: $('#name').val(),
						email: $('#email').val(),
						telephone: $('#telephone').val(),
						
				
			},
			success : function(o){
				console.log()
				$('#modal-step4-content').prepend('<p class="text-danger">'+o+'</p>');
			}
			
		});
		
	});

</script>