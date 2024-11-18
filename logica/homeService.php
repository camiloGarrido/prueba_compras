<?php 

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
include "../seguridad/config.php";

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
    $idProducto = $r["idproductos"];
    $stmt2 = $conn->prepare("SELECT * FROM `imagenes` where idProducto = ? and estado = 1");
    $stmt2->bind_param("i", $idProducto);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $rows2 = array();
    while($r2 = $result2->fetch_assoc()) {
        $rows2[] = $r2;
    }
    $r["imagenes"] =$rows2; 
     $rows[] = $r; 
    } 
     // Imprime el resultado como JSON print json_encode($rows); 
     } else { 
      
      $rows = [];
     
     }

     echo json_encode($rows);
$conn->close();
?>