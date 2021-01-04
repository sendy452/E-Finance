<?php
//include('dbconnected.php');
include('koneksi.php');

$tgl_pemasukan = $_GET['tgl_pemasukan'];
$jumlah = $_GET['jumlah'];
$ket = $_GET['keterangan'];

//query update
$query = mysqli_query($koneksi,"INSERT INTO `pemasukan` (`tgl_pemasukan`, `jumlah`, `keterangan`) VALUES ('$tgl_pemasukan', '$jumlah', '$ket')");

if ($query) {
 # credirect ke page index
 header("location:pendapatan.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>