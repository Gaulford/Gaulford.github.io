<?php

	require_once( 'system/core/base.php' );
	require_once( 'system/core/session-control.php' );

	isSessionOn();
	ctrlTimeSession();


	if ( $_SERVER['REQUEST_METHOD'] === "POST" )
	{
		require_once("system/core/connect.php");
		require_once("system/core/dbMethods.php");

		$username = $_POST["admin-username"];
		$password = hash( "sha256", $_POST["admin-pass"] );

		$tableUser = "Usuario";
		$whoUser = array(
			"loginUsuario",
			$username
		);
		$userInfos = array(
			"loginUsuario",
			"senhaUsuario"
		);

		$dbConnection = dbConnection( $GLOBALS["dbServerName"], $GLOBALS["dbConnectionInfo"] );
		$dbUserPass = dbSelect( $dbConnection, $tableUser, $userInfos, $whoUser );

		echo "<pre>";
		print_r( $dbUserPass );
		echo "</pre>";

		// if ( $username === $dbUsername and $password === $dbPassword )
		// {
		// 	$_SESSION["julietLogin"] = hash( "whirlpool", uniqid( rand(), true ) );
		// 	$_SESSION["julietTime"] = time();
		// 	$_SESSION["userId"] = $dbIdUser;

		// 	header("Location: /produtos.php");
		// }
	}

?>