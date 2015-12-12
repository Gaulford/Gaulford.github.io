<?php

	require_once( 'system/core/base.php' );
	require_once( 'system/core/connect.php' );
	require_once( 'system/core/session-control.php' );

	function dbSelect( $dbConnection, $tableName, $columnsName, $where )
	{
		$dbConnection = dbConnection( $GLOBALS["dbServerName"], $GLOBALS["dbConnectionInfo"] );
		$columnsCount = array();
		$allItens = array();

		if ( empty( $tableName ) )
		{
			throw new Exception( "Nome da tabela não especificado." );
		}

		if ( !is_array( $columnsName ) )
		{
			throw new Exception( "As colunas devem ser um array." );
		}

		for ( $i = 0; $i < count( $columnsName ); $i++ )
		{
			$columnsCount[$i] =  "?";
		}

		$columnsCount = implode( ", ", $columnsCount );

		if ( !empty( $where ) and is_array( $where ) )
		{
			foreach ( $where as $value )
			{
				array_push( $columnsName, $value );
			}

			$sqlQuery = "select ?, ? from $tableName where ? = ?";
		}
		else
		{
			$sqlQuery = "select $columnsCount from $tableName";
		}

		$sqlRun = sqlsrv_query( $dbConnection, $sqlQuery, $columnsName );

		var_dump( $sqlRun );

		if ( !$sqlRun )
		{
			$errors = implode( ", ", sqlsrv_errors() );
			throw new Exception( "Ocorreram erros durante o carregamento dos dados: " . $errors );
		}
		else
		{
			while( $queryRows = sqlsrv_fetch_array( $sqlRun, SQLSRV_FETCH_ASSOC ) )
			{
				array_push( $allItens, $queryRows );
			}

			die();

			return $allItens;
		}
	}

?>