<?php

	require_once("/system/core/base.php");
	require_once("/system/core/session-control.php");

	isSessionOn();
	ctrlTimeSession();

	if ( $_SERVER['REQUEST_METHOD'] === "GET" )
	{
		require_once("/system/core/connect.php");

		print_r(array_key_exists( "delete", $_GET ));
		die();

		if ( array_key_exists( "delete", $_GET ) )
		{
			$sqlQuery = "
				delete 
				from Estoque 
				where idProduto = ?
			";

			$sqlInputs = array( $_GET["delete"] );
			$sqlRun = sqlsrv_query( $onConnect, $sqlQuery, $sqlInputs );

			print_r($sqlRun);
			die();

			if ( $sqlRun !== false )
			{
				$sqlQuery = "
					delete 
					from Produto 
					where idProduto = ?
				";

				$slRun = sqlsrv_query( $onConnect, $sqlQuery, $sqlInputs );

				if ( !$sqlRun )
				{
					die( print_r( sqlsrv_errors(), true) );
				}
			}
			else
			{
				die( print_r( sqlsrv_errors(), true) );
			}
		}

		$sqlQuery = "
			select 
			idProduto as 'Id', 
			nomeProduto as 'Produto', 
			precProduto as 'Preco', 
			descontoPromocao as 'Desconto' 
			from Produto
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