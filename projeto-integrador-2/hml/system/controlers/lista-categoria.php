<?php
	require_once("/system/core/session-control.php");

	if ( $_SERVER['REQUEST_METHOD'] === "GET" )
	{
		require_once("/system/core/connect.php");

		if ( array_key_exists( "delete", $_GET ) )
		{
			$sqlQuery = "
				delete 
				from Categoria 
				where idCategoria = ?
			";

			$sqlInputs = array( $_GET["delete"] );
			$slRun = sqlsrv_query( $onConnect, $sqlQuery, $sqlInputs );
		}

		$sqlQuery = "
			select 
			idCategoria as 'Id'
			nomeCategoria as 'Categoria', 
			descCategoria as 'Descriçao'
			from Categoria
		";

		$sqlRun = sqlsrv_query( $onConnect, $sqlQuery );
		$allProducts = array();

		if( !$sqlRun ) {
		    die( print_r( sqlsrv_errors(), true) );
		}

		while( $queryRows = sqlsrv_fetch_array( $sqlRun, SQLSRV_FETCH_ASSOC ) )
		{
			array_push($allProducts, $queryRows);
		}
	}
?>