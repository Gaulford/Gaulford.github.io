<?php
	require_once("/system/core/session-control.php");

	if ( $_SERVER['REQUEST_METHOD'] === "POST" )
	{
		require_once("/system/core/connect.php");

		$sqlQuery = "select idUsuario, loginUsuario, senhaUsuario from Usuario where loginUsuario = ?";
		$sqlInputs = array( $_POST["admin-username"] );
		$sqlRun = sqlsrv_query( $onConnect, $sqlQuery, $sqlInputs );

		if ( !$sqlRun )
		{
			die( var_dump( sqlsrv_errors(), true ) );
			exit();
		}
		else if ( !sqlsrv_fetch( $sqlRun ) )
		{
			die( var_dump( sqlsrv_errors(), true ) );
			exit();
		}
		else
		{
			$username = $_POST["admin-username"];
			$password = hash( "sha256", $_POST["admin-pass"] );
			$dbIdUser = sqlsrv_get_field( $sqlRun, 0 );
			$dbUsername = sqlsrv_get_field( $sqlRun, 1 );
			$dbPassword = sqlsrv_get_field( $sqlRun, 2 );

			if ( $username === $dbUsername and $password === $dbPassword )
			{
				$_SESSION["julietLogin"] = hash( "whirlpool", uniqid( rand(), true ) );
				$_SESSION["julietTime"] = time();
				$_SESSION["userId"] = $dbIdUser;

				header("Location: /produtos.php");
			}
		}
	}

?>