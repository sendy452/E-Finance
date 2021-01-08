<?php
require 'cek-sesi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Kelola Akun</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php require 'koneksi.php'; ?>
<?php require 'sidebar.php'; ?>
      <!-- Main Content -->
      <div id="content">

<?php require 'navbar.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
<?php
if ($_SESSION['type'] == 'Admin') {
	$lihat = 'none';
} else {
	$lihat = 'hidden';
};
?>
<button type="button" class="btn btn-success" style="margin:5px; visibility:<?=$lihat?>" data-toggle="modal" data-target="#myModalTambah"><i class="fa fa-plus-circle"></i> Akun</button><br>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Kelola Akun</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nama</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Tipe Akun</th>
					  <th>Aksi</th>
                    </tr>
                  </thead>
                  <tfoot>
                  </tfoot>
                  <tbody>
				  <?php 
                  $no = 1;
				  $id = $_SESSION['type'];
if ($id == 'Admin') {
$query = mysqli_query($koneksi,"SELECT * FROM user");
} else {
$query = mysqli_query($koneksi,"SELECT * FROM user where id_user = '$id'");
}
while ($data = mysqli_fetch_assoc($query)) 
{
?>
                    <tr>
                      <td><?=$no?></td>
                      <?php $no++; ?>
                      <td><?=$data['nama']?></td>
                      <td><?=$data['username']?></td>
                      <td><?=$data['pass']?></td>
                      <td><?=$data['type']?></td>
					  <td>
                    <!-- Button untuk modal -->
<a href="#" type="button" class=" fa fa-edit btn btn-primary btn-md" data-toggle="modal" data-target="#myModal<?php echo $data['id_user']; ?>"></a>
<a href="proses_hapus.php?id=<?php echo $data['id_user']; ?>" class="btn btn-danger btn-md"><i class="fa fa-trash"></i></a>
</td>
</tr>
<!-- Modal Edit Mahasiswa-->
<div class="modal fade" id="myModal<?php echo $data['id_user']; ?>" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Ubah Data Admin</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<form role="form" action="proses-edit-admin.php" method="get">

<?php
$id = $data['id_user']; 
$query_edit = mysqli_query($koneksi,"SELECT * FROM user WHERE id_user='$id'");
//$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($query_edit)) {  
?>


<input type="hidden" name="id_user" value="<?php echo $row['id_user']; ?>">

<div class="form-group">
<label>ID</label>
<input type="text" name="id" class="form-control" value="<?php echo $row['id_user']; ?>" disabled>      
</div>

<div class="form-group">
<label>Nama</label>
<input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>">      
</div>


<div class="form-group">
<label>Username</label>
<input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>">      
</div>

<div class="form-group">
<label>Password</label>
<input type="text" name="pass" class="form-control" value="<?php echo $row['pass']; ?>">      
</div>

<div class="form-group">
<label>Tipe Akun</label>
<select name="type" class="form-control">
    <option value="User" <?php if($row['type'] == 'User'){echo 'selected';} ?>>User</option>
    <option value="Admin" <?php if($row['type'] == 'Admin'){echo 'selected';} ?>>Admin</option>
</select>  
</div>

<div class="modal-footer">  
<button type="submit" class="btn btn-success">Ubah</button>
</div>
<?php 
}
//mysql_close($host);
?>  
       
</form>
</div>
</div>

</div>
</div>



 <!-- Modal -->
  <div id="myModalTambah" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Admin</h4>
		    <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- body modal -->
		<form action="tambah-admin.php" method="get">
        <div class="modal-body">
		Nama : 
         <input type="text" class="form-control" name="nama">
		Username : 
         <input type="text" class="form-control" name="username">
		Password : 
         <input type="password" class="form-control" name="pass">
         Tipe Akun : 
         <select name="type" class="form-control">
           <option>Pilih Tipe Akun</option>
            <option value="User">User</option>
            <option value="Admin">Admin</option>
         </select>
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
		<button type="submit" class="btn btn-success" >Tambah</button>
        </div>
		</form>
        </div>
      </div>

    </div>


<?php               
} 
?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<?php require 'footer.php'?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
<?php require 'logout-modal.php';?>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
