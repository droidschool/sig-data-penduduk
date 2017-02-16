<?php

class Database{


  // private static $INSTANCE = null;
  public $mysqli;
  public $HOST = 'localhost',
          $USER = 'root',
          $PASS = '',
          $DBNAME = 'disduk';

  public function __construct(){
    $this->mysqli = new mysqli($this->HOST,$this->USER,$this->PASS,$this->DBNAME);
    if(mysqli_connect_error()){
      die('Koneksi Gagal');
    }
  }

  public function show(){
    $query = $this->mysqli->query("SELECT kec FROM kab order by kec asc");
    return $query;
  }

  public function sub_data($kec){
    $query = "SELECT No as id,Desa,Kecamatan,P,L,Jumlah FROM penduduk WHERE Kecamatan = '$kec'";
    $sql = $this->mysqli->query($query);
    return $sql;
  }

  public function edit($id){
    $query = "SELECT No,Desa,Kecamatan,P,L FROM penduduk WHERE No = '$id'";
    $sql = $this->mysqli->query($query);
    return $sql;
  }

  public function update($id,$l,$p,$jml){
    $query = "UPDATE Penduduk set L=$l,P=$p,Jumlah=$jml WHERE No=$id";
    $sql = $this->mysqli->query($query);
    return $sql;
  }

  public function login($user){
    $query = "SELECT * FROM user WHERE user = '$user'";
    $sql = $this->mysqli->query($query);
    return $sql;
  }

  public function koordinat($kec){
    $query = "SELECT * FROM penduduk WHERE Kecamatan = '$kec'";
    $sql = $this->mysqli->query($query);
    return $sql;
  }
}

//
//   public static function getInstance(){
//     if(!isset(self::$INSTANCE)){
//       self::$INSTANCE = new Database();
//     }else{
//       return self::$INSTANCE;
//     }
//   }
// }
?>
