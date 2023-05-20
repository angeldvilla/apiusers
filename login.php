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
}

// Obtiene los datos de la solicitud POST
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$password = $data['password'];

// Busca el usuario en la base de datos
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

// Si el usuario no existe, devuelve un error
if ($result->num_rows == 0) {
  $response = array('status' => 'error', 'message' => 'Nombre de usuario incorrecto');
  header('Content-Type: application/json');
  echo json_encode($response);
  exit;
}

// Obtiene la fila del usuario
$row = $result->fetch_assoc();

// Verifica la contraseña del usuario
if (password_verify($password, $row['password'])) {
  // Si la contraseña es correcta, devuelve un mensaje de éxito
  $response = array('status' => 'success', 'message' => 'Inicio de sesión exitoso');
  header('Content-Type: application/json');
  echo json_encode($response);
} 

  else {
  // Si la contraseña es incorrecta, devuelve un error
  $response = array('status' => 'error', 'message' => 'Contraseña incorrecta');
  header('Content-Type: application/json');
  echo json_encode($response);
}

// Cierra la conexión a la base de datos
$conn->close();
?>