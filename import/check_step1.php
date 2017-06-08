<?php

if(!empty($_POST)){


	$error = [];
	
	$post = array_map('trim',array_map('strip_tags',$_POST));
       
        
        //Type 
        if(!is_numeric($post['type'])){
            
            $error[] = 'Seuls les propositions de la liste sont acceptées';
        }
        
        
        if(!is_numeric($post['profession'])){
            
            $error[] = 'Seuls les professions de la liste sont acceptées';
        }
        
        //Département
        if($post['department'] != 'Martinique'){
            
            $error[] = 'Les offres concernent uniquement la Martinique';
        }
        
        //Ville
        if(!is_numeric($post['city'])){
            
            $error[] = 'Seuls les villes de la liste sont acceptées';
        }
        
        //Date début et fin
        if(!preg_match('#^[0-9]{2}/[0-9]{2}/[0-9]{4}$#',$post['date_start']) || !preg_match('#^[0-9]{2}/[0-9]{2}/[0-9]{4}$#',$post['date_end'])){
            
            $error[] = 'La date doit être écrite comme dans l\'exemple suivant : 01/03/2017';
            
        }
	
var_dump($error);
	
		if(count($error) === 0){
			
			$_SESSION['post'] = $post;
			var_dump($_SESSION);
			echo '<a id="tostep2" class="btn btn-lg btn-rounded btn-primary" data-toggle="modal" data-target="#modal-step2">Inscription</a>
			<script>$(\'#tostep2\').trigger(\'click\')</script>';
			
		}
		else{
			
			echo implode($error,'<br>');

		}
	
	}


?>


<script>

	$('#step1').on('click',function(e){
		
		e.preventDefault();
		
		$.ajax({
			
			type	: 'post',
			url		: '/git/welco-med/import/check_step1.php',
			data	: {
				
				type		: $('#type').val(),
				profession	: $('#profession').val(),
				department	: $('#department').val(),
				city		: $('#city').val(),
				date_start	: $('#date_start').val(),
				date_end	: $('#date_end').val()
			},
			success : function(o){
				console.log()
				$('#modal-step1-content').prepend('<p class="text-danger">'+o+'</p>');
			}
			
		});
		
	});

</script>