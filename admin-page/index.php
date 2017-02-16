<?php
session_start();
if(empty($_SESSION['id'])){
  header('Location: login.php');
}
require_once '../classes/database.php';
require_once '../template/header.php';
?>

  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="">SIG Data Penduduk</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"></span> Data <span class="caret"></span></a>
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
        <h3><span class="glyphicon glyphicon-thumbs-up"></span> Selamat Datang Admin</h3>
      </div>
      <div class="jumbotron">
        <h4>Sistem Informasi Geografis Pemetaan Penduduk</h4>
        <p></p>
      </div>
    </div>
    <script src="../assets/dist/js/jquery-2.2.3.min.js"></script>
  </body>
  <?php
  require_once '../template/footer.php';
   ?>
</html>
