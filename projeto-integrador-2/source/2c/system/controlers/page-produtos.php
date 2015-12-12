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

		$dbImageOpen = fopen( $_FILES["image_product"]["tmp_name"], "rb" );
		$dbImageContent = fread( $dbImageOpen, filesize( $_FILES["image_product"]["tmp_name"] ) );
		fclose( $dbImageOpen );

		$dbImageContent = array(
			$dbImageContent,
			SQLSRV_PARAM_IN, 
            SQLSRV_PHPTYPE_STREAM(SQLSRV_ENC_BINARY), 
            SQLSRV_SQLTYPE_VARBINARY('max')
		);

		$sqlQueryInputs = array(
			$sqlQueryInputs["name_product"],
		    $sqlQueryInputs["desc_product"],
		    $sqlQueryInputs["price_product"],
		    $sqlQueryInputs["discount_product"],
		    $sqlQueryInputs["category_product"],
		    $sqlQueryInputs["active_product"],
		    $_SESSION["userId"],
		    $sqlQueryInputs["inventory_product"],
		    $dbImageContent,
		    $sqlQueryInputs["update"]
		);

		$sqlQuery = "
			update Produto 
			set 
			nomeProduto = ?, 
			descProduto = ?, 
			PrecProduto = ?, 
			descontoPromocao = ?, 
			idCategoria = ?, 
			ativoProduto = ?, 
			idUsuario = ?, 
			qtdMinEstoque = ?, 
			imagem = ? 
			where idProduto = ?
		";

		$sqlInsertProducts = sqlsrv_query( $onConnect, $sqlQuery, $sqlQueryInputs );

		if( !$sqlInsertProducts )
		{
		    die( print_r( sqlsrv_errors(), true) );
		}
		else
		{
			header( "Location: lista-produtos.php" );
		}
		
	}
	else
	{
		require_once("/system/core/connect.php");

		$sqlQueryInputs = $_POST;

		$dbImageOpen = fopen( $_FILES["image_product"]["tmp_name"], "rb" );
		$dbImageContent = fread( $dbImageOpen, filesize( $_FILES["image_product"]["tmp_name"] ) );
		fclose( $dbImageOpen );

		$dbImageContent = array(
			$dbImageContent,
			SQLSRV_PARAM_IN, 
            SQLSRV_PHPTYPE_STREAM(SQLSRV_ENC_BINARY), 
            SQLSRV_SQLTYPE_VARBINARY('max')
		);

		$sqlQueryInputs = array(
			$sqlQueryInputs["name_product"],
		    $sqlQueryInputs["desc_product"],
		    $sqlQueryInputs["price_product"],
		    $sqlQueryInputs["discount_product"],
		    $sqlQueryInputs["category_product"],
		    $sqlQueryInputs["active_product"],
		    $_SESSION["userId"],
		    $sqlQueryInputs["inventory_product"],
		    $dbImageContent
		);

		$sqlQuery = "
			insert into 
			Produto 
			(nomeProduto, 
			descProduto, 
			PrecProduto, 
			descontoPromocao, 
			idCategoria, 
			ativoProduto, 
			idUsuario, 
			qtdMinEstoque, 
			imagem) 
			values 
			(?, ?, ?, ?, ?, ?, ?, ?, ?)
		";

		$sqlInsertProducts = sqlsrv_query( $onConnect, $sqlQuery, $sqlQueryInputs );

		if( !$sqlInsertProducts )
		{
		    die( print_r( sqlsrv_errors(), true) );
		}
		else
		{
			header( "Location: lista-produtos.php" );
		}
	}
?>