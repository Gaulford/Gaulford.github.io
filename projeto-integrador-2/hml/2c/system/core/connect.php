<?php

	$serverName = "i9yueekhr9.database.windows.net";
	$connectInfo = array(
		"Database" => "juliet",
		"UID" => "TSI",
		"PWD" => "SistemasInternet123",
		"CharacterSet" => "UTF-8"
	);

	$onConnect = sqlsrv_connect( $serverName, $connectInfo );

	if ( !$onConnect )
	{
		die( print_r( sqlsrv_errors(), true ) );
	}

?>