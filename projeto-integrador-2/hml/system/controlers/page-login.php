<?php
	require_once("/system/core/session-control.php");

	if ( $_SERVER['REQUEST_METHOD'] === "POST" )
	{
		require_once("/system/core/connect.php");

		$sqlQuery = "select loginUsuario, senhaUsuario from Usuario where loginUsuario = ?";
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
			$password = md5( $_POST["admin-pass"] );
			$dbUsername = sqlsrv_get_field( $sqlRun, 0 );
			$dbPassword = sqlsrv_get_field( $sqlRun, 1 );

			if ( $username === $dbUsername and $password === $dbPassword )
			{
				$_SESSION["julietLogin"] = md5( uniqid( rand(), true ) );
				$_SESSION["julietTime"] = time();

				header("Location: /produtos.php");
			}
		}
	}

?>