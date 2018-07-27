<?php
include("libs.php");
include("connection.php");

$idprog=$_GET["idprog"];

$sql0 = "select * from tbl_program where idrec='$idprog'";
$result0 = mysqli_query($conn, $sql0);
$row0 = mysqli_fetch_array($result0);


$sql = "SELECT t2.idrec as id, t2.nama as nama, t2.agensi as agensi, t4.keterangan as status FROM tbl_peserta t2, tbl_kehadiran t3, lu_status t4
where t2.idrec=t3.idpeserta and t3.idstatus=t4.idrec and t3.idprogram='$idprog'";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Import Data Senarai Peserta</title>
  </head>
  <body>
    <div class="container" style="width:900px;">
      <h4 align="center">Import Data Senarai Peserta</h4>
      <h4 align="center" style="font-weight: bold;"><?php echo $row0["keterangan"]?></h4><br />
      <input type="hidden" id="noprog" value="<?php echo $idprog; ?>">
      <form id="upload_csv" method="post" enctype="multipart/form-data">
        <div class="col-md-4">
          <input type="file" name="employee_file" style="margin-top:15px;" />
        </div>
        <div class="col-md-5">
          <input type="submit" name="upload" id="upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
          <div id="tunggu">Sedang Upload<img src="img/loading1.gif" alt="Smiley face" height="42" width="42"></div>
          <input id="prog" type="hidden" data-program=<?php echo $idprog; ?> />
        </div>
        <div style="clear:both"></div>
      </form>
      <br /><br /><br />
      
    </div>
  </body>
</html>
<script>
  $(document).ready(function(){
    $('#tunggu').hide();
    $('#upload_csv').on("submit", function(e){
      e.preventDefault(); //form will not submitted

      var noprog = $('#noprog').val();
      var pergi = 'senarainama.php?idprog='+noprog;
      var sesi = 'urussession.php?pergi='+pergi;

      var mydata = new FormData(this);
      var idprog = $('#prog').data('program');
      mydata.append('example',idprog);
      $.ajax({
        beforeSend: function() { $('#tunggu').show(); },
        complete: function() { $('#tunggu').hide(); },
        url:"import.php",
        method:"POST",
        data:mydata,
        contentType:false,          // The content type used when sending data to the server.
        cache:false,                // To unable request pages to be cached
        processData:false,          // To send DOMDocument or non processed data file it is set to false
        success: function(data){
          if(data=='Error1')
          {
            alert("Invalid File");
          }
          else if(data=="Error2")
          {
            alert("Please Select File");
          }
          else if(data=="Berjaya")
          {
            alert("Data Berjaya Dimasukkan");
            $(location).attr('href',sesi);
          }
          else
          {
            $('#employee_table').html(data);
          }
        },
        error: function() {
          alert('silap tuuu');
        }
      })
    });
  });
</script>
