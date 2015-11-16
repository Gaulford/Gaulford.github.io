<?php
	require_once("/system/core/session-control.php");

	if ( $_SERVER['REQUEST_METHOD'] === "GET" )
	{
		require_once("/system/core/connect.php");

		$checkProductData = false;
		$sqlProduct = false;

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
			if ( isset( $itemToCheck ) )
			{
				echo $trueShow;
			}
			else if ( isset( $falseShow )  )
			{
				echo $falseShow;
			}
		}

	}
	else if ( $_SERVER['REQUEST_METHOD'] === "POST" and array_key_exists( "update", $_POST )  )
	{
		require_once("/system/core/connect.php");

		$sqlQueryInputs = array( $_POST );
		$sqlQueryInputs = $sqlQueryInputs[0];
		$dbImage = addslashes( file_get_contents( $_FILES["image_product"]["tmp_name"] ) );

		$sqlQueryInputs = array(
			"name_product" => $sqlQueryInputs["name_product"],
		    "desc_product" => $sqlQueryInputs["desc_product"],
		    "price_product" => $sqlQueryInputs["price_product"],
		    "discount_product" => $sqlQueryInputs["discount_product"],
		    "category_product" => $sqlQueryInputs["category_product"],
		    "active_product" => $sqlQueryInputs["active_product"],
		    "idUsuario" => $_SESSION["userId"],
		    "inventory_product" => $sqlQueryInputs["inventory_product"],
		    "imagem" => $dbImage,
		    "id_product" => $sqlQueryInputs["update"]
		);

		echo "<pre>";
		print_R( $sqlQueryInputs );
		echo "</pre>";
		die();

		$sqlQuery = "
			update Produto 
			set 
			nomeProduto = ? 
			descProduto = ? 
			precProduto = ? 
			descontoPromocao = ? 
			idCategoria = ? 
			ativoProduto = ? 
			idUsuario = ? 
			qtdMinEstoque = ? 
			imagem = ? 
			where idProduto = ?
		";

		$sqlInsertProducts = sqlsrv_query( $onConnect, $sqlQuery, $sqlQueryInputs );

		if( !$sqlInsertProducts )
		{
		    die( print_r( sqlsrv_errors(), true) );
		}
		
	}
	else
	{

	}
?>