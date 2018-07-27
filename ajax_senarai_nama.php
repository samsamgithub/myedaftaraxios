<?php
	include("connection.php");

	$inputNama=$_POST["inputNama"];
	$inputIdProg=$_POST["inputIdProg"];

	$sql = "SELECT t1.idrec, t1.nama, t1.agensi, t2.idprogram, t2.idstatus FROM tbl_peserta t1, tbl_kehadiran t2 
			WHERE t1.nama LIKE '%$inputNama%' AND t2.idprogram = '$inputIdProg' AND t1.idrec=t2.idpeserta AND t1.papar=1";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result)>0){
		$t ="<table cellspacing=10 cellpadding=10 border=1 align=center>";
		$t .="<tr align=center style=background-color:gold>";
	    $t .="<th>Nama</th>";
	    $t .="<th>Agensi</th>";
	    $t .="<th>Status</th>";
	    $t .="</tr>";

	    while ($row = mysqli_fetch_array($result)) {
	    	$t .="<tr>";
	    	// $t .="<td>".$row["idrec"].$row["nama"]."</td>";
	    	$t .="<td>".$row["nama"]."</td>";
	    	$t .="<td>".$row["agensi"]."</td>";
	    	if($row["idstatus"]==0){
	    		$t .="<td><button type='button' class='btn btn-primary btn-sm kelashadir' data-idnama='".$row["idrec"]."' data-nama='".$row["nama"]."' data-agensi='".$row["agensi"]."' data-idprog='".$row["idprogram"]."' data-action='updateHadir'>Daftar Hadir</button></td>";
	    	}else{
	    		$t .="<td align=center><img src='img/bluetick.png' height='42' width='42'></td>";
	    	}
	    	
	    	$t .="</tr>";
	    }

	    $t .="</table>";
	}else{
		 $t ="<strong>-Tiada Data. Mohon Daftar Peserta <a data-toggle='modal' data-target='#walkinModal' href='#'>Walk-In</a>-</strong><br><img height='50' width='250' src='img/dotts.gif'>";
	}

    echo $t;
?>
