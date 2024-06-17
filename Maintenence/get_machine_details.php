<?php
include 'db_connection.php';

if (isset($_GET['machine_id'])) {
    $machineId = $_GET['machine_id'];
    $sql = "SELECT machineName, costCenter FROM requests WHERE machineId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $machineId);
    $stmt->execute();
    $stmt->bind_result($machineName, $costCenter);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    $response = array(
        'machineName' => $machineName,
        'costCenter' => $costCenter
    );

    echo json_encode($response);
}
?>
