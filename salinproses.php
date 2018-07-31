<?php
// include("libs.php");
include("connection.php");

$fromprog=$_POST["fromprogram"];
$toprog=$_POST["toprogram"];

$sql0 = "select t1.nama as nama, t1.emel as emel, t1.agensi as agensi, t1.idrec as idpeserta
from tbl_peserta t1, tbl_kehadiran t2
where t1.idrec=t2.idpeserta and t1.papar=1 and t2.idprogram='$fromprog'";
$result0 = mysqli_query($conn, $sql0);
$bilrec=0;
while($row0 = mysqli_fetch_array($result0)){
  $bilrec++;
  $namapeserta = $row0["nama"];
  $emelpeserta = $row0["emel"];
  $agensipeserta = $row0["agensi"];
  $idpeserta = $row0["idpeserta"];

  $sql1 = "INSERT INTO tbl_peserta (nama, emel, agensi, papar)
VALUES ('$namapeserta', '$emelpeserta', '$agensipeserta', 1)";
  $result1 = mysqli_query($conn, $sql1);

  $sql2 = "INSERT INTO tbl_kehadiran (idprogram, idstatus)
VALUES ('$toprog', 0)";
  $result2 = mysqli_query($conn, $sql2);
}
// $berjaya=array("berjaya");
//   echo json_encode($berjaya);

  $berjaya1=$bilrec." Data Berjaya Disalin";
  echo $berjaya1;
//  echo $_POST["toprogram"];
?>

