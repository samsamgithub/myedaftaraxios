<?php
include("libs.php");
include("connection.php");

$sql = "SELECT idrec, keterangan, DATE_FORMAT(tarikh,'%d/%m/%Y') as tarikh, tempat FROM tbl_program WHERE papar=1";
$result = mysqli_query($conn, $sql);
?>

<style type="text/css">
  /**
  * Override feedback icon position
  * See http://formvalidation.io/examples/adjusting-feedback-icon-position/
  */
  #eventForm .form-control-feedback {
    top: 0;
    right: -15px;
  }
</style>






<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Tambah Program
</button>



<form id="testForm" method="post" class="form-horizontal">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Program</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="namaProg" id="inputEmail3" placeholder="Nama Program" required autocomplete="off">
            </div>
          </div>
          
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Tempat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tempatProg" id="inputTempat" placeholder="Tempat" required autocomplete="off">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-10">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Test</button>
              <input type="hidden" name="jenisAction" value="createProgram">
            </div>
          </div>
        </form>






<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Program</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="eventForm" method="post" class="form-horizontal">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Program</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="namaProg" id="inputEmail3" placeholder="Nama Program" required autocomplete="off">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Tarikh</label>
            <div class="col-sm-4 date">
              <div class="input-group input-append date" id="datePicker">
                <input type="text" class="form-control" name="tarikhProg" id="inputDate" placeholder="Tarikh" required autocomplete="off">
                <span class="input-group-addon add-on"></span>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Tempat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tempatProg" id="inputTempat" placeholder="Tempat" required autocomplete="off">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
              <input type="hidden" name="jenisAction" value="createProgram">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!--modal-->




<!-- Modal2 -->
<div class="modal fade" id="editProgram" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Program</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editForm" method="post" class="form-horizontal">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Program</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="namaProg" id="namaProg" placeholder="Nama Program" required autocomplete="off">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Tarikh</label>
            <div class="col-sm-4 date">
              <div class="input-group input-append date" id="datePickerEdit">
                <input type="text" class="form-control" name="tarikhProg" id="tarikhProg" placeholder="Tarikh" required autocomplete="off">
                <span class="input-group-addon add-on"></span>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Tempat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tempatProg" id="tempatProg" placeholder="Tempat" required autocomplete="off">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
              <input type="hidden" name="idProgram" id="idProgram" value="">
              <input type="hidden" name="jenisAction" id="jenisAction" value="updateProgram">
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!--modal2-->





<!-- Modal2 -->
<div class="modal fade" id="deleteProgram" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Hapus Program</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="deleteForm" method="post" class="form-horizontal">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Program</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="namaProg" id="namaProgH" placeholder="Nama Program" required readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Tarikh</label>
            <div class="col-sm-4 date">
              <div class="input-group input-append date" id="datePicker">
                <input type="text" class="form-control" name="tarikhProg" id="tarikhProgH" placeholder="Tarikh" required readonly>
                <span class="input-group-addon add-on"></span>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Tempat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tempatProg" id="tempatProgH" placeholder="Tempat" required readonly>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Hapus</button>
              <input type="hidden" name="idProgram" id="idProgramH" value="">
              <input type="hidden" name="jenisAction" id="jenisAction" value="deleteProgram">
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!--modal2-->


<div class="row"><div class="col-md-12"><div id="tinggi"></div></div></div> <!--satu row kosong-->

<table id="example" class="display compact">
  <thead>
    <tr>
      <th>Bil</th>
      <th>ID</th>
      <th>Keterangan</th>
      <th>Tarikh</th>
      <th>Tempat</th>
      <th>Tindakan</th>
    </tr>
  </thead>
  <tbody>

    <?php $bil=0; while($row = mysqli_fetch_array($result)){ $bil++;?>
    <tr>
      <td><?php echo $bil; ?></td>
      <td><?php echo $row["idrec"]; ?></td>
      <td><?php echo $row["keterangan"]; ?></td>
      <td><?php echo $row["tarikh"]; ?></td>
      <td><?php echo $row["tempat"]; ?></td>
      <td>
        
        <button type="button" class="btn btn-success btn-sm pilihan" data-pergi="senarainama.php?idprog=<?php echo $row["idrec"];?>">Senarai</button>
        <button type="button" class="btn btn-warning btn-sm kelasprogram" data-toggle="modal" data-target="#editProgram" data-idprogram="<?php echo $row["idrec"]; ?>" data-program="<?php echo $row["keterangan"]; ?>" data-tarikh="<?php echo $row["tarikh"]; ?>" data-tempat="<?php echo $row["tempat"]; ?>">
        Edit</button>
        <button type="button" class="btn btn-danger btn-sm kelasprogramhapus" data-toggle="modal" data-target="#deleteProgram" data-idprogram="<?php echo $row["idrec"]; ?>" data-program="<?php echo $row["keterangan"]; ?>" data-tarikh="<?php echo $row["tarikh"]; ?>" data-tempat="<?php echo $row["tempat"]; ?>">
        Hapus</button>
      </td>
    </tr>
    <?php }?>

  </tbody>
</table>

<script>
  $(document).ready(function() {
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

    $('#datePicker')
      .datepicker({
      autoclose: true,
      format: 'yyyy/mm/dd'
    });

    $('#datePickerEdit')
      .datepicker({
      autoclose: true,
      format: 'yyyy/mm/dd'
    });

    $('#eventForm').submit(function(e){
     // alert('masuk');
      e.preventDefault(); //form will not submitted
      var pergi = 'setupprogram.php';
      var sesi = 'urussession.php?pergi='+pergi;
      var data = $(this).serializeArray();
      // alert(data);
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

    $('#editForm').submit(function(e){
     // alert('masuk');
      e.preventDefault(); //form will not submitted
      var pergi = 'setupprogram.php';
      var sesi = 'urussession.php?pergi='+pergi;
      var data = $(this).serializeArray();
      // alert(data);
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


    $('#deleteForm').submit(function(e){
     // alert('masuk');
      e.preventDefault(); //form will not submitted
      var pergi = 'setupprogram.php';
      var sesi = 'urussession.php?pergi='+pergi;
      var data = $(this).serializeArray();
      // alert(data);
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
      var pergi = $(this).data('pergi');
     // alert(bbb);
      //      $(this).addClass('active').siblings().removeClass('active');
      // $('.utama').load(bbb);
      var sesi = 'urussession.php?pergi='+pergi;
      $(location).attr('href',sesi);
    });

    $('.kelasprogram').click(function(){
      var ccc = $(this).data('idprogram');
      var ddd = $(this).data('program');
      var eee = $(this).data('tarikh');
      var fff = $(this).data('tempat');
      // alert(ccc);
      //      $(this).addClass('active').siblings().removeClass('active');
      $('#idProgram').val(ccc);
      $('#namaProg').val(ddd);
      $('#tarikhProg').val(eee);
      $('#tempatProg').val(fff);
    });

    $('.kelasprogramhapus').click(function(){
      var ccc = $(this).data('idprogram');
      var ddd = $(this).data('program');
      var eee = $(this).data('tarikh');
      var fff = $(this).data('tempat');
      // alert(ccc);
      //      $(this).addClass('active').siblings().removeClass('active');
      $('#idProgramH').val(ccc);
      $('#namaProgH').val(ddd);
      $('#tarikhProgH').val(eee);
      $('#tempatProgH').val(fff);
    });


$('#testForm').submit(function(){
    //  alert('masuk');
     var data = $(this).serialize();
      // alert(data);
      axios.post('testaxios.php', data)
    .then(function (response) {
      alert('return value '+response.data);
      // console.log(response);
    })
    .catch(function (error) {
      alert("error");
      // console.log(error);
    })
    .then(function () {
      alert("selalu papar ");
      // console.log(error);
    });
 });



  } );
</script>
