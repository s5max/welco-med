<?php

if(!empty($_POST)){


	$error = [];
	
	$post = array_map('trim',array_map('strip_tags',$_POST));
       
        
        
	
	
		if($error === 0){
			
			$_SESSION['post'][] = $post;
			
			var_dump($_SESSION['post']);
			
			$insert = $bdd->prepare('INSERT INTO ad(user_id,profession_id,offer_id,city_id,detail)VALUES(:user_id,:profession_id,:offer_id,:city_id,:detail)');
			
			$insert->bindValue(':user_id',$user_id);
			$insert->bindValue(':profession_id',$profession_id);
			$insert->bindValue(':offer_id',$offer_id);
			$insert->bindValue(':city_id',$city_id);
			$insert->bindValue(':detail',$detail);
			
		}
		else{
			
			echo implode($error,'<br>');
		}
	
	}