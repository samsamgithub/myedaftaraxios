<?php
$hostname="localhost";
$idpengguna="root";
$katalaluan="root123";
$pangkalandata="edaftar";

// Create connection
$conn = mysqli_connect($hostname,$idpengguna,$katalaluan,$pangkalandata);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
