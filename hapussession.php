<?php
session_start();
// unset ($_SESSION['isadmin']);
session_destroy();
?>
<script>
	document.location.replace('mula.php')
</script>