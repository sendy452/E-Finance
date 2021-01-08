<?php
//include('dbconnected.php');
include('koneksi.php');

$nama = $_GET['nama'];
$username = $_GET['username'];
$pass = $_GET['pass'];
$type = $_GET['type'];


//query update
$query = mysqli_query($koneksi,"INSERT INTO `user` (`nama`, `username`, `pass`, `type`) VALUES ('$nama', '$username', '$pass', '$type')");

if ($query) {
 # credirect ke page index
 header("location:akun.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>