<?php
include('conn.php');
include('session.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sname = $_POST['sname'];
    $staffid = $_POST['staffid'];
    $sphone = $_POST['sphone'];
    $semail = $_POST['semail'];
    $uname = $_POST['uname'];
    $cname = $_POST['cname'];
    $dept = $_POST['dept'];

    // Upload photo
    $targetDir = "staffuploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir);
    }

    $photoName = basename($_FILES["sphoto"]["name"]);
    $targetFilePath = $targetDir . time() . "_" . $photoName;

    if (move_uploaded_file($_FILES["sphoto"]["tmp_name"], $targetFilePath)) {
        $stmt = $conn->prepare("INSERT INTO staff (sname, staffid, sphone, semail, sphoto, uname, cname, dept) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $sname, $staffid, $sphone, $semail, $targetFilePath, $uname, $cname, $dept);
        if ($stmt->execute()) {
            echo "<script>alert('Staff added successfully'); window.location='staffadd.php';</script>";
        } else {
            echo "Database error: " . $stmt->error;
        }
    } else {
        echo "Failed to upload image.";
    }
}
?>
