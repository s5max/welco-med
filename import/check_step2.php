<?php

if(!empty($_POST)){

	var_dump($_SESSION['user']);
	
	$error = [];
	
	$post = array_map('trim',array_map('strip_tags',$_POST));
       
        
    if(!preg_match('#^[0-9]{2}:[0-9]{2}$#',$post['opening'])){
			$error[] = 'L\'heure doit être au format de l\'exemple suivant : 09:00';
		}
		if(!preg_match('#^[0-9]{2}:[0-9]{2}$#',$post['closing'])){
			$error[] = 'L\'heure doit être au format de l\'exemple suivant : 09:00';
		}
		
		if(isset($post['secretary']) && $post['secretary'] != 'on'){
			$error[] = 'Paramètre invalide';
		}
		
		if(isset($post['cb']) && $post['cb'] != 'on'){
			$error[] = 'Paramètre invalide';
		}
		
		if(isset($post['check']) && $post['check'] != 'on'){
			$error[] = 'Paramètre invalide';
		}
		
		if(isset($post['cash']) && $post['cash'] != 'on'){
			$error[] = 'Paramètre invalide';
		}
		
		if(isset($post['acces']) && $post['access'] != 'on'){
			$error[] = 'Paramètre invalide';
		}
	
	
		if($error === 0){
			
			$_SESSION['post'][] = $post;
			echo '<a id="tostep3" class="btn btn-lg btn-rounded btn-primary" data-toggle="modal" data-target="#modal-reservation">Inscription</a><script>$(\'#tostep3\').trigger(\'click\')</script>';
			
		}
		else{
			
			echo implode($error,'<br>');
		}
	
	}