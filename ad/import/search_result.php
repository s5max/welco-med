<?php

	session_start();

	if(!empty($_POST)){
		
		$post = array_map('trim',array_map('strip_tags',$_POST));

		require('../../include/connect.php');
		

		if(isset($post['profession_id']) && isset($post['offer_id']) && isset($post['city_id'])){
					
			if($post['profession_id']>0 && $post['offer_id']>0 && $post['city_id']>0){
			$select = $bdd->prepare('SELECT * FROM ad JOIN(user,profession,offer)ON(user.id=ad.user_id AND  profession.id=ad.profession_id AND offer.id=ad.offer_id) WHERE ad.profession_id=:profession_id AND ad.offer_id=:offer_id AND ad.city_id=:city_id');
			$select->bindValue(':profession_id',$post['profession_id'],PDO::PARAM_INT);
			$select->bindValue(':offer_id',$post['offer_id'],PDO::PARAM_INT);
			$select->bindValue(':city_id',$post['city_id'],PDO::PARAM_INT);
			}
			elseif($post['profession_id']>0 && $post['offer_id']==0 && $post['city_id']==0){
			$select = $bdd->prepare('SELECT * FROM ad JOIN(user,profession,offer)ON(user.id=ad.user_id AND  profession.id=ad.profession_id AND offer.id=ad.offer_id) WHERE ad.profession_id=:profession_id');
			$select->bindValue(':profession_id',$post['profession_id'],PDO::PARAM_INT);
			}
			elseif($post['profession_id']==0 && $post['offer_id']>0 && $post['city_id']==0){
			$select = $bdd->prepare('SELECT * FROM ad JOIN(user,profession,offer)ON(user.id=ad.user_id AND  profession.id=ad.profession_id AND offer.id=ad.offer_id) WHERE ad.offer_id=:offer_id');
			$select->bindValue(':offer_id',$post['offer_id'],PDO::PARAM_INT);
			}
			elseif($post['profession_id']==0 && $post['offer_id']==0 && $post['city_id']>0){
			$select = $bdd->prepare('SELECT * FROM ad JOIN(user,profession,offer)ON(user.id=ad.user_id AND  profession.id=ad.profession_id AND offer.id=ad.offer_id) WHERE ad.city_id=:city_id');
			$select->bindValue(':city_id',$post['city_id'],PDO::PARAM_INT);
			}
			elseif($post['profession_id']>0 && $post['offer_id']>0 && $post['city_id']==0){
			$select = $bdd->prepare('SELECT * FROM ad JOIN(user,profession,offer)ON(user.id=ad.user_id AND  profession.id=ad.profession_id AND offer.id=ad.offer_id) WHERE ad.profession_id=:profession_id AND ad.offer_id=:offer_id');
			$select->bindValue(':profession_id',$post['profession_id'],PDO::PARAM_INT);
			$select->bindValue(':offer_id',$post['offer_id'],PDO::PARAM_INT);
			}
			elseif($post['profession_id']>0 && $post['offer_id']==0 && $post['city_id']>0){
			$select = $bdd->prepare('SELECT * FROM ad JOIN(user,profession,offer)ON(user.id=ad.user_id AND  profession.id=ad.profession_id AND offer.id=ad.offer_id) WHERE ad.profession_id=:profession_id AND ad.city_id=:city_id');
			$select->bindValue(':profession_id',$post['profession_id'],PDO::PARAM_INT);
			$select->bindValue(':city_id',$post['city_id'],PDO::PARAM_INT);
			}
			elseif($post['profession_id']==0 && $post['offer_id']>0 && $post['city_id']>0){
			$select = $bdd->prepare('SELECT * FROM ad JOIN(user,profession,offer)ON(user.id=ad.user_id AND  profession.id=ad.profession_id AND offer.id=ad.offer_id) WHERE ad.offer_id=:offer_id AND ad.city_id=:city_id');
			$select->bindValue(':offer_id',$post['offer_id'],PDO::PARAM_INT);
			$select->bindValue(':city_id',$post['city_id'],PDO::PARAM_INT);
			}
			
			if($select->execute()){

				$data = $select->fetchAll(PDO::FETCH_ASSOC);

				echo '<p>'.count($data).' annonce(s)</p>';

			}else{var_dump($select->errorInfo());}
		}
		
	}
	else{
		echo'Vous n\'avez pas préciser de profession';
	}

     foreach($data as $v){                                     
		 
          $d = (array)json_decode($v['detail']);
		 	unset($v['password']);
 ?>
<div class="col-md-4 col-sm-6">
	<div class="card-container manual-flip">
		<div class="card">
			<div class="front">

				<div class="cover normalcover">

					<h3 class="name"><?= $v['firstname']?></h3>
						<p class="profession"><?= $v['speciality']?></p>
			   </div>


				<div class="content">
					<div class="main">
						<p class="text-center"><strong><?= $v['kind'].' : '.$v['type'] ?></strong><br>Date de publication :<?= $v['date_create']?> <br><?= $d['department']?>, <?= $v['city']?><br><?= $d['description']?></p>
					</div>
					<div class="footer footfront">
						<button class="btn btn-simple normalbutton" onclick="rotateCard(this)">
							<i class="fa fa-mail-forward"></i> V<span class="normali">oir les détails de l'offre</span>
						</button>
					</div>
				</div>
				
			</div> <!-- end front panel -->
			<div class="back">
				<div class="header">
					<h5 class="motto"><?= $d['title']?></h5>
				</div>
				<div class="content">
					<div class="main">
						<?php if(isset($d['company'])){ echo '<p>'.$d['company'];} ?>
						<p>Heures d'activités : <?=$d['opening'].' à '.$d['closing']?></p>
						<p class="text-center"><?= $d['description']?><br>
						Visite : <?php if(isset($d['office']) && $d['office'] == 'on'){ echo'Cabinet' } if(isset($d['home']) && $d['office'] == 'on'){ echo'Domicile' } ?>
						Domicile/Cabinet<br><?= $d['exercise']?><br>Nbre de praticiens : <?= $d['nbPraticioner']?><br>Logiciel utilisé : <?=$d['software']?></p>

						<div class="stats-container">
						   <?php if(isset($d['sales'])){
						   			echo'<div class="stats">
								<h4>'.$d['sales'].'</h4>
								<p>
									Chiffre d\'affaires
								</p>
							</div>';
								}
							?>
							
							<?php if(isset($d['partner'])){
						   			echo'<div class="stats">
								<h4>'.$d['partner'].'</h4>
								<p>
									Nbre d\'associés
								</p>
							</div>';
								}
							?>
							
							<?php if(isset($d['contract'])){
						   			echo'<div class="stats">
								<h4>'.$d['contract'].'</h4>
								<p>
									Type de contrat 
								</p>
							</div>';
								}
							?>
							
							<?php if(isset($d['Type_de_journée'])){
						   			echo'<div class="stats">
								<h4>'.$d['Type_de_journée'].'</h4>
								<p>
									  
								</p>
							</div>';
								}
							?>
							
							<?php if(isset($d['salary'])){
						   			echo'<div class="stats">
								<h4>'.$d['salary'].'</h4>
								<p>
									Salaire
								</p>
							</div>';
								}
							?>
							
							<?php if(isset($d['retrocession'])){
						   			echo'<div class="stats">
								<h4>'.$d['retrocession'].'</h4>
								<p>
									Retrocession
								</p>
							</div>';
								}
							?>
							
							<?php if(isset($d['hour'])){
						   			echo'<div class="stats">
								<h4>'.$d['hour'].'</h4>
								<p>
									Heures/semaine
								</p>
							</div>';
								}
							?>
							
							
						</div>

					</div>
				</div>
				<div class="footer">
					<button class="btn btn-simple normalbutton" rel="tooltip" title="Flip Card" onclick="rotateCard(this)">
						<i class="fa fa-reply normali"></i> R<span class="normali">etour aux annonces</span>
					</button>
					<?php if(!isset($_SESSION['user'])){ ?>
							
							<a id="contact" class="btn btn-lg btn-rounded btn-primary waves-effect waves-light btn-contact" data-receiver="<?=$v['user_id'];?>" data-toggle="modal" data-target="#modal-contact" disabled>Contacter l'annonceur</a>

						<div id="no-log">
						
							<p>vous devez être inscrit(e) et connecté(e) pour contacter l\'annonceur</p>

							<a class="btn btn-lg btn-rounded btn-primary" data-toggle="modal" data-target="#modal-reservation">S'inscrire</a>

							<a class="btn btn-lg btn-rounded btn-primary" data-toggle="modal" data-target="#modal-log">Se connecter</a>
						</div>
					<?php
 					}
		 			else{
					?>
						<a id="contact" class="btn btn-lg btn-rounded btn-primary waves-effect waves-light btn-contact" data-receiver="<?=$v['user_id'];?>" data-toggle="modal" data-target="#modal-contact">Contacter l'annonceur</a>
					<?php } ?>

				</div>
			</div> <!-- end back panel -->
		</div> <!-- end card -->
	</div> <!-- end card-container -->
</div> <!-- end col sm 3 -->


<?php

	}//End foreach



?>


<script>

	$('.btn-contact').on('click',function(e){
				
				var receiver = this.attributes[2].nodeValue;
				console.log(receiver);
		console.log(this);
				$.ajax({
						  type: 'post',
						  url: '/git/welco-med/ad/import/get_user.php'

					}).done(function(o){
						//console.log(o);
						$('#sender_id').val(o);
						$('#receiver_id').val(receiver);
						
					});
				
			});
	
</script>