<?php

	session_start();

	if ( !isset( $_SESSION ) or !array_key_exists("julietLogin", $_SESSION) )
	{
		$currentUrl = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		$baseUrl = "http://" . $_SERVER["SERVER_NAME"] . "/2c/";

		if ( $currentUrl !== $baseUrl )
		{
			header("Location: $baseUrl");
			
		}
	}

	if ( $_SERVER['REQUEST_METHOD'] === "GET" and array_key_exists("logout", $_GET) )
	{
		session_destroy();
		session_unset();
		header("Location: /2c/");
	}

?>