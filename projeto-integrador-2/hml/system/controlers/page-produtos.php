<?php
	require_once("/system/core/session-control.php");

	if ( $_SERVER['REQUEST_METHOD'] === "GET" )
	{
		require_once("/system/core/connect.php");

		if ( array_key_exists( "update", $_GET ) )
		{
			$sqlQueryProducts = "
				select 
				nomeProduto as 'Produto', 
				descProduto as 'Descricao', 
				PrecProduto as 'Preco', 
				descontoPromocao as 'Desconto', 
				Categoria.idCategoria as 'idCategoria', 
				nomeCategoria as 'Categoria', 
				ativoProduto as 'Ativo', 
				qtdMinEstoque as 'Estoque', 
				imagem as 'Imagem' 
				from Produto 
				left join Categoria 
				on Produto.idCategoria = Categoria.idCategoria 
				where idProduto = ?
			";

			$sqlProductsInputs = array( $_GET["update"] );
			$sqlRunProducts = sqlsrv_query( $onConnect, $sqlQueryProducts, $sqlProductsInputs );
			$sqlProduct = array();

			if( !$sqlRunProducts ) {
			    die( print_r( sqlsrv_errors(), true) );
			}

			while ( $queryRows = sqlsrv_fetch_array( $sqlRunProducts, SQLSRV_FETCH_ASSOC ) )
			{
				array_push( $sqlProduct, $queryRows );
			}

			$checkProductData = isset( $sqlProduct ) and !empty( $sqlProduct );
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

		function showData( $itemToCheck, $trueShow, $falseShow )
		{
			if ( $itemToCheck )
			{
				echo $trueShow;
			}
			else
			{
				echo $falseShow;
			}
		}

	}
	else if ( $_SERVER['REQUEST_METHOD'] === "POST" and array_key_exists( "update", $_POST )  )
	{
		require_once("/system/core/connect.php");
	}
	else
	{

	}
?>