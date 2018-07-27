<?php
session_start();
include("connection.php");

$idpengguna=$_POST["idpengguna"];
$katalaluan=md5($_POST["katalaluan"]);

$sql="SELECT * from tbl_pengguna WHERE idpengguna = '$idpengguna' AND katalaluan = '$katalaluan' AND sekat = 0";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
$rowcount = mysqli_num_rows($result);

if($rowcount>0){
    $_SESSION["isadmin"] = "yes";
    $_SESSION["siapa"] = $row["nama"];
    echo "yes";
}else{
    echo "no";
}
mysqli_close($conn);

?>