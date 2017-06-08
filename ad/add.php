<?php

	require('../include/connect.php');
	require('../include/header.php');

	$select = $bdd->prepare('SELECT * FROM profession');

	if($select->execute()){

		$professionAvailable = $select->fetchAll(PDO::FETCH_ASSOC);

	}

	$select = $bdd->prepare('SELECT * FROM offer');

	if($select->execute()){

		$offerAvailable = $select->fetchAll(PDO::FETCH_ASSOC);

		$offer = [];
		$demand = [];
		foreach($offerAvailable as $value){
			if($value['id']<5){
				$offer[] = [$value['id'],$value['type']];
			}
			elseif($value['id']>4){
				$demand[] = [$value['id'],$value['type']];
			}
		}
		
	}

	$select = $bdd->prepare('SELECT * FROM city');

	if($select->execute()){

		$cityAvailable = $select->fetchAll(PDO::FETCH_ASSOC);

	}

	
?>

<!--Modal step 1-->
            <div class="modal fade modal-ext" id="modal-log" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <!--Content-->
                    <div class="modal-content">
                       <!--Header-->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title w-100">Publier une annonce : Etape 1</h4>
                        </div>
                        <!--Body-->
                        <div class="modal-body" id="modal-contact-content">
							<select class="mdb-select colorful-select dropdown-default" name="type" id="type">
								<option value="0" selected disabled>-- Type d'annonce --</option>
												<!-- On réutilise notre array() ci-dessus -->
								<optgroup label="Offre">
								<?php foreach($offer as $value){
										echo'<option value="'.$value[0].'">'.$value[1].'</option>';

									}//End foreach ?>
								<optgroup label="Demande">
								<?php foreach($demand as $value){
										echo'<option value="'.$value[0].'">'.$value[1].'</option>';

								}//End foreach ?>
							</select>
                       
							<select class="mdb-select colorful-select dropdown-default" name="profession" id="profession">
									<option value="none">--- Choisir votre proffession ---</option>
									<?php foreach($professionAvailable as $value){ echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';} ?>
							</select>

                            <div class="md-form">
                                <input type="text" id="department" name="department" class="form-control" value="Martinique" disabled>
                                <label for="department">Département</label>
                            </div>
                            
                            <div class="md-form">
                                <select name="city" id="city" class="form-control">
									<option value="0" selected disabled>-- Commune --</option>
									<?php foreach ($cityAvailable as $value): ?>
										<option value="<?=$value['id'];?>"><?=$value['name'];?></option>
									<?php endforeach; ?>
								</select>
                            </div>
                            
							<div class="md-form">
        						<input type="text" name="date_start" id="date_start" placeholder="jj/mm/aaaa">
                                <label for="date_start">Date de début</label>
                            </div>
                            
                            <div class="md-form">
        						<input type="text" name="date_end" id="date_end" placeholder="jj/mm/aaaa">
                                <label for="date_end">Date de fin</label>
                            </div>

                            <div class="text-center">
                               
                                <button id="log" class="btn btn-lg btn-rounded btn-primary">Suivant</button>
                               
                            </div>
                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Fermer*</button>
                            <p>*Les informations ne seront pas enregistrées</p>
                        </div>
                    </div>
                    <!--/Content-->
                </div>
            </div>
<!--/Modal step 1-->













<a class="btn btn-lg btn-rounded btn-primary" data-toggle="modal" data-target="#modal-reservation">Publier une Annonce</a>