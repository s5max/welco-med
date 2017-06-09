<?php
session_start();
if(!empty($_POST)){


	$error = [];
	
	$post = array_map('trim',array_map('strip_tags',$_POST));
       
    //Vérifications step 3 
		
		//salariat
		if(isset($post['contract'])){
			
			$contractAllowed = ['CDD','CDI','Remplacement','Autre'];
			
			if(!in_array($post['contract'],$contractAllowed)){
				$error[] = 'Seuls les types de contrat de la liste sont acceptées';
			}
		}
		
		
		//salariat
		if(isset($post['company']) && strlen($post['company']) < 3 && strlen($post['company']) > 128){
			
			$error[] = 'Le nom doit contenir entre 3 et 128 lettres';
		}
		
		//salariat
		if(isset($post['ratio'])){
			
			$ratioAllowed = ['Mi-Temps','Temps Plein'];
			
			if(!in_array($post['ratio'],$ratioAllowed)){
				$error[] = 'Seuls les types de la liste sont acceptées';
			}
		}
		
		//cession
		if(isset($post['sales'])){
			if(!is_numeric($post['sales'])){
				$error[] = 'L\'information doit être un chiffre';
			}
			
		}
		//cession
		if(isset($post['partner'])){
			if(!is_numeric($post['partner'])){
				$error[] = 'L\'information doit être un chiffre';
			}
		}
		
		if(isset($post['office']) && $post['office'] != 'on'){
			$error[] = 'Paramètre invalide';
		}
		
		if(isset($post['home']) && $post['home'] != 'on'){
			$error[] = 'Paramètre invalide';
		}
		
		
		if(isset($post['hour'])){
			if(!is_numeric($post['hour'])){

				$error[] = 'L\'information doit être un chiffre';
			}
		}
		
		if(isset($post['patient'])){
			if(!is_numeric($post['patient'])){

				$error[] = 'L\'information doit être un chiffre';
			}
		}
		
		if(isset($post['salary'])){
			if(!is_numeric($post['salary'])){

				$error[] = 'L\'information doit être un chiffre';
			}
		}
		
		if(isset($post['retrocession'])){
			if(!is_numeric($post['retrocession'])){

				$error[] = 'L\'information doit être un chiffre';
			}
		}

		$typeAllowed =  ['SDF','SCP','SCM','SEL','SDP','GIE','Pôle de Santé','Individuel'];
        if(!in_array($post['exercise'],$typeAllowed)){
            
            $error[] = 'Seuls les types d\'exercices de la liste sont acceptées';
        }
		
		if(isset($post['nbPraticioner'])){
			if(!is_numeric($post['nbPraticioner'])){
			$error[] = 'L\'information doit être un chiffre';
			}
		}
		
		if(isset($post['software']) && strlen($post['software']) < 3 && strlen($post['software']) > 64){
			
			$error[] = 'Le nom doit contenir entre 3  64 lettres';
		}    
        
	
	
		if(count($error) === 0){
			
			foreach($post as $k => $v){
				$_SESSION['post']['detail'][$k] = $v;
			}
			echo '<a id="tostep4" class="btn btn-lg btn-rounded btn-primary" data-toggle="modal" data-target="#modal-step4">Etape 4</a><script>$(\'#tostep4\').trigger(\'click\')</script>';
			var_dump($_SESSION);
		}
		else{
			
			echo implode($error,'<br>');
		}
	
	}


?>


<script>


	$('#step3').on('click',function(e){
		
		e.preventDefault();
		
		$.ajax({
			
			type	: 'post',
			url		: '/git/welco-med/import/check_step3.php',
			data	: {
				
				office:reference['office'],		
				home:reference['home'],		
				hour: $('#hour').val(),
				patient: $('#patient').val(),
				salary: $('#salary').val(),
				retrocession: $('#retrocession').val(),
				exercise: $('#exercise').val(),
				nbPraticioner: $('#nbPraticioner').val(),
				software: $('#software').val(),
				
			},
			success : function(o){
				console.log()
				$('#modal-step3-content').prepend('<p class="text-danger">'+o+'</p>');
			}
			
		});
		
	});


</script>