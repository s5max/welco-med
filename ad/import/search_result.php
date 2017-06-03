<?php

	if(!empty($_POST)){
		
		$post = array_map('trim',array_map('strip_tags',$_POST));

		require('../../include/connect.php');
		

		if(isset($post['profession_id']) && isset($post['offer_id']) && isset($post['city_id'])){
					
			if($post['profession_id']>0 && $post['offer_id']>0 && $post['city_id']>0){
			$select = $bdd->prepare('SELECT * FROM ad WHERE profession_id=:profession_id AND offer_id=:offer_id AND city_id=:city_id');
			$select->bindValue(':profession_id',$post['profession_id'],PDO::PARAM_INT);
			$select->bindValue(':offer_id',$post['offer_id'],PDO::PARAM_INT);
			$select->bindValue(':city_id',$post['city_id'],PDO::PARAM_INT);
			}
			elseif($post['profession_id']>0 && $post['offer_id']==0 && $post['city_id']==0){
			$select = $bdd->prepare('SELECT * FROM ad WHERE profession_id=:profession_id');
			$select->bindValue(':profession_id',$post['profession_id'],PDO::PARAM_INT);
			}
			elseif($post['profession_id']==0 && $post['offer_id']>0 && $post['city_id']==0){
			$select = $bdd->prepare('SELECT * FROM ad WHERE offer_id=:offer_id');
			$select->bindValue(':offer_id',$post['offer_id'],PDO::PARAM_INT);
			}
			elseif($post['profession_id']==0 && $post['offer_id']==0 && $post['city_id']>0){
			$select = $bdd->prepare('SELECT * FROM ad WHERE city_id=:city_id');
			$select->bindValue(':city_id',$post['city_id'],PDO::PARAM_INT);
			}
			elseif($post['profession_id']>0 && $post['offer_id']>0 && $post['city_id']==0){
			$select = $bdd->prepare('SELECT * FROM ad WHERE profession_id=:profession_id AND offer_id=:offer_id');
			$select->bindValue(':profession_id',$post['profession_id'],PDO::PARAM_INT);
			$select->bindValue(':offer_id',$post['offer_id'],PDO::PARAM_INT);
			}
			elseif($post['profession_id']>0 && $post['offer_id']==0 && $post['city_id']>0){
			$select = $bdd->prepare('SELECT * FROM ad WHERE profession_id=:profession_id AND city_id=:city_id');
			$select->bindValue(':profession_id',$post['profession_id'],PDO::PARAM_INT);
			$select->bindValue(':city_id',$post['city_id'],PDO::PARAM_INT);
			}
			elseif($post['profession_id']==0 && $post['offer_id']>0 && $post['city_id']>0){
			$select = $bdd->prepare('SELECT * FROM ad WHERE offer_id=:offer_id AND city_id=:city_id');
			$select->bindValue(':offer_id',$post['offer_id'],PDO::PARAM_INT);
			$select->bindValue(':city_id',$post['city_id'],PDO::PARAM_INT);
			}
			
			if($select->execute()){

				$data = $select->fetchAll(PDO::FETCH_ASSOC);

				echo '<p>'.count($data).' annonce(s)</p>';

			}
		}
		
	}
	else{
		echo'Vous n\'avez pas préciser de profession';
	}

     foreach($data as $v){                                     
		 
          $d = (array)json_decode($v['detail']);
		 
 ?>
<div class="col-md-4 col-sm-6">
	<div class="card-container manual-flip">
		<div class="card">
			<div class="front">

				<div class="cover normalcover">

					<h3 class="name"><?= $d['firstname']?></h3>
						<p class="profession"><?= $d['profession']?></p>
			   </div>


				<div class="content">
					<div class="main">
						<p class="text-center"><strong><?= $d['type']?></strong><br>Date de publication : <br><?= $d['department']?>, <?= $d['city']?><br><?= $d['description']?></p>
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
						<p>Heures d'activités : <?=$d['opening'].' à '.$d['closing']?></p>
						<p class="text-center"><?= $d['description']?><br>Domicile/Cabinet<br><?= $d['exercise']?><br>Nbre de praticiens : <?= $d['nbPraticioner']?><br>Logiciel utilisé : <?=$d['software']?></p>

						<div class="stats-container">
						   <div class="stats">
								<h4>CA</h4>
								<p>
									Annuel
								</p>
							</div>
							<div class="stats">
								<h4><?=$d['patient/day']?></h4>
								<p>
									Patients/jour
								</p>
							</div>
							<div class="stats">
								<h4><?=$d['patient/day']?></h4>
								<p>
									Rétrocession
								</p>
							</div>
							<div class="stats">
								<h4><?=$d['hour/week']?></h4>
								<p>
									Hrs/semaine
								</p>
							</div>
						</div>

					</div>
				</div>
				<div class="footer">
					<button class="btn btn-simple normalbutton" rel="tooltip" title="Flip Card" onclick="rotateCard(this)">
						<i class="fa fa-reply normali"></i> R<span class="normali">etour aux annonces</span>
					</button>

					<button id="contact">Contacter l'annonceur</button>

				</div>
			</div> <!-- end back panel -->
		</div> <!-- end card -->
	</div> <!-- end card-container -->
</div> <!-- end col sm 3 -->


<?php

	}//End foreach



?>