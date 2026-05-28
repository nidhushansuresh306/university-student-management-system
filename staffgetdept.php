<?php
include('conn.php');

if (isset($_GET['uname']) && isset($_GET['cname'])) {
    $uname = $_GET['uname'];
    $cname = $_GET['cname'];

    $stmt = $conn->prepare("SELECT dept FROM department WHERE uname = ? AND cname = ?");
    $stmt->bind_param("ss", $uname, $cname);
    $stmt->execute();
    $result = $stmt->get_result();

    $departments = [];
    while ($row = $result->fetch_assoc()) {
        $departments[] = $row['dept'];
    }

    echo json_encode($departments);
}
?>
