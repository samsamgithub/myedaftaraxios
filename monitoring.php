<?php 
	include("libs.php");
	include("connection.php");
	// $urlCur = $_SERVER['PHP_SELF'];
	$kod_prog = $_GET["idprog"];

	if(!isset( $_GET["idhadir"])){
		$kod_hadir = 1;
	}else{
		$kod_hadir = $_GET["idhadir"];
	}
	
?>

<!DOCTYPE html>
<html>
<head>
 <title>Edaftar Monitoring</title>
</head>
<body>

<div id="div1">Loading...</div>


<br /><br /><br /><br />
               <img style="cursor:pointer" id="sycnkan" height="50" width="50" src="img/sync2.png">
               <br>
                Papar Senarai Peserta
                <select name="pilihan" class="listhadir">
                  <option value="1" <?php if($kod_hadir==1){ ?> selected="selected" <?php } ?> >Hadir Pra Daftar</option>
                  <option value="2" <?php if($kod_hadir==2){ ?> selected="selected" <?php } ?> >Hadir Walk In</option>
                  <option value="3" <?php if($kod_hadir==3){ ?> selected="selected" <?php } ?> >Kehadiran Keseluruhan</option>
                  <option value="0" <?php if($kod_hadir==0){ ?> selected="selected" <?php } ?> >Tidak Hadir</option>
                </select>
                
                <input type="hidden" id="kodhadir" value="<?php echo  $kod_hadir?>">
                

<br /><br />

<div id="div2">Loading...</div>


</body>
</html>


<script>
$(document).ready(function(){
    setInterval(function(){
        $("#div1").load("monitoring_figure.php?idprog="+<?php echo $kod_prog?>+"&idhadir="+<?php echo $kod_hadir?>);
    },2000);
});
</script>

<script>
$(document).ready(function(){
	
    $("#div2").load("monitoring_list.php?idprog="+<?php echo $kod_prog?>+"&idhadir="+<?php echo $kod_hadir?>);

	$(".listhadir").change(function(){
		var nilai = $(this).val();
		//alert(nilai);
		$("#kodhadir").val(nilai);
		$("#div2").load("monitoring_list.php?idprog="+<?php echo $kod_prog?>+"&idhadir="+nilai)
	});

	$("#sycnkan").click(function(){
		var kodhadir = $("#kodhadir").val();
		//alert(kodhadir);
    	$("#div2").load("monitoring_list.php?idprog="+<?php echo $kod_prog?>+"&idhadir="+kodhadir);
	});
	
});

</script>
