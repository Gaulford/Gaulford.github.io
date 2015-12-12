<?php
	require_once("/system/core/session-control.php");

	if ( $_SERVER['REQUEST_METHOD'] === "GET" )
	{
		require_once("/system/core/connect.php");

		$checkUserData = false;
		$sqlUser = false;

		if ( array_key_exists( "update", $_GET ) )
		{
			$sqlQueryUsers = "
				select 
				loginUsuario as 'Login', 
				nomeUsuario as 'Nome', 
				tipoPerfil as 'Perfil', 
				usuarioAtivo as 'Ativo' 
				from Usuario 
				where idUsuario = ?
			";

			$sqlUsersInputs = array( $_GET["update"] );
			$sqlRunUsers = sqlsrv_query( $onConnect, $sqlQueryUsers, $sqlUsersInputs );
			$sqlUser = array();

			if( !$sqlRunUsers ) {
			    die( print_r( sqlsrv_errors(), true) );
			}

			while ( $queryRows = sqlsrv_fetch_array( $sqlRunUsers, SQLSRV_FETCH_ASSOC ) )
			{
				array_push( $sqlUser, $queryRows );
			}

			$checkUserData = isset( $sqlUser ) and !empty( $sqlUser );
		}

		$sqlQueryProfile = "
			select 
			tipoPerfil 
			from Usuario 
			group by tipoPerfil
		";

		$sqlRunProfile = sqlsrv_query( $onConnect, $sqlQueryProfile );
		$allProfile = array();

		if( !$sqlRunProfile )
		{
		    die( print_r( sqlsrv_errors(), true) );
		}

		while( $queryRows = sqlsrv_fetch_array( $sqlRunProfile, SQLSRV_FETCH_ASSOC ) )
		{
			array_push($allProfile, $queryRows);
		}

		function showData( $itemToCheck, $trueShow, $falseShow )
		{
			if ( isset( $itemToCheck ) && $itemToCheck )
			{
				echo $trueShow;
			}
			else if ( isset( $falseShow ) && $falseShow  )
			{
				echo $falseShow;
			}
		}

	}
	else if ( $_SERVER['REQUEST_METHOD'] === "POST" and array_key_exists( "update", $_POST )  )
	{
		require_once("/system/core/connect.php");

		$sqlQueryInputs = $_POST;

		$sqlQueryInputs = array(
			$sqlQueryInputs["name-user"],
		    $sqlQueryInputs["login-user"],
		    hash( "sha256", $sqlQueryInputs["password-user"] ),
		    $sqlQueryInputs["profile-user"],
		    $sqlQueryInputs["user-active"],
		    $sqlQueryInputs["update"]
		);

		$sqlQuery = "
			update Usuario 
			set 
			nomeUsuario = ?, 
			loginUsuario = ?, 
			senhaUsuario = ?, 
			tipoPerfil = ?, 
			usuarioAtivo = ? 
			where idUsuario = ?
		";

		$sqlInsertProducts = sqlsrv_query( $onConnect, $sqlQuery, $sqlQueryInputs );

		if( !$sqlInsertProducts )
		{
		    die( print_r( sqlsrv_errors(), true) );
		}
		else
		{
			header( "Location: lista-usuarios.php" );
		}
		
	}
	else
	{
		require_once("/system/core/connect.php");

		$sqlQueryInputs = $_POST;

		$sqlQueryInputs = array(
			$sqlQueryInputs["name-user"],
		    $sqlQueryInputs["login-user"],
		    hash( "sha256", $sqlQueryInputs["password-user"] ),
		    $sqlQueryInputs["profile-user"],
		    $sqlQueryInputs["user-active"]
		);

		$sqlQuery = "
			insert into 
			Usuario 
			(nomeUsuario, 
			loginUsuario, 
			senhaUsuario, 
			tipoPerfil, 
			usuarioAtivo) 
			values 
			(?, ?, ?, ?, ?)
		";

		$sqlInsertProducts = sqlsrv_query( $onConnect, $sqlQuery, $sqlQueryInputs );

		if( !$sqlInsertProducts )
		{
		    die( print_r( sqlsrv_errors(), true) );
		}
		else
		{
			header( "Location: lista-usuarios.php" );
		}
	}
?>