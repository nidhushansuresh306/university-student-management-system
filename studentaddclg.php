<?php
include('conn.php');

if (isset($_GET['uname'])) {
    $uname = $_GET['uname'];

    $stmt = $conn->prepare("SELECT cname FROM college WHERE uname = ?");
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    $result = $stmt->get_result();

    $colleges = [];
    while ($row = $result->fetch_assoc()) {
        $colleges[] = $row['cname'];
    }

    header('Content-Type: application/json');
    echo json_encode($colleges);
    exit;
}
?>
