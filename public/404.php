<?php

	header("HTTP/1.0 404 Not Found");
	header("Status: 404 Not Found");

?>
Asset not found (<?php echo $_SERVER['REQUEST_URI']; ?>)
