<?php
  
require_once '../koneksi.php';

// Get the user id 
$nik = $_REQUEST['nik'];
  
if ($nik !== "") {
      
    // Get corresponding first name and 
    // last name for that user id    
    $query = mysqli_query($conn, "SELECT nama_lengkap, 
    skema_pelatihan FROM lulusan WHERE nik='$nik'");
  
    $row = mysqli_fetch_array($query);
  
    // Get the first name
    $nama_lengkap = $row["nama_lengkap"];
  
    // Get the first name
    $skema_pelatihan = $row["skema_pelatihan$skema_pelatihan"];
}
  
// Store it in a array
$result = array("$nama_lengkap", "$skema_pelatihan");
  
// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>