<?php
session_start();

if(!empty($_POST)){
	
	
	$error = [];
	
	$post = array_map('trim',array_map('strip_tags',$_POST));
       
        
    if(!preg_match('#^[0-9]{2}:[0-9]{2}$#',$post['opening'])){
			$error[] = 'L\'heure doit être au format de l\'exemple suivant : 09:00';
		}
		if(!preg_match('#^[0-9]{2}:[0-9]{2}$#',$post['closing'])){
			$error[] = 'L\'heure doit être au format de l\'exemple suivant : 09:00';
		}
		
		
		if(isset($post['scretary'])){ 
			if($post['secretary'] != 'on' && $post['secretary'] != 'off'){
			$error[] = 'Paramètre invalide';
			}
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
		
		if(isset($post['access'])){ 
			if($post['access'] != 'on' && $post['access'] != 'off'){
			$error[] = 'Paramètre invalide';
			}
		}
	
	
		if(count($error) === 0){
			
			foreach($post as $k => $v){
				$_SESSION['post']['detail'][$k] = $v;
			}
			echo '<a id="tostep3" class="btn btn-lg btn-rounded btn-primary" data-toggle="modal" data-target="#modal-step3">Etape 3</a><script>$(\'#tostep3\').trigger(\'click\');
			</script>';
			
		}
		else{
			
			echo implode($error,'<br>');
		}
	
	}


?>


<script>

	$('#step2').on('click',function(e){
		
		e.preventDefault();
		
		$.ajax({
			
			type	: 'post',
			url		: '/git/welco-med/import/check_step2.php',
			data	: {
				
				opening: $('#opening').val(),
				closing: $('#closing').val(),
				secretary:reference['secretary'],
				cb:reference['cb'],
				check:reference['check'],
				cash:reference['cash'],
				access:reference['access'],
				
			},
			success : function(o){
				console.log()
				$('#modal-step2-content').prepend('<p class="text-danger">'+o+'</p>');
			}
			
		});
		
	});

</script>