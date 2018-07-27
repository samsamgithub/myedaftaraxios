<?php
include("libs.php");
include("connection.php");

$idprog=$_GET["idprog"];

$sql0 = "select * from tbl_program where idrec='$idprog'";
$result0 = mysqli_query($conn, $sql0);
$row0 = mysqli_fetch_array($result0);


$sql = "SELECT t2.idrec as id, t2.nama as nama, t2.agensi as agensi, t4.keterangan as status, t4.idrec as idstatus FROM tbl_peserta t2, tbl_kehadiran t3, lu_status t4
where t2.idrec=t3.idpeserta and t3.idstatus=t4.idrec and t3.idprogram='$idprog' and t2.papar=1";
$result = mysqli_query($conn, $sql);


$sqlStatus = "SELECT * FROM lu_status";
$resultStatus = mysqli_query($conn, $sqlStatus);

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Senarai Nama Peserta</title>
  </head>
  <body>
    <div class="container">
      <h4 align="center">Senarai Nama Peserta</h4>
      <h4 align="center" style="font-weight: bold;"><?php echo $row0["keterangan"]?></h4>
      <input type="hidden" id="noprog" value="<?php echo $idprog; ?>">
      <br />
      

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Tambah Peserta
</button>
<button type="button" class="btn btn-primary pilihan" data-pergi="importcsv.php?idprog=<?php echo $idprog;?>">
  Import CSV
</button>
<button type="button" class="btn btn-primary pilihan" data-pergi="salin.php?idprog=<?php echo $idprog;?>">
  Salin Senarai
</button>




<!-- Modal1 -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Peserta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="eventForm" method="post" class="form-horizontal">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Peserta</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="namaPeserta" id="inputNama" placeholder="Nama Peserta" required>
            </div>
          </div>
          
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Agensi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="namaAgensi" id="inputAgensi" placeholder="Agensi" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
              <input type="hidden" name="idProg" value="<?php echo $idprog; ?>">
              <input type="hidden" name="jenisAction" value="createPeserta">
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!--modal1-->


<!-- Modal2 -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Peserta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editForm" method="post" class="form-horizontal">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Peserta</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="namaPeserta" id="inputNamaEdit" placeholder="Nama Peserta" required autocomplete="off">
            </div>
          </div>
          
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Agensi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="namaAgensi" id="inputAgensiEdit" placeholder="Agensi" required autocomplete="off">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
              <select id="status" name="status" class="form-control form-control-sm">
                <?php while($rowStatus = mysqli_fetch_array($resultStatus)) { ?>
                <option value="<?php echo $rowStatus['idrec']; ?>"><?php echo $rowStatus["keterangan"]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
              <!-- <input type="hidden" name="proses" value="addprogram"> -->
              <input type="hidden" name="idProg" value="<?php echo $idprog; ?>">
              <input type="hidden" name="idNama" id="idnama" value="">
              <input type="hidden" name="jenisAction" id="jenisAction" value="updatePeserta">
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!--modal2-->


<!-- Modal hapus -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Hapus Peserta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="hapusForm" method="post" class="form-horizontal">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Peserta</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="namaPeserta" id="inputNamaEditH" placeholder="Nama Peserta" required readonly>
            </div>
          </div>
          
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Agensi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="namaAgensi" id="inputAgensiEditH" placeholder="Agensi" required readonly>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Hapus</button>
            
              <input type="hidden" name="idProg" value="<?php echo $idprog; ?>">
              <input type="hidden" name="idNama" id="idnamaH" value="">
              <input type="hidden" name="jenisAction" id="jenisAction" value="deletePeserta">
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!--modal hapus-->


      <br /><br /><br />
      
        <table id="example" class="display compact">
          <thead>
          <tr>
            <th>Bil</th>
            <th>Id</th>
            <th>Nama</th>
            <th>Agensi</th>
            <th>Status</th>
            <th>Tindakan</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $bil=0;
          while($row = mysqli_fetch_array($result))
          {
            $bil++;
          ?>
          <tr>
            <td><?php echo $bil; ?></td>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["nama"]; ?></td>
            <td><?php echo $row["agensi"]; ?></td>
            <td><?php echo $row["status"]; ?></td>
            <td>
              <button type="button" class="btn btn-warning btn-sm kelasnama" data-toggle="modal" data-target="#editModal" data-idnama="<?php echo $row["id"]; ?>" data-nama="<?php echo $row["nama"]; ?>" data-agensi="<?php echo $row["agensi"]; ?>" data-status="<?php echo $row["idstatus"]; ?>">Edit</button>
            <button type="button" class="btn btn-danger btn-sm kelasnamahapus" data-toggle="modal" data-target="#hapusModal" data-idnama="<?php echo $row["id"]; ?>" data-nama="<?php echo $row["nama"]; ?>" data-agensi="<?php echo $row["agensi"]; ?>">Hapus</button>
          </td>
          </tr>
          <?php } ?>
        </tbody>
        </table>


    </div>
  </body>
</html>
<script>
  $(document).ready(function(){

    $('#example').DataTable({
      "paging" : false,
      "dom": '<"top"if>',
      "language": {
            "info" : "Sebanyak _TOTAL_ data dipaparkan",
            "search" : "Cari:",
            "infoEmpty": "Tiada Rekod",
            "infoFiltered": "daripada _MAX_ rekod",
            "emptyTable": "Tiada Rekod Dijumpai",
            "searchPlaceholder" : "Kata kunci...",
            "zeroRecords": "Tiada rekod untuk carian"
        }
    });
    
    $('#eventForm').submit(function(e){
     // alert('masuk');
      e.preventDefault(); //form will not submitted
      var noprog = $('#noprog').val();
      var pergi = 'senarainama.php?idprog='+noprog;
      var sesi = 'urussession.php?pergi='+pergi;
      var data = $(this).serializeArray();
//      data.push({proses: 'addprogram', value: 'love'}); //for additional data
      $.ajax({
        type: "POST",
        url: "add_edit_data.php",
        data: data,
        dataType: "json",
        // async: false,
        success: function(data) {
          // alert(data);
//          var obj = jQuery.parseJSON(data);
          alert(data);
          $(location).attr('href',sesi);
          // document.location.replace('muka1.php');
          // $('.utama').load(data);
          // do what ever you want with the server response
        },
        error: function() {
          alert('silap tuuu');
        }
      });
    });



    $('#editForm').submit(function(e){
//      alert('masuk');
      e.preventDefault(); //form will not submitted
      var noprog = $('#noprog').val();
      var pergi = 'senarainama.php?idprog='+noprog;
      var sesi = 'urussession.php?pergi='+pergi;
      var data = $(this).serializeArray();
//      data.push({proses: 'addprogram', value: 'love'}); //for additional data
      $.ajax({
        type: "POST",
        url: "add_edit_data.php",
        data: data,
        dataType: "json",
        // async: false,
        success: function(data) {
//          var obj = jQuery.parseJSON(data);
          alert(data);
          $(location).attr('href',sesi);
          // do what ever you want with the server response
        },
        error: function() {
          alert('silap tuuu');
        }
      });
    });


    $('#hapusForm').submit(function(e){
//      alert('masuk');
      e.preventDefault(); //form will not submitted
      var noprog = $('#noprog').val();
      var pergi = 'senarainama.php?idprog='+noprog;
      var sesi = 'urussession.php?pergi='+pergi;
      var data = $(this).serializeArray();
//      data.push({proses: 'addprogram', value: 'love'}); //for additional data
      $.ajax({
        type: "POST",
        url: "add_edit_data.php",
        data: data,
        dataType: "json",
        // async: false,
        success: function(data) {
//          var obj = jQuery.parseJSON(data);
          alert(data);
          $(location).attr('href',sesi);
          // do what ever you want with the server response
        },
        error: function() {
          alert('silap tuuu');
        }
      });
    });



    $('.pilihan').click(function(){
      var bbb = $(this).data('pergi');
     // alert(bbb);
      //      $(this).addClass('active').siblings().removeClass('active');
      $('.utama').load(bbb);
    });

    $('.kelasnama').click(function(){
      var ccc = $(this).data('idnama');
      var ddd = $(this).data('nama');
      var eee = $(this).data('agensi');
      var fff = $(this).data('status');
      // alert(fff);
      //      $(this).addClass('active').siblings().removeClass('active');
      $('#idnama').val(ccc);
      $('#inputNamaEdit').val(ddd);
      $('#inputAgensiEdit').val(eee);

      $("#status").val(fff).find("option[value=" + fff +"]").attr('selected', true);  //untuk proses selected status peserta based on value
    });

    $('.kelasnamahapus').click(function(){
      var ccc = $(this).data('idnama');
      var ddd = $(this).data('nama');
      var eee = $(this).data('agensi');
      // alert(ccc);
      //      $(this).addClass('active').siblings().removeClass('active');
      $('#idnamaH').val(ccc);
      $('#inputNamaEditH').val(ddd);
      $('#inputAgensiEditH').val(eee);
    });



  });
</script>
