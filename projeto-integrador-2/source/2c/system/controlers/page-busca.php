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

		if ( array_key_exists("busca", $_GET) )
		{

			if ( array_key_exists("categoria", $_GET) and $_GET["categoria"] !== "" )
			{
				$sqlQuery = "
					select 
					idProduto, 
					nomeProduto, 
					precProduto, 
					descontoPromocao, 
					nomeCategoria 
					from Produto 
					left join Categoria 
					on Produto.idCategoria = Categoria.idCategoria 
					where nomeProduto like ? and nomeCategoria = ?
				";

				$sqlInputs = array( "%".$_GET["busca"]."%", $_GET["categoria"] );
			}
			else
			{
				$sqlQuery = "
					select 
					idProduto, 
					nomeProduto, 
					precProduto, 
					descontoPromocao, 
					nomeCategoria 
					from Produto 
					left join Categoria 
					on Produto.idCategoria = Categoria.idCategoria 
					where nomeProduto like ?
				";

				$sqlInputs = array( "%".$_GET["busca"]."%" );
			}

			$sqlRun = sqlsrv_query( $onConnect, $sqlQuery, $sqlInputs );
			$searchResult = array();

			if( !$sqlRun )
			{
			    die( print_r( sqlsrv_errors(), true) );
			}

			while( $queryRows = sqlsrv_fetch_array( $sqlRun, SQLSRV_FETCH_ASSOC ) )
			{
				array_push($searchResult, $queryRows);
			}
		}

		$sqlQueryCategoria = "
			select 
			idCategoria, 
			nomeCategoria as 'Categoria' 
			from Categoria
		";

		$sqlRunCategories = sqlsrv_query( $onConnect, $sqlQueryCategoria );
		$allCategories = array();

		if( !$sqlRunCategories )
		{
		    die( print_r( sqlsrv_errors(), true) );
		}

		while( $queryRows = sqlsrv_fetch_array( $sqlRunCategories, SQLSRV_FETCH_ASSOC ) )
		{
			array_push($allCategories, $queryRows);
		}

		$checkCategoryData = isset( $allCategories ) and !empty( $allCategories );
	}
?>