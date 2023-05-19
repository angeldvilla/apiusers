<?php
require_once('connection.php');
require_once('api.php');
require_once('cors.php');

//obteniedo el metodo http
$method = $_SERVER['REQUEST_METHOD'];

if($method === "GET") {
    if(!empty($_GET['id_user'])){
       $id = $_GET['id_user'];
       $json = null;
       $api = new Api();
       $vector = $api->getUser($id);
       $json = json_encode($vector);
       echo $json; 
    }else{
       $vector = array();
       $api = new Api();
       $vector = $api->getUsers();
       $json = json_encode($vector);
       echo $json;
    }
   
}

?>