<?php

	require_once( 'system/core/base.php' );

	function beginSession ( $userId )
	{
		session_start();

		$_SESSION["julietLogin"] = hash( "whirlpool", uniqid( rand(), true ) );
		$_SESSION["julietTime"] = time();
		$_SESSION["userId"] = $userId;
	}

	function logoutSession ()
	{
		session_destroy();
		session_unset();
		header( "Location: " . constant("BASE_URL") );
	}

	function ctrlTimeSession ()
	{
		if ( isset( $SESSION["julietTime"] ) and array_key_exists("julietLogin", $_SESSION) )
		{
			$SESSION["julietTime"] = time();

			if ( time() - $SESSION["julietTime"] > 900 )
			{
				logoutSession();
			}
		}
	}

	function isSessionOn ()
	{
		if ( !isset( $_SESSION ) or !array_key_exists("julietLogin", $_SESSION) )
		{
			if ( constant("BASE_URL") !== constant("FULL_URL") )
			{
				header("Location: " . constant("BASE_URL"));
			}
		}
	}

?>