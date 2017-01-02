<?php
session_start();

function checkAdmin(){
	if($_SESSION['logged_in'] == true){
		if($_SESSION['admin'] == true){
			return "admin";
		}
		else{
			return "editor";
		}
	}else{
		return "nothing";
	}
}

 ?>