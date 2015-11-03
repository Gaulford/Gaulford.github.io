<?php

	session_start();

	if ( isset( $_SESSION["julietLogin"] ) and $_SESSION["julietLogin"] != "" )
	{
		header("Location: /produtos.php");
	}
	else
	{
		header("Location: /");
	}

?>