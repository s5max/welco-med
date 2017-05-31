<?php

require('include/connect.php');

    if(!empty($_POST)){
        
        $error = [];
            
        $post = array_map('trim',array_map('strip_tags',$_POST));
        
        //Vérifications diverses
        
        //La profession
        $professionAllowed = ['Chirurgien-Dentiste','Infirmier/Infirmière','Kinésithérapeute','Médecin','Orthophoniste','Osthéopate','Pédiatre'];
        
        if(!in_array($post['profession'],$professionAllowed)){
            
            $error[] = '<select class="mdb-select colorful-select dropdown-default" name="profession1" id="profession1">
                                <option value="none">Choisir son métier</option>
								<option value="Chirurgien-Dentiste">Chirurgien-Dentiste</option>
								<option value="Infirmier/Infirmière">Infirmier/Infirmière</option>
								<option value="Kinésithérapeute">Kinésithérapeute</option>
								<option value="Médecin">Médecin</option>
								<option value="Orthophoniste">Orthophoniste</option>
								<option value="Osthéopate">Osthéopate</option>
								<option value="Pédiatre">Pédiatre</option>
                            </select>
							<p>Seuls les professions de la liste sont acceptées</p>';
        }
        
        
        //Le nom
        if(strlen($post['firstname']) < 3 || strlen($post['firstname']) > 255){
            
            $error[] = '<div class="md-form">
                                <input type="text" name="firstname" id="firstname" class="form-control">
                                <label for="firstname">Votre Nom</label>
                            </div><p>Le nombre de caractère de votre Nom doit être compris entre 3 et 255</p>';
        }
//		else{
//			echo'<div class="md-form">
//                                <input type="text" name="firstname" id="firstname" class="form-control" value="'.$post['firstname'].'">
//                                <label for="firstname">Votre Nom</label>
//                            </div>';
//		}
        
        
        //Le prénom
        if(strlen($post['lastname']) < 3 || strlen($post['lastname']) > 255){
            
            $error[] = '<div class="md-form">
                                <input type="text" name="lastname" id="lastname" class="form-control">
                                <label for="lastnamelastname">Votre Prénom</label>
                            </div><p>Le nombre de caractère de votre Prénom doit être compris entre 3 et 255</p>';
        }
        
        
        //adresse
        if(strlen($post['address']) < 5 || strlen($post['address']) > 255){
            
            $error[] = '<div class="md-form">
                                <input type="text" name="address" id="address" class="form-control">
                                <label for="address">Adresse</label>
                            </div><p>Ceci n\'est pas une adresse valide</p>';
        }
        
        
        //zipcode
        if(!is_numeric($post['zipcode']) || strlen($post['zipcode']) != 5){
            
            $error[] = '<div class="md-form">
                                <input type="text" name="zipcode" id="zipcode" class="form-control">
                                <label for="zipcode">Code Postal</label>
                            </div><p>Le Code postal n\'est pas dans un format convenable</p>';   
        }
        
        //city
        if(strlen($post['city']) < 3 || strlen($post['city']) > 255){
            
            $error[] = '<div class="md-form">
                                <input type="text" name="city" id="city" class="form-control">
                                <label for="city">Ville</label>
                            </div><p>Le nombre de caractère de la ville doit être compris entre 3 et 255</p>';
        }
        
        //departement
        if(strlen($post['department']) < 3 || strlen($post['department']) > 255){
            
            $error[] = '<div class="md-form">
                                <input type="text" name="department" id="department" class="form-control">
                                <label for="department">Département</label>
                            </div><p>Le nombre de caractère du département doit être compris entre 3 et 255</p>';
        }
        
        //telephone
        if(!is_numeric($post['telephone']) || strlen($post['telephone']) != 5){
            
            $error[] = '<div class="md-form">
                                <input type="text" name="telephone" id="telephone" class="form-control">
                                <label for="telephone">Téléphone</label>
                            </div><p>Le numéro de téléphone n\'est pas dans un format convenable</p>';   
        }
        
        //email
        if(!filter_var($post['email'],FILTER_VALIDATE_EMAIL)){
            $error[] = '<div class="md-form">
                                <input type="text" name="email" id="email" class="form-control">
                                <label for="email">Email</label>
                            </div><p>L\'adresse email n\'est pas dans un format valide</p>';
        }
        else{
            
            //Vérifier que l'email n'existe pas
            $select = $bdd->prepare('SELECT email from users WHERE email = :email');

            $select->bindValue(':email',$post['email']);

            if(!$select->execute()){
                $error[] = '<div class="md-form">
                                <input type="text" name="email" id="email" class="form-control">
                                <label for="email">Email</label>
                            </div><p>Cet email est déjà lié à un compte</p>';
            }
        }
        
        //password
        if(strlen($post['password']) < 6){
            $error[] = '<div class="md-form">
                                <input type="password" name="password" id="password" class="form-control">
                                <label for="password">Mot de Passe</label>
                            </div><p>Le mot de passe doit contenir au moins 6 caractères</p>';
        }
        else{
            
            //Crypté le mot de passe
            $password = password_hash($post['password'], PASSWORD_DEFAULT);
            
        }
    
        
        
        if(count($error) === 0){

            $insert = $bdd->prepare('INSERT INTO users(profession,firstname,lastname,address,city,zipcode,department,telephone,email,password,role)VALUES(:profession,:firstname,:lastname,:address,:city,:zipcode,:department,:telephone,:email,:password,:role)');

            $insert->bindValue(':profession',$post['profession']);
            $insert->bindValue(':firstname',$post['firstname']);
            $insert->bindValue(':lastname',$post['lastname']);
            $insert->bindValue(':address',$post['address']);
            $insert->bindValue(':city',$post['city']);
            $insert->bindValue(':zipcode',$post['zipcode']);
            $insert->bindValue(':department',$post['department']);
            $insert->bindValue(':telephone',$post['telephone']);
            $insert->bindValue(':email',$post['email']);
            $insert->bindValue(':password',$password);
            $insert->bindValue(':role','user');
            
            if($insert->execute()){
               	
                header('location:/WELCOMED2/user/login.php');
            }
        }
        else{
        
            echo implode($error,'<br>');
        }
    
    }//Fin(!empty($_POST))
else{
	
	echo 'Vous devez remplir le fomulaire pour vous inscrire';
}