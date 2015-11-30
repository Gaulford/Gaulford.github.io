<?php
	require_once("system/core/session-control.php");

	if ( $_SERVER['REQUEST_METHOD'] === "GET" )
	{
		require_once("system/core/connect.php");

		if ( array_key_exists( "delete", $_GET ) )
		{
			$sqlDeleteEstoque = "
				delete 
				from Estoque 
				where idProduto = ?
			";

			$sqlDeleteProduct = "
				delete 
				from Produto 
				where idProduto = ?
			";

			$sqlInputs = array( $_GET["delete"] );
			$sqlRunEstoque = sqlsrv_query( $onConnect, $sqlDeleteEstoque, $sqlInputs );
			$sqlRunProduto = sqlsrv_query( $onConnect, $sqlDeleteProduct, $sqlInputs );

			if( !$sqlRunEstoque ) {
			    die( print_r( sqlsrv_errors(), true) );
			}

			if( !$sqlRunProduto ) {
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