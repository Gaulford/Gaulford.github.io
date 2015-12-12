<?php
	require_once("/system/core/session-control.php");

	if ( $_SERVER['REQUEST_METHOD'] === "GET" )
	{
		require_once("/system/core/connect.php");

		$checkCategoriaData = false;
		$sqlCategoria = false;

		if ( array_key_exists( "update", $_GET ) )
		{
			$sqlQueryCategorias = "
				select 
				nomeCategoria as 'Categoria', 
				descCategoria as 'Descricao' 
				from Categoria 
				where idCategoria = ?
			";

			$sqlCategoriasInputs = array( $_GET["update"] );
			$sqlRunCategorias = sqlsrv_query( $onConnect, $sqlQueryCategorias, $sqlCategoriasInputs );
			$sqlCategoria = array();

			if( !$sqlRunCategorias ) {
			    die( print_r( sqlsrv_errors(), true) );
			}

			while ( $queryRows = sqlsrv_fetch_array( $sqlRunCategorias, SQLSRV_FETCH_ASSOC ) )
			{
				array_push( $sqlCategoria, $queryRows );
			}

			$checkCategoriaData = isset( $sqlCategoria ) and !empty( $sqlCategoria );
		}

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

		$sqlQueryInputs = $_POST;

		$sqlQueryInputs = array(
			$sqlQueryInputs["name-category"],
		    $sqlQueryInputs["desc-category"],
		    $sqlQueryInputs["update"]
		);

		$sqlQuery = "
			update Categoria 
			set 
			nomeCategoria = ?, 
			descCategoria = ? 
			where idCategoria = ?
		";

		$sqlInsertProducts = sqlsrv_query( $onConnect, $sqlQuery, $sqlQueryInputs );

		if( !$sqlInsertProducts )
		{
		    die( print_r( sqlsrv_errors(), true) );
		}
		else
		{
			header( "Location: lista-categorias.php" );
		}
		
	}
	else
	{
		require_once("/system/core/connect.php");

		$sqlQueryInputs = $_POST;

		$sqlQuery = "
			insert into 
			Categoria 
			(nomeCategoria, 
			descCategoria) 
			values 
			(?, ?)
		";

		$sqlQueryInputs = array(
			$sqlQueryInputs["name-category"],
		    $sqlQueryInputs["desc-category"]
		);

		$sqlInsertCategory = sqlsrv_query( $onConnect, $sqlQuery, $sqlQueryInputs );

		if( !$sqlInsertCategory )
		{
		    die( print_r( sqlsrv_errors(), true) );
		}
		else
		{
			echo "Works!";
		}
	}
?>