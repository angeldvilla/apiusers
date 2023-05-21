<?php
require_once('cors.php');
header('Content-Type: application/json');

// Obtener los datos enviados por POST
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$password = $data['password'];

// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'users_api');

// Verificar si hay errores de conexión
if ($mysqli->connect_errno) {
  $response = array('status' => 'error', 'message' => 'Error connecting to the database');
} else {
  // Consultar la base de datos para verificar las credenciales del usuario
  $stmt = $mysqli->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
  $stmt->bind_param('ss', $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $response = array('status' => 'success', 'message' => 'Login successful');
  } else {
    $response = array('status' => 'error', 'message' =>'Incorrect data, try again!');
  }

  // Cerrar la conexión a la base de datos
  $stmt->close();
  $mysqli->close();
}

// Devolver la respuesta como JSON
echo json_encode($response);