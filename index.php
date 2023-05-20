<?php
require_once('connection.php');
require_once('api.php');
require_once('cors.php');

//obteniedo el metodo http
$method = $_SERVER['REQUEST_METHOD'];


//METODO PARA TRAER USUARIOS
if($method == "GET") {
   if(!empty($_GET['id_user'])){
      $id_user = $_GET['id_user'];
      $json = null;
      $api = new Api();
      $vector = $api->getUser($id_user);
      $json = json_encode($vector);
      echo $json;
   } else{
      $vector = array();
      $api = new Api();
      $vector = $api->getUsers();
      $json = json_encode($vector);
      echo $json; 
   }
    }
//METODO PARA TRAER USUARIOS


//METODO PARA AGREGAR USUARIOS
if($method == "POST"){
   $json = null;
   $data = json_decode(file_get_contents("php://input"), true);
   $username = $data['username'];
   $password = $data['password'];
   $name = $data['name'];
   $lastname = $data['lastname'];
   $email = $data['email'];
   $cellphone = $data['cellphone'];
   $api = new Api();
   $json = $api->addUser($username, $password, $name, $lastname, $email, $cellphone);
   echo $json;
}
//METODO PARA AGREGAR USUARIOS



//METODO PARA ACTUALIZAR USUARIOS
if($method == "PUT"){
   $json = null;
   $data = json_decode(file_get_contents("php://input"), true);
   $id_user = $data['id_user'];
   $username = $data['username'];
   $password = $data['password'];
   $name = $data['name'];
   $lastname = $data['lastname'];
   $email = $data['email'];
   $cellphone = $data['cellphone'];
   $api = new Api();
   $json = $api->updateUser($id_user, $username, $password, $name, $lastname, $email, $cellphone);
   echo $json;
}
//METODO PARA ACTUALIZAR USUARIOS


//METODO PARA ELIMINAR USUARIOS
if($method == "DELETE"){
   $json = null;
   $id_user = $_REQUEST['id_user'];
   $api = new Api();
   $json = $api->deleteUser($id_user);
   echo $json;
}
//METODO PARA ELIMINAR USUARIOS


?>