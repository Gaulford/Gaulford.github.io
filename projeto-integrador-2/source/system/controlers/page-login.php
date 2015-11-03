<?php
	require_once("/system/core/session-control.php");

	if ( isset( $_POST ) ) {
		require_once("/system/core/connect.php");

		$sqlInputs = array( $_POST["admin-username"] );
		$sqlQuery = "select loginUsuario, senhaUsuario from Usuario where loginUsuario = ?";
		$sqlCheck = sqlsrv_prepare( $onConnect, $sqlQuery, $sqlInputs );

		if ( !$sqlCheck )
		{
			die( print_r( sqlsrv_errors(), true ) );
		}

		if ( sqlsrv_execute( $sqlCheck ) === false )
		{
			die( print_r( sqlsrv_errors(), true ) );
		}
		else
		{
			
		}
	}

?>