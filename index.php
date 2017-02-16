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
       #map {
        height: 430px;
        width: 95%;
        margin: 20px auto;
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
       .container{
         margin-left: 1.3%;
       }
    </style>


  </head>
  <body>
    <ul class="w3-container w3-navbar w3-card-4 w3-green">
      <li><a href="index.php" class="w3-padding-16"><span class="glyphicon glyphicon-home"></span> HOME</a></li>
      <li><a href="data.php" class="w3-padding-16"><span class="glyphicon glyphicon-file"></span> DATA</a></li>
      <li class="w3-right"><a class="w3-padding-16" target="_blank" href="admin-page"><span class="glyphicon glyphicon-user"></span> LOG IN</a></li>
    </ul>
    <div id="map" class="w3-card-4"></div>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAd3dSy2ivrW8j-Pmz12_bs2rwSaCapCx8&callback=initMap"></script>
    <script type="text/javascript">
      function initMap() {

        var location = new Array();

          <?php
          if(isset($_POST['cari'])){
            $kec = $_POST['kec'];
            $koor = $mysqli->koordinat($kec);
            ?>
            location = [
            <?php
            while($row = $koor->fetch_assoc()){
              ?>
              [<?php echo $row['Lat']; ?>,
              <?php echo $row['Long']; ?>,
              '<?php echo $row['Desa']; ?>',
              '<?php echo $row['Kecamatan']; ?>',
              <?php echo $row['L']; ?>,
              <?php echo $row['P']; ?>,
              <?php echo $row['Jumlah']; ?>],
              <?php
            }
           ?>
        ];
        var opt = {
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(document.getElementById('map'),opt);
        var infowindow = new google.maps.InfoWindow(),marker,i;
        var bounds = new google.maps.LatLngBounds();
        for (i = 0; i < location.length; i++) {
          /*
          load semua marker dari database
          */
          pos = new google.maps.LatLng(location[i][0],location[i][1]);
          bounds.extend(pos);
          marker = new google.maps.Marker({
            position: pos,
            map: map
          });
          /*
          menambahkan event click untuk menampilkan infowindow sesuai dengan marker yang di pilih
          */
          google.maps.event.addListener(marker,'click',(function(marker,i){
            return function(){
              infowindow.setContent('<h3>Desa '+location[i][2]+'<h3>'+
                                    '<h6>Kecamatan '+location[i][3]+'</h6><hr>'+
                                    '<h4>Jumlah Penduduk</h4>'+
                                    '<p><b>Laki - laki : '+location[i][4]+'<br>'+
                                    'Perempuan : '+location[i][5]+'<br>'+
                                    'Jumlah : '+location[i][6]+'</b></p>'
                                    );
              infowindow.open(map,marker);
            }
          })(marker,i));
        }
        map.fitBounds(bounds);
        <?php
      }else{
        ?>
        var mapOpt = {
          zoom: 8,
          center: new google.maps.LatLng(-6.7612234,108.1853978),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(document.getElementById('map'),mapOpt);
        <?php
      }
      ?>
    }
    </script>
    <div class="container">
      <div class="row">
        <form action="" method="post">
          <div class="col-sm-4">
            <select class="w3-select w3-card-4" name="kec" required>
              <option value="">-- Pilih --</option>
              <?php
              while ($row = $cari->fetch_assoc()) {
                ?>
                <option value=<?php echo $row['kec']; ?>><?php echo ucfirst($row['kec']); ?></option>
                <?php
              }
               ?>
            </select>
          </div>
          <div class="w3-third">
            <input class="w3-btn w3-green w3-card-4" type="submit" name="cari" value="Cari">
          </div>
        </form>
      </div>
    </div>
  </body>
  <?php
  require_once 'template/footer_web.php';
   ?>
</html>
