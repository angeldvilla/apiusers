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
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

   //CONSULTA PARA MOSTRAR LOS USUARIOS
  $sql = "SELECT * FROM users";
  $result = $conn->query($sql);

  $users = array();
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $users[] = $row;
    }
  }

  header('Content-Type: application/json');
  echo json_encode($users);
}
?>