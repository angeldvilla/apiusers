<?php
 
class Api{

    //MOSTRAR TODOS LOS USUARIOS
public function getUsers(){
     $vector = array();
     $conexion = new Conexion();
     $db = $conexion->getConexion();
     $sql = "SELECT * FROM users";
     $consulta = $db->prepare($sql);
     $consulta->execute();
     while($fila = $consulta->fetch()) {
        $vector[] = array(
            " id_user " => $fila['id_user'],
            " username " => $fila['username'],
            " password " =>  $fila['password'],
            " name " =>  $fila['name'],
            " lastname " =>  $fila['lastname'],
            " email " =>  $fila['email'],
            " cellphone " =>  $fila['cellphone'],
        ); }

     return $vector;
}
//MOSTRAR TODOS LOS USUARIOS


//AGREGAR UN USUARIO
public function addUser($username, $password, $name, $lastname, $email, $cellphone){
  
    $conexion = new Conexion();
    $db = $conexion->getConexion();
    $sql = "INSERT INTO users (username, password, name, lastname, email, cellphone) VALUES (:username,:password,:name,:lastname,:email,:cellphone)";
    $consulta = $db->prepare($sql);
    $consulta->bindParam(':username', $username);
    $consulta->bindParam(':password', $password);
    $consulta->bindParam(':name', $name);
    $consulta->bindParam(':lastname', $lastname);
    $consulta->bindParam(':email', $email);
    $consulta->bindParam(':cellphone', $cellphone);
    
    $consulta->execute();

    /* $success = $consulta->execute(); */
  
    return '{"msg":"User added successfully"}';
    
}
//AGREGAR UN USUARIO


//ACTUALIZAR UN USUARIO
public function getUser($id_user){
    $vector = array();
    $conexion = new Conexion();
    $db = $conexion->getConexion();
    $sql = "SELECT id_user, username, password, name, lastname, email, cellphone FROM users WHERE id_user=:id_user";
    $consulta = $db->prepare($sql);
    $consulta->bindParam(':id_user', $id_user);
    $consulta->execute();
    while($fila = $consulta->fetch()) {
       $vector[] = array(
         "id_user" => $fila['id_user'],
         "username" => $fila['username'],
         "password" => $fila['password'],
         "name" =>  $fila['name'],
         "lastname" =>  $fila['lastname'],
         "email" =>  $fila['email'],
         "cellphone" =>  $fila['cellphone']);
        }
  
    return $vector[0];
  }
  

  public function updateUser($id_user, $username, $password, $name, $lastname, $email, $cellphone){
    
    $conexion = new Conexion();
    $db = $conexion->getConexion();
    $sql = "UPDATE users SET username=:username, password=:password, name=:name, lastname=:lastname, email=:email, cellphone=:cellphone WHERE id_user=:id_user";
    $consulta = $db->prepare($sql);
    $consulta->bindParam(':id_user', $id_user);  
    $consulta->bindParam(':username', $username);
    $consulta->bindParam(':password', $password);
    $consulta->bindParam(':name', $name);
    $consulta->bindParam(':lastname', $lastname);
    $consulta->bindParam(':email', $email);
    $consulta->bindParam(':cellphone', $cellphone);

    $consulta->execute();
  
    return '{"msg":"User updated successfully"}';
  }
//ACTUALIZAR UN USUARIO

//BORRAR UN USUARIO
public function deleteUser($id_user){
    $conexion = new Conexion();
    $db = $conexion->getConexion();
    $sql = "DELETE FROM users WHERE id_user=:id_user";
    $consulta = $db->prepare($sql);
    $consulta->bindParam(':id_user', $id_user); 
    $consulta->execute();
  
    return '{"msg":"User deleted successfully"}';
  }

//BORRAR UN USUARIO

}

?>