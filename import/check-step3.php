<?php

if(!empty($_POST)){


	$error = [];
	
	$post = array_map('trim',array_map('strip_tags',$_POST));
       
        
        
	
	
		if($error === 0){
			
			$_SESSION['post'][] = $post;
			echo '<a id="tostep4" class="btn btn-lg btn-rounded btn-primary" data-toggle="modal" data-target="#modal-reservation">Inscription</a><script>$(\'#tostep4\').trigger(\'click\')</script>';
			
		}
		else{
			
			echo implode($error,'<br>');
		}
	
	}