<?php

class Conexion {
	
 public function getConexion(){
   $host = "localhost";  // localhost -> 127.0.0.1
   $db = "users_api";      //base de datos de mysql
   $user = "root";       // usuario de mysql
   $password = "";       //contraseña de mysql

//conexion a la base datos utilizando pdo
 $db = new PDO("mysql:host=$host;dbname=$db;", $user, $password);

  return $db;
}

}

?>