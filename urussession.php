<?php
	session_start();

	$_SESSION["pergike"] = $_GET["pergi"];
?>
<script>
	// alert('masuk');
	document.location.replace('mula.php')
</script>