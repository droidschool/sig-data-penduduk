<?php
session_start();
require_once '../classes/Database.php';
require_once '../template/header.php';
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $edit = new Database();
  $cari = $edit->edit($id);
}
?>
<body>
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">SIG Data Penduduk</a>
      </div>
      <ul class="nav navbar-nav">
        <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li class="dropdown active"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"></span> Data <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="data_penduduk.php">Data Penduduk</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> Admin<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <div class="page-header">
      <h3>Edit Data</h3>
    </div>
    <div class="ro">
      <div class="col-sm-3">
        <form class="" role="form" action="" method="post">
          <?php

          while($row = $cari->fetch_assoc()){

          ?>
          <div class="form-group">
            <label for="desa">Desa</label>
            <input type="text" class="form-control" name="desa" value="<?php echo $row['Desa']; ?>" disabled>
          </div>
          <div class="form-group">
            <label for="kecamatan">Kecamatan</label>
            <input type="text" class="form-control" name="kecamatan" value="<?php echo $row['Kecamatan']; ?>" disabled>
          </div>
          <div class="form-group">
            <label for="l">Jumlah Laki-laki</label>
            <input type="number" class="form-control" name="l" value="<?php echo $row['L']; ?>" required>
          </div>
          <div class="form-group">
            <label for="p">Jumlah Perempuan</label>
            <input type="number" class="form-control" name="p" value="<?php echo $row['P']; ?>" required>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" name="update" value="update">
            <a href="data_penduduk.php" class="btn btn-warning">Batal</a>
          </div>
          <?php
          }
          if(isset($_POST['update'])){
            $l = $_POST['l'];
            $p = $_POST['p'];
            $jumlah = $l + $p;
            $update = $edit->update($id,$l,$p,$jumlah);
            if($update){
              echo '<script> swal("Kerja Bagus !","Data berhasil di Update","success"); </script>';
              header("Location : data_penduduk.php");
            }else{
              echo '<script> swal("Oopss ...","Terjadi kesalahan","error"); </script>';
            }
            // if(is_int($l) AND is_int($p)){
            //
            // }else{
            //   echo '<script> swal("Oopss ...","Harus Integer","error"); </script>';
            // }
          }
           ?>
        </form>
      </div>
    </div>
  </div>
</body>
<?php
require_once '../template/footer.php';
 ?>
</html>
