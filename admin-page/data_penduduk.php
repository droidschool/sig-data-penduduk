<?php
session_start();
if(empty($_SESSION['id'])){
  header('Location: login.php');
}
require_once '../classes/Database.php';
require_once '../template/header.php';
$mysqli = new Database();
$cari = $mysqli->show();
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
        <li><a href="../"><span class="glyphicon glyphicon-globe"></span> Web</a></li>
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
      <h3>Data Jumlah Penduduk</h3>
    </div>
    <p>
      Data jumlah penduduk Kabupaten Cirebon Semester 1 Tahun 2016
    </p>
    <div class="row">
      <div class="col-sm-6">
        <div class="page-header">
          <h4>Pilih Kecamatan</h4>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <form class="form-inline" role="form" action="" method="post">
          <div class="form-group">
              <select class="form-control" name="kec">
                <option value="">-- Pilih salah satu --</option>
                <?php
                while ($row = $cari->fetch_assoc()) {
                  ?>
                  <option value=<?php echo $row['kec']; ?>><?php echo ucfirst($row['kec']); ?></option>
                  <?php
                }
                 ?>
              </select>
          </div>
          <div class="form-group">
            <input class="form-control btn btn-success" type="submit" name="show" value="Lihat">
          </div>
        </form>
      </div>
    </div>
    <br>
    <table class="table table-hover table-bordered table-condensed data">
      <thead>
        <tr class="bg-primary">
          <td>No.</td>
          <td>Desa</td>
          <td>Kecamatan</td>
          <td>Laki - Laki</td>
          <td>Perempuan</td>
          <td>Jumlah</td>
          <td>Aksi</td>
        </tr>
      </thead>
      <tbody>
        <?php
        if(isset($_POST['show'])){
          $i = 1;
          $kec = $_POST['kec'];
          $hasil = $mysqli->sub_data($kec);
          $jumlah = 0;
          while($row = $hasil->fetch_assoc()){

            ?>
            <tr>
              <td><?php echo $i++; ?></td>
              <td><?php echo ucfirst($row['Desa']); ?></td>
              <td><?php echo ucfirst($row['Kecamatan']); ?></td>
              <td><?php echo $row['L']; ?></td>
              <td><?php echo $row['P']; ?></td>
              <td><?php echo $row['Jumlah']; ?></td>
              <td><a class="btn btn-xs btn-warning" href="edit.php?id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-wrench"></span> Edit</a></td>
            </tr>
          <?php
          $jumlah = $jumlah + $row['Jumlah'];
          }
          ?>
          <tfoot>
            <tr>
              <td colspan="5" style="text-align:right"><b>Total</b></td>
              <td colspan="2"><b><?php echo $jumlah; ?></b></td>
            </tr>
          </tfoot>

        <?php
        }
        ?>

      </tbody>
    </table>
  </div>
</body>
<script>
  $(document).ready(function(){
    $('.data').DataTable({
      "language":{
      "url":"http://cdn.datatables.net/plug-ins/1.10.13/i18n/Indonesian.json",
      "sEmptyTable":"Tidak ada data di Database"
    }
    });
  });
</script>
<?php
require_once '../template/footer.php';
 ?>
</html>
