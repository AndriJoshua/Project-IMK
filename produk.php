<?php
include 'Database.php';
header("Content-Type: application/json");

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = 0;
}

if ($id > 0) {
    $stmt = $conn->prepare("SELECT * FROM produk WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    echo json_encode($result->fetch_assoc());
} else {
    $result = $conn->query("SELECT * FROM produk");
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
}
