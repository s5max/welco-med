<?php

if(!empty($_POST)){
	
	$error = 0;
	
	$post = array_map('trim',array_map('strip_tags',$_POST));
	
	if(strlen($post['object'])< 3 || strlen($post['object'])> 255){
		
		echo'<p>Le nombre de lettres acceptées pour ce champ est de 3 à 128</p><div class="md-form">
                                <input type="text" id="object" name="object" class="form-control">
                                <label for="object">Objet</label>
                            </div>';
		$error++;
	}
	else{
		
		echo'<div class="md-form">
                                <input type="text" id="object" name="object" class="form-control" value="'.$post['object'].'" disabled>
                                <label for="object">Objet</label>
                            </div>';
	}
	
	if(strlen($post['message'])< 3 || strlen($post['message'])>500){
		echo'<p>Le nombre de lettres acceptées pour ce champ est de 3 à 500</p><div class="md-form">
								<textarea id="message" name="message" class="form-control" rows="5"></textarea>
                                <label for="message">Votre message</label>
                            </div>';
		$error++;
	}
	else{
		
		echo'<div class="md-form">
								<textarea id="message" name="message" class="form-control" rows="5" disabled>'.$post['message'].'</textarea>
                                <label for="message">Votre message</label>
                            </div>';
	}

	if($error === 0){
		

		require('../../include/connect.php');
		
		$insert = $bdd->prepare('INSERT INTO contact_advertiser(sender_id,receiver_id,object,message)VALUES(:sender_id,:receiver_id,:object,:message)');
		
		$insert->bindValue(':sender_id',$post['sender_id']);
		$insert->bindValue(':receiver_id',$post['receiver_id']);
		$insert->bindValue(':object',$post['object']);
		$insert->bindValue(':message',$post['message']);
		
		if($insert->execute()){
			echo'Votre message a bien été envoyé à l\'annonceur';
		}
		
	}
	else{
		
		echo'<input type="hidden" id="sender_id" name="sender_id" class="form-control" value="'.$post['sender_id'].'"><input type="hidden" id="receiver_id" name="receiver_id" class="form-control" value="'.$post['receiver_id'].'">
		<div class="text-center"><button id="contact_advertiser" class="btn btn-lg btn-rounded btn-primary">Envoyer</button></div>';
	
	}
}

?>

<script>
	
	$('#contact_advertiser').on('click', function(e){
				
				e.preventDefault();
					
					$.ajax({
						  type: 'post',
						  url: '/git/welco-med/ad/import/check_contact.php',
						  data: { 
							  sender_id		: $('#sender_id').val(),
							  receiver_id	: $('#receiver_id').val(),
							  object		: $('#object').val(),
							  message		: $('#message').val(),

						  }

					}).done(function(o){
						//console.log(o);
						$('#modal-contact-content').html(o);

					});
					
				
			});
	
</script>
                     

                            
                        