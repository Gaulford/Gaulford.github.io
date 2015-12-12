<?php

	require_once( 'system/core/base.php' );

	function dbConnection ( $serverName, $credentials )
	{
		$expectedInfos = array(
			"Database" => false,
			"UID" => false,
			"PWD" => false,
			"CharacterSet" => false
		);

		$onConnect;

		if ( empty( $serverName ) and !$serverName )
		{
			throw new Exception( "É necessário inserir o nome do servidor do banco." );
		}

		foreach ( $expectedInfos as $key => $value )
		{
			if ( !array_key_exists( $key, $credentials ) )
			{
				throw new Exception( "O array não possui a credenciais esperada $key." );
			}
		}

		$onConnect = sqlsrv_connect( $serverName, $credentials );

		if( !$onConnect )
		{
			$errors = sqlsrv_errors();
			throw new Exception( "Não foi possível estabelcer a conexão. Erro: $errors" );
		}
		else
		{
			return $onConnect;
		}
	}

?>