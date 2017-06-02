<?php

	if(!empty($_POST)){
		
		$post = array_map('trim',array_map('strip_tags',$_POST));

		require('../include/connect.php');
		
//		if(isset($post['profession_id']) && isset($post['offer_id']) && isset($post['city_id'])){
//			
//			$select = $bdd->prepare('SELECT * FROM ad WHERE profession_id=:profession_id AND offer_id=:offer_id AND city_id=:city_id');
//			$select->bindValue(':profession_id',$post['profession_id']);
//			$select->bindValue(':offer_id',$post['offer_id']);
//			$select->bindValue(':city_id',$post['city_id']);
//			
//			if($select->execute()){
//
//				$data = $select->fetchAll(PDO::FETCH_ASSOC);
//
//				echo count($data).' annonce(s)';
//
//			}
//		}
		if(isset($post['profession_id']) && isset($post['offer_id']) && isset($post['city_id'])){
			
//			if(isset($post['profession_id'])){$profession_id=$post['profession_id'];}else{$profession_id=0;}
//			if(isset($post['offer_id'])){$offer_id=$post['offer_id'];}else{$offer_id=0;}
//			if(isset($post['city_id'])){$city_id=$post['city_id'];}else{$city_id=0;}
//			
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

				echo count($data).' annonce(s)';

			}
		}
//		elseif(isset($post['profession_id'])){
//
//			$select = $bdd->prepare('SELECT * FROM ad WHERE profession_id=:id');
//			$select->bindValue(':id',$post['profession_id']);
//
//			if($select->execute()){
//
//				$data = $select->fetchAll(PDO::FETCH_ASSOC);
//
//				echo count($data).' annonce(s)';
//
//			}
//			
//		}
//		elseif(isset($post['offer_id'])){
//		
//			$select = $bdd->prepare('SELECT * FROM ad WHERE offer_id=:id');
//			$select->bindValue(':id',$post['offer_id']);
//
//			if($select->execute()){
//
//				$data = $select->fetchAll(PDO::FETCH_ASSOC);
//
//				echo count($data).' annonce(s)';
//
//			}
//		}
//		elseif(isset($post['city_id'])){
//		
//			$select = $bdd->prepare('SELECT * FROM ad WHERE city_id=:id');
//			$select->bindValue(':id',$post['city_id']);
//
//			if($select->execute()){
//
//				$data = $select->fetchAll(PDO::FETCH_ASSOC);
//
//				echo count($data).' annonce(s)';
//
//			}
//		}
		
	}
	else{
		echo'Vous n\'avez pas préciser de profession';
	}

?>