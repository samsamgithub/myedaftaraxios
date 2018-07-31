<?php  
	  // include('openday/dbconnect.php'); 
	    // $urlCur = $_SERVER['PHP_SELF'];
		include("libs.php");
		include("connection.php");

		$kod_prog = $_GET["idprog"];
		$kod_hadir = $_GET["idhadir"];				
				//echo $db_name ;
				
				$sqlQueryAsas = "SELECT count(t1.nama) as jum, t3.keterangan as nama_prog
				FROM tbl_peserta t1, tbl_kehadiran t2, tbl_program t3
				WHERE t1.idrec = t2.idpeserta 
				AND t1.papar = 1
				AND t2.idprogram = t3.idrec
				AND t2.idprogram = '$kod_prog'";
				
				///////////////////////////////////////////////////////////////////////////////////////////
				$sqlQueryJumAll = $sqlQueryAsas."AND t2.idstatus = 0";
				$listQueryJumAll = mysqli_query($conn,$sqlQueryJumAll);
				$listRowJumAll = mysqli_fetch_array($listQueryJumAll);
				?>
				<div align="center" style="font-weight:bold; font-size:28px"><?php echo $listRowJumAll['nama_prog']?></div>
                <?php
				//echo "<br>";
				//echo "Bilangan Peserta Belum Hadir (Pra Daftar): <strong>".$listRowJumAll['jum']."</strong>";
				///////////////////////////////////////////////////////////////////////////////////////////
				//echo "<br>";
				///////////////////////////////////////////////////////////////////////////////////////////
				$sqlQueryHadirSemasa = $sqlQueryAsas."AND t2.idstatus = 1";
				$listQueryHadirSemasa = mysqli_query($conn,$sqlQueryHadirSemasa);
				$listRowHadirSemasa = mysqli_fetch_array($listQueryHadirSemasa);
				
				//echo "Bilangan Kehadiran Semasa (Pra Daftar): <strong>".$listRowHadirSemasa['jum']."</strong>";
				///////////////////////////////////////////////////////////////////////////////////////////
				//echo "<br>";
				///////////////////////////////////////////////////////////////////////////////////////////
				$sqlQueryWalkin = $sqlQueryAsas."AND t2.idstatus = 2";
				$listQueryWalkin = mysqli_query($conn,$sqlQueryWalkin);
				$listRowWalkin = mysqli_fetch_array($listQueryWalkin);
				
				//echo "Bilangan Kehadiran Walkin: <strong>".$listRowWalkin['jum']."</strong>";
				///////////////////////////////////////////////////////////////////////////////////////////
				//echo "<br>";
				$JumHadir = $listRowHadirSemasa['jum']+$listRowWalkin['jum'];
				//echo "<span style='font-size:20;font-weight:bolder'>Jumlah Kehadiran Semasa: <strong>".$JumHadir."</strong></span>";
				
				?>
                

                <br /><br />
                <table border="1" cellpadding="0" cellspacing="0" width="100%" style="font-size:20px">
                	<tr align="center">
                    	<td>Belum Hadir</td>
                        <td>Pra Daftar Hadir</td>
                        <td>Walk-In</td>
                        <td><strong>Kehadiran Semasa</strong></td>
                    </tr>
                    <tr align="center">
                    	<td><?php echo $listRowJumAll['jum'];?></td>
                        <td><?php echo $listRowHadirSemasa['jum'];?></td>
                        <td><?php echo $listRowWalkin['jum'];?></td>
                        <td><strong><?php echo $JumHadir;?></strong></td>
                    </tr>
                </table>