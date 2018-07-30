<?php
session_start();
  include("libs.php");
  include("connection.php");

  $idprog=$_GET["idprog"];

  $sql = "SELECT keterangan FROM tbl_program WHERE idrec='$idprog'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
?>

<style>
  .kepala{
    background-image:url("img/header2.jpg");
    height: 100px;
  }
  .tulisan{
    background-image:url("img/wording1.png");
    background-repeat: no-repeat;
    height: 100px;
    margin: auto;
    width: 90%;
    margin-top: 1%;
    /*padding: 10px;*/
  }
  .kaki{
    background-color:white;
    height: 200px;
  }
  #tinggi{
    height: 30px;
  }
</style>

<html>
<head>
	<title>Sistem E-daftar</title>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 kepala">
    	<div class="tulisan"> </div>
    </div>
  </div>

  <div class="row"><div class="col-md-12"><div id="tinggi"></div></div></div> <!--satu row kosong-->

  <div class="row">
  	<div class="col-md-2"></div>
  	<div class="col-md-8">

    	<div id="panel" class="card text-center">
		  <div style="font-size: 25;font-weight: bold" class="card-header"><a href="index.php">
		   <?php echo $row["keterangan"];?></a>
		  </div>
		  <div class="card-body">
		    <h5 class="card-title">Selamat Datang </h5>
		    <div id="slmtdtg">
		    <p class="card-text">Sila Taip Nama Anda</p>
		    <form id='formCari'>
		    <input type="text" size="50" id="inputNama" name="inputNama" autocomplete="off">
		    <input type="hidden" id="inputIdProg" name="inputIdProg" value="<?php echo $idprog;?>">
			</form>
		    <br>
		    <div class="row">
		    	
		    	<div class="col-md-12" id="listNama">
		    		<img height="50" width="250" src="img/dotts.gif">
		    		
		    	</div>
		    	
		    </div>
		    
		  </div> <!-- div slmtdtg -->
		</div>
		  <div class="card-footer text-muted">
		    Hakcipta Terpelihara Jabatan Perangkaan Malaysia
		  </div>
		</div>

    <div class="col-md-2"></div>
    </div>
  </div>

  <div class="row"><div class="col-md-12"><div id="tinggi"></div></div></div> <!--satu row kosong-->

</div>



<!-- Modal walkin -->
<div class="modal fade" id="walkinModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peserta Walkin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="walkinForm" data-idprog="<?php echo $idprog;?>" method="post" class="form-horizontal">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Peserta</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="namaPeserta" id="inputNama" placeholder="Nama Peserta" required autocomplete="off">
            </div>
          </div>
          
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Agensi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="namaAgensi" id="inputAgensi" placeholder="Agensi" required autocomplete="off">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
              <!-- <input type="hidden" name="proses" value="addprogram"> -->
              <input type="hidden" name="idProg" value="<?php echo $idprog;?>">
              <input type="hidden" name="jenisAction" value="createWalkin">
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!--modal walkin-->
</body>
</html>

<script> 
$(document).ready(function(){

	$("#inputNama").keypress(function(e) {
 		 if (e.which == 13) {   //prevent tekan enter
   		 return false;
  		}
	});

    // $("#flip").click(function(){
    	$("#panel").hide();
        $("#panel").slideDown();
        $("#inputNama").focus();

        $('#inputNama').keyup(function(){
        	if($(this).val().length > 3) {
     // alert('masuk');
			      var data = $('#formCari').serialize();
			       // alert(data);
			//      data.push({proses: 'addprogram', value: 'love'}); //for additional data
			      $.ajax({
			        type: "POST",
			        url: "ajax_senarai_nama.php",
			        data: data,
			        dataType: "text",
			        async: false,
			        success: function(data) {
			         // var obj = jQuery.parseJSON(data);
			          // alert(data[0]);
			          $('#listNama').html(data);
			          initback();
			          // $('body').html($('body').html());
			          // do what ever you want with the server response
			        },
			        error: function() {
			          alert('silap tuuu');
			        }
			      });
  			}//tutup if
  			else{
  				$('#listNama').html("<img height='50' width='250' src='img/dotts.gif'>");
  			} //tutup else if
    });


    $('#walkinForm').submit(function(){
     // alert('masuk');
     var idprog = $(this).data('idprog');
     var bbb = 'liveevent.php?idprog='+idprog;
      var data = $(this).serializeArray();
//      data.push({proses: 'addprogram', value: 'love'}); //for additional data
      $.ajax({
        type: "POST",
        url: "add_edit_data.php",
        data: data,
        dataType: "text",
        async: false,
        success: function(data) {
            alert(data);
//          var obj = jQuery.parseJSON(data);
    //         $('#slmtdtg').html(data);
			 // setTimeout(function(){ $(location).attr('href',bbb); }, 2000);
          // document.location.replace('muka1.php');
          // $('.utama').load(data);
          // do what ever you want with the server response
        },
        error: function() {
          alert('silap tuuu');
        }
      });
    });

});

function initback(){
	$('.kelashadir').click(function(){
    	// alert('masuk hadir');
      var idnama = $(this).data('idnama');
      var idprog = $(this).data('idprog');
      var nama = $(this).data('nama');
      var agensi = $(this).data('agensi');
      var myaction = $(this).data('action');
      var bbb = 'liveevent.php?idprog='+idprog;

      var data = {kodnama : idnama, kodprog : idprog, namaa : nama, agensii : agensi, jenisAction : myaction};
      
      $.ajax({
			        type: "POST",
			        url: "add_edit_data.php",
			        data: data,
			        dataType: "text",
			        async: false,
			        success: function(data) {
			         // var obj = jQuery.parseJSON(data);
			          // alert(data[0]);
			          $('#slmtdtg').html(data);
			          setTimeout(function(){ $(location).attr('href',bbb); }, 2000);
			          // do what ever you want with the server response
			        },
			        error: function() {
			          alert('silap tuuu');
			        }
			      });
    });

}
</script>