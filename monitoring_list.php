<?php  
	  // include('openday/dbconnect.php'); 
	    // $urlCur = $_SERVER['PHP_SELF'];
		include("libs.php");
		include("connection.php");
		$kod_prog = $_GET["idprog"];
		$kod_hadir = $_GET["idhadir"];				
				//echo $db_name ;
							
				$sqlQuery = "SELECT t2.idpeserta, t2.sebab, t1.nama, t1.agensi as alamat, DATE_FORMAT(t2.time_stamp,'%T') as tkh_kemaskini
				FROM tbl_peserta t1, tbl_kehadiran t2 
				WHERE t1.idrec = t2.idpeserta 
				AND t2.idprogram = '$kod_prog'
				AND t2.idstatus = '$kod_hadir'
				ORDER BY tkh_kemaskini DESC";
				
				////////////////////////////////////////////////////////////////////////////////////////////
				// if($kod_hadir == 2){
				// $sqlQuery = "SELECT t1.nama, DATE_FORMAT(t2.time_stamp,'%T') as tkh_kemaskini
				// FROM tbl_peserta t1, tbl_kehadiran t2
				// WHERE t1.idrec = t2.idpeserta 
				// AND t2.idprogram = '$kod_prog'
				// AND t2.idstatus = 2
				// ORDER BY tkh_kemaskini DESC";
				// }
				////////////////////////////////////////////////////////////////////////////////////////////
				
				////////////////////////////////////////////////////////////////////////////////////////////
				if($kod_hadir == 3){
				$sqlQuery = "SELECT t1.nama, t1.agensi as alamat, DATE_FORMAT(t2.time_stamp,'%T') as tkh_kemaskini
				FROM tbl_peserta t1, tbl_kehadiran t2 
				WHERE t1.idrec = t2.idpeserta 
				AND t2.idprogram = '$kod_prog' 
				AND (t2.idstatus = 1 OR t2.idstatus = 2)
				ORDER BY tkh_kemaskini DESC";
				}
				////////////////////////////////////////////////////////////////////////////////////////////
				
				$listQuery = mysqli_query($conn,$sqlQuery);
				$id = 0 ;
				
				?>
                
				<table id="example" class="display compact" cellspacing="0" width="100%">
                <thead>
				  <tr>
                  	<th>Bil</th>
				    <th>Nama</th>
				    <th>Agensi</th> 
				    <th> <?php if($kod_hadir==0){?>Masa Sebab<?php }else {?>Masa Masuk<?php }?></th>
                    <?php if($kod_hadir==0){?><th>Sebab</th>
                    <th>Tindakan</th> <?php }?>
				  </tr>
                  </thead>
				<tbody>
				<?php
				$bil=0;
				while ($listRow = mysqli_fetch_array($listQuery))
				{
					$bil++;
				?>

				  <tr>
                  	<td><?php echo $bil."." ?></td>
				    <td><?php echo $listRow['nama'] ?></td>
				    <td><?php echo $listRow['alamat'] ?></td> 
				    <td><?php echo $listRow['tkh_kemaskini'] ?></td>
                    <?php if($kod_hadir==0){ $kod_id=$listRow['idpeserta']?><td><?php echo $listRow['sebab'] ?></td>
                     <td><button type="button" class="isi btn btn-info btn-sm" data-nama="<?php echo $listRow['nama'] ?>" data-idnama="<?php echo $kod_id;?>" data-idprog="<?php echo $kod_prog;?>" data-toggle="modal" data-target="#sebabModal">Isi</button>
                    </td><?php }?>
				  </tr>
							

			<?php
			}			  
			?>
            </tbody>
			</table>
           

  <!-- Modal1 -->
<div class="modal fade" id="sebabModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sebabnama"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="sebabForm" method="post" class="form-horizontal">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Sebab</label>
            <div class="col-sm-10">
              <textarea rows="4" cols="50" name="sebabnya" id="sebabnya"></textarea>
            </div>
          </div>
          
          <div class="form-group row">
            <div class="col-sm-10">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
          
              <input type="hidden" name="idPeserta" id="idPeserta" value="">
              <input type="hidden" name="namaPeserta" id="namaPeserta" value="">
              <input type="hidden" name="idProg" id="idProg" value="">
              <input type="hidden" name="jenisAction" value="updateSebab">
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!--modal1-->
         

	<script>
	

$(document).ready(function() {
    $('#example').DataTable( {
		dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "paging":   false,
        "ordering": true,
        "info":     false
    });

    $('.isi').click(function(){
	//alert("hello");
	var aaa = $(this).data('idprog');
	var bbb = $(this).data('idnama');
	var ccc = $(this).data('nama');
	//alert(bbb);
	$('#sebabnama').text(ccc);
	$('#idProg').val(aaa);
	$('#idPeserta').val(bbb);
	$('#namaPeserta').val(ccc);
	$('#sebabnya').focus();
	});


	$('#sebabForm').submit(function(){
//      alert('masuk');
      var data = $(this).serializeArray();
//      data.push({proses: 'addprogram', value: 'love'}); //for additional data
      $.ajax({
        type: "POST",
        url: "add_edit_data.php",
        data: data,
        dataType: "text",
        async: false,
        success: function(data) {
          // alert(data);
//          var obj = jQuery.parseJSON(data);
          alert(data);
          // var aa = 'monitoring_list.php?idprog='+<?php echo $kod_prog?>+'&idhadir=0';
          // $(location).attr('href','www.google.com.my');
          // document.location.replace(aa);
          // $('.utama').load(data);
          // do what ever you want with the server response
        },
        error: function() {
          alert('silap tuuu');
        }
      });
    });

});

	</script>
    
    