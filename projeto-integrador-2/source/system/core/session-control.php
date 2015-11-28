<?php

	session_start();

	if ( !isset( $_SESSION ) or !array_key_exists("julietLogin", $_SESSION) )
	{
		$currentUrl = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

		if ( $currentUrl !== "http://localhost/" )
		{
			header("Location: /");
			
		}
	}

	if ( $_SERVER['REQUEST_METHOD'] === "GET" and array_key_exists("logout", $_GET) )
	{
		session_destroy();
		session_unset();
		header("Location: /");
	}

?>