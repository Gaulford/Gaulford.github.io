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

?>