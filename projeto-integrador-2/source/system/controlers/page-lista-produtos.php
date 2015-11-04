<?php
	require_once("/system/core/session-control.php");

	if ( $_SERVER['REQUEST_METHOD'] === "GET" )
	{
		require_once("/system/core/connect.php");

		if ( array_key_exists( "delete", $_GET ) )
		{
			$sqlQuery = "
				delete 
				from Produto 
				where idProduto = ?
			";

			$sqlInputs = array( $_GET["delete"] );
			$slRun = sqlsrv_query( $onConnect, $sqlQuery, $sqlInputs );
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