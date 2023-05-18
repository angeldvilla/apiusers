<?php
// Conexión a la base de datos MySQL
$host = "localhost";
$username = "root";
$password = "";
$dbname = "users_api";

$conn = new mysqli($host, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
  die("Error al conectar a la base de datos: " . $conn->connect_error);
} else {
  echo "Conexión exitosa a la base de datos";
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);

  $username = $data['username'];
  $password = password_hash($data['password'], PASSWORD_DEFAULT);
  $name = $data['name'];
  $lastname = $data['lastname'];
  $email = $data['email'];
  $cellphone = $data['cellphone'];

  $sql = "INSERT INTO users (username, password, name, lastname, email, cellphone) VALUES ('$username', '$password', '$name', '$lastname', '$email', '$cellphone' )";
  if ($conn->query($sql) === TRUE) {
    $response = array('status' => 'success');
  } else {
    $response = array('status' => 'error', 'message' => $conn->error);
  }

  header('Content-Type: application/json');
  echo json_encode($response);
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
  $data = json_decode(file_get_contents('php://input'), true);

  //DEFINIR LAS VARIABLES
  $id = $data['id_user'];
  $username = $data['username'];
  $password = password_hash($data['password'], PASSWORD_DEFAULT);
  $name = $data['name'];
  $lastname = $data['lastname'];
  $email = $data['email'];
  $cellphone = $data['cellphone'];

  //CONSULTA PARA ACTUALIZAR
  $sql = "UPDATE users SET username='$username', password='$password', name='$name', lastname='$lastname', email='$email', cellphone='$cellphone' WHERE id=$id";

  //CONDICIONALES PARA VALIDAR LA ACTUALIZACIÓN
  if ($conn->query($sql) === TRUE) {
    $response = array('status' => 'success');
  } else {
    $response = array('status' => 'error', 'message' => $conn->error);
  }

  //RESPUESTA DEL SERVER(API)
  header('Content-Type: application/json');
  echo json_encode($response);
}
?>