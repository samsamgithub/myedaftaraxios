<?php
include("connection.php");

$jenisAction=$_POST["jenisAction"];

// echo "<script> alert('masuk');</script>"


switch ($jenisAction) {

    case "createProgram":
		$namaprog=$_POST["namaProg"];
		$tarikhprog=$_POST["tarikhProg"];
		$tempatprog=$_POST["tempatProg"];

		$berjaya="Maklumat Program Berjaya Dimasukkan";
		$sql="INSERT INTO tbl_program (keterangan,tarikh,tempat,papar) VALUES ('$namaprog','$tarikhprog','$tempatprog',1)";
		mysqli_query($conn,$sql);
		mysqli_close($conn);
		echo $berjaya;
        break;

    case "createPeserta":
        $idprog=$_POST["idProg"];
        $nama=$_POST["namaPeserta"];
        $nama=htmlspecialchars($nama, ENT_QUOTES);  //untuk yang ada special char ' cth: dato'
        $agensi=$_POST["namaAgensi"];

        $berjaya="Maklumat Peserta Berjaya Dimasukkan";
        $sql="INSERT INTO tbl_peserta (nama,agensi,papar) VALUES ('$nama','$agensi',1)";
        mysqli_query($conn,$sql);
        $sql2="INSERT INTO tbl_kehadiran (idprogram,idstatus) VALUES ('$idprog',0)";
        mysqli_query($conn,$sql2);
        mysqli_close($conn);
        echo json_encode($berjaya);
        break;

    case "updatePeserta":
        // $idprog=$_POST["idProg"];
        $idpeserta=$_POST["idNama"];
        $nama=$_POST["namaPeserta"];
        $nama=htmlspecialchars($nama, ENT_QUOTES);  //untuk yang ada special char ' cth: dato'
        $agensi=$_POST["namaAgensi"];
        $status=$_POST["status"];

        $berjaya="Maklumat Peserta Berjaya Dikemaskini";
        $sql="UPDATE tbl_peserta t1, tbl_kehadiran t2 SET t1.nama='$nama', t1.agensi='$agensi', t2.idstatus='$status'
                WHERE t1.idrec='$idpeserta' AND t1.idrec=t2.idpeserta";
        mysqli_query($conn,$sql);
        mysqli_close($conn);
        echo json_encode($berjaya);
        break;

    case "updateProgram":
        $idprog=$_POST["idProgram"];
        $program=$_POST["namaProg"];
        $tarikh=$_POST["tarikhProg"];
        $tempat=$_POST["tempatProg"];

        $berjaya="Maklumat Program Berjaya Dikemaskini";
        $sql="UPDATE tbl_program SET keterangan='$program', tarikh='$tarikh', tempat='$tempat' WHERE idrec='$idprog'";
        mysqli_query($conn,$sql);
        mysqli_close($conn);
        echo $berjaya;
        break;

    case "deletePeserta":
        // $idprog=$_POST["idProg"];
        $idpeserta=$_POST["idNama"];
        // $nama=$_POST["namaPeserta"];
        // $agensi=$_POST["namaAgensi"];

        $berjaya="Maklumat Peserta Berjaya Dihapuskan";
        $sql="UPDATE tbl_peserta SET papar=0 WHERE idrec='$idpeserta'";
        mysqli_query($conn,$sql);
        mysqli_close($conn);
        echo json_encode($berjaya);
        break;

    case "deleteProgram":
        $idprog=$_POST["idProgram"];
        // $program=$_POST["namaProg"];
        // $tarikh=$_POST["tarikhProg"];
        // $tempat=$_POST["tempatProg"];

        $berjaya="Maklumat Program Berjaya Dihapuskan";
        $sql="UPDATE tbl_program SET papar=0 WHERE idrec='$idprog'";
        mysqli_query($conn,$sql);
        mysqli_close($conn);
        echo $berjaya;
        break;

    case "updateHadir":
        $idnama=$_POST["kodnama"];
        $idprogram=$_POST["kodprog"];
        $nama=$_POST["namaa"];
        $nama=htmlspecialchars_decode($nama);  //decode kembali untuk yang ada special char ' cth: dato'
        $agensi=$_POST["agensii"];

        $berjaya="<h1>".$nama."</h1><br><h2>".$agensi."</h2>";
        $sql="UPDATE tbl_kehadiran SET idstatus=1 WHERE idpeserta='$idnama' AND idprogram='$idprogram'";
        mysqli_query($conn,$sql);
        mysqli_close($conn);
        echo $berjaya;
        break;

    case "createWalkin":
        $idprog=$_POST["idProg"];
        $nama=$_POST["namaPeserta"];
        // $nama=htmlspecialchars($nama, ENT_QUOTES);  //untuk yang ada special char ' cth: dato'
        $agensi=$_POST["namaAgensi"];

        // $berjaya="<h1>".$nama."</h1><br><h2>".$agensi."</h2>";

        $berjaya=$nama." Daripada ".$agensi." Telah Berjaya Didaftarkan";

        $nama=htmlspecialchars($nama, ENT_QUOTES);  //untuk yang ada special char ' cth: dato'
        
        $sql="INSERT INTO tbl_peserta (nama,agensi,papar) VALUES ('$nama','$agensi',1)";
        mysqli_query($conn,$sql);
        $sql2="INSERT INTO tbl_kehadiran (idprogram,idstatus) VALUES ('$idprog',2)";
        mysqli_query($conn,$sql2);
        mysqli_close($conn);
        echo $berjaya;
        break;

        case "updateSebab":
        $idprog=$_POST["idProg"];
        $nama=$_POST["namaPeserta"];
        $idnama=$_POST["idPeserta"];
        $sebab=$_POST["sebabnya"];

        // $berjaya="<h1>".$nama."</h1><br><h2>".$agensi."</h2>";

        $berjaya="Sebab Ketidakhadiran Bagi ".$nama." Berjaya Dikemaskini";
        $sql="UPDATE tbl_kehadiran SET sebab='$sebab' WHERE idpeserta='$idnama' AND idprogram='$idprog'";
        mysqli_query($conn,$sql);
        mysqli_close($conn);
        echo $berjaya;
        break;

    default:
        echo "Ada bug!!";
}
?>