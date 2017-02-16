<?php

require_once 'classes/database.php';
$mysqli = new Database();
$cari = $mysqli->show();

?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/dist/css/dataTables.bootstrap.css">
    <link rel="stylesheet" href="assets/dist/css/jquery.dataTables.css">
    <link rel="stylesheet" href="assets/dist/css/sweetalert.css">
    <link rel="stylesheet" href="assets/dist/css/w3.css">
    <script type="text/javascript" src="assets/dist/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/dist/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="assets/dist/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/dist/js/sweetalert.min.js"></script>
    <style>
    body{
      padding-bottom: 80px;
    }
       .footer p{
         padding-top: 20px;
         padding-left: 30px;
         display: inline-block;

       }
       .footer ul{
         display: inline-block;
       }
       .footer li{
         display: inline;
         text-decoration: none;
         padding-right: 10px;
       }
    </style>
  </head>
  <body>
    <ul class="w3-container w3-navbar w3-card-4 w3-green">
      <li><a href="index.php" class="w3-padding-16"><span class="glyphicon glyphicon-home"></span> HOME</a></li>
      <li><a href="data.php" class="w3-padding-16"><span class="glyphicon glyphicon-file"></span> DATA</a></li>
      <li class="w3-right"><a class="w3-padding-16" target="_blank" href="admin-page"><span class="glyphicon glyphicon-user"></span> LOG IN</a></li>
    </ul>
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
      <table class="table table-hover table-bordered table-condensed w3-card-2 w3-small data">
        <thead>
          <tr class="bg-primary">
            <td>No.</td>
            <td>Desa</td>
            <td>Kecamatan</td>
            <td>Laki - Laki</td>
            <td>Perempuan</td>
            <td>Jumlah</td>
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
              </tr>
            <?php
            $jumlah = $jumlah + $row['Jumlah'];
            }
            ?>
            <tfoot>
              <tr>
                <td colspan="5" style="text-align:right"><b>Total</b></td>
                <td><b><?php echo $jumlah; ?></b></td>
              </tr>
            </tfoot>

          <?php
          }
          ?>

        </tbody>
      </table>
    </div>
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
  </body>
  <?php
  require_once 'template/footer_web.php';
   ?>
</html>
