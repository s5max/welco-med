<?php

	session_start();

	if(!isset($_SESSION['user'])){
		header('location:/git/welco-med/home.php');
		die();
	}


