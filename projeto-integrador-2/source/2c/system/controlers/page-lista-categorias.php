<?php
	require_once("/system/core/session-control.php");

	if ( $_SERVER['REQUEST_METHOD'] === "GET" )
	{
		require_once("/system/core/connect.php");

		if ( array_key_exists( "delete", $_GET ) )
		{
			$warning = "";
			$isUsed = false;

			$checkCategoryUse = "
				select 
				Categoria.idCategoria 
				from Categoria 
				left join Produto 
				on Categoria.idCategoria = Produto.idCategoria 
				where Produto.idCategoria is null
			";

			$sqlRun = sqlsrv_query( $onConnect, $checkCategoryUse );
			$allUnsedCategory = array();

			if( !$sqlRun ) {
			    die( print_r( sqlsrv_errors(), true) );
			}

			while( $queryRows = sqlsrv_fetch_array( $sqlRun, SQLSRV_FETCH_ASSOC ) )
			{
				array_push($allUnsedCategory, $queryRows);
			}

			for( $i = 0; $i < count( $allUnsedCategory ); $i++ )
			{
				if ( in_array( intval( $_GET["delete"] ), $allUnsedCategory[$i] ) )
				{
					$isUsed = true;
				}
			}

			if ( $isUsed )
			{
				$sqlQuery = "
					delete 
					from Categoria 
					where idCategoria = ?
				";

				$sqlInputs = array( $_GET["delete"] );
				$slRun = sqlsrv_query( $onConnect, $sqlQuery, $sqlInputs );
			}
			else
			{
				$warning = "A categoria não pode ser excluida pois está vinculada a um ou mais produtos.";
			}
		}

		$sqlQuery = "
			select 
			idCategoria as 'Id', 
			nomeCategoria as 'Categoria', 
			descCategoria as 'Descricao'
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