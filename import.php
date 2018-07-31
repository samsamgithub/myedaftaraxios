<?php
include("connection.php");
$idprog=$_POST["example"];
$bilrec=0;

if(!empty($_FILES["employee_file"]["name"]))
{
  $output = '';
  $allowed_ext = array("csv");
  $extension = end(explode(".", $_FILES["employee_file"]["name"]));
  if(in_array($extension, $allowed_ext))
  {
    $file_data = fopen($_FILES["employee_file"]["tmp_name"], 'r');
    fgetcsv($file_data);
    while($row = fgetcsv($file_data))
    {
      $bilrec++;
      $name = mysqli_real_escape_string($conn, $row[0]);
      $agensi = mysqli_real_escape_string($conn, $row[1]);

      $query1 = "INSERT INTO tbl_peserta
                     (nama, emel, agensi, papar)
                     VALUES ('$name', 'emel', '$agensi', 1)";
      mysqli_query($conn, $query1);

      $query2 = "INSERT INTO tbl_kehadiran
                     (idprogram, idstatus)
                     VALUES ('$idprog',0)";
      mysqli_query($conn, $query2);
    }
    
    echo "Berjaya";
  }
  else
  {
    echo 'Error1';
  }
}
else
{
  echo "Error2";
}
?>
