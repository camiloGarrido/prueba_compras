<?php 

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
include "../seguridad/config.php";

$id = isset($_GET["id"]) ? $_GET["id"] : 0;

$input = file_get_contents("php://input");  
$data = json_decode($input, true); 
$idPost = isset( $data['save']) ?  $data['save'] : 0;

//Codigo guardar
if($idPost != 0){
  
  if($idPost==1){
    $nombre = isset( $data['nombre']) ?  $data['nombre'] : "-";
    $precio = isset( $data['precio']) ?  $data['precio'] : "0";

    $categoria = isset( $data['idCategoria']) ?  $data['idCategoria'] : "-";
    $sql = " INSERT INTO `productos`( `nombre`, `precio`,`idCategoria`, `estado` ) VALUES (?,?,?,1);";
    if(!$categoria ||  !$precio){
      echo json_encode(array("message" => 500));
      die;
    }

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "Error en la preparación de la consulta: " . $conn->error;
    } else {
        $stmt->bind_param("sii", $nombre,$precio,$categoria);

        if ($stmt->execute()) {
          echo json_encode(array("message" => 200));
        } else {
          echo json_encode(array("message" => $stmt->error));
        }
    }

    $stmt->close();
  }

  die();
}


//Codigo actualizar

$idPost = isset( $data['update']) ?  $data['update'] : 0;

if($idPost != 0){
  $id = isset( $data['id']) ?  $data['id'] : "-";
  if($idPost == 1){
    $nombre = isset( $data['nombre']) ?  $data['nombre'] : "-";
    $idCategoria = isset( $data['idCategoria']) ?  $data['idCategoria'] : "-";
    $precio = isset( $data['precio']) ?  $data['precio'] : "0";

    $sql = "UPDATE `productos` SET `nombre`=?,`idCategoria`=?, `precio`=? WHERE idproductos = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "Error en la preparación de la consulta: " . $conn->error;
    } else {
        $stmt->bind_param("siii", $nombre, $idCategoria,$precio,$id);

        if ($stmt->execute()) {
          echo json_encode(array("message" => 200));
        } else {
          echo json_encode(array("message" => $stmt->error));
        }
    }

    $stmt->close();
  }else  if($idPost == -1){
    $sql = "UPDATE `productos` SET estado = 0 WHERE idproductos = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "Error en la preparación de la consulta: " . $conn->error;
    } else {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
          echo json_encode(array("message" => 200));
        } else {
          echo json_encode(array("message" => $stmt->error));
        }
    }

    $stmt->close();
  }
  die();
}





//$stmt = $conn->prepare("SELECT * FROM `tarea` WHERE id = ?");
//$stmt->bind_param("i", $id);

$stmt = $conn->prepare("SELECT productos.*, categorias.nombre as nombreCategoria FROM `productos`
                         inner join categorias 
                         on productos.idCategoria = categorias.idcategorias
                         where productos.estado = 1
                         order by 1 desc ");


$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) { 
  $rows = array();
  while($r = $result->fetch_assoc()) {
     $rows[] = $r; 
    } 
     // Imprime el resultado como JSON print json_encode($rows); 
     } else { 
      
      $rows = [];
     
     }

     echo json_encode($rows);
$conn->close();
?>
