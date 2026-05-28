<!DOCTYPE html>
<html>
<head>
    <title>Upload Student</title>
</head>
<body>

<h2>Upload Student Details</h2>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="text" name="email" required><br><br>
    Phone: <input type="text" name="phone" required><br><br>
    Department: <input type="text" name="dpet" required><br><br>
    Image: <input type="file" name="image" required><br><br>
    <input type="submit" name="submit" value="Upload Student">
</form>

<?php
if (isset($_POST['submit'])) {
    include('conn.php');

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dpet = $_POST['dpet'];

    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $target = "uploads/" . basename($image);

    if (move_uploaded_file($tmp_name, $target)) {
        $query = "INSERT INTO student (name, email, phone, dpet, img) VALUES ('$name', '$email', '$phone', '$dpet', '$target')";
        if (mysqli_query($conn, $query)) {
            echo "Student uploaded successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Image upload failed.";
    }
}
?>

</body>
</html>
