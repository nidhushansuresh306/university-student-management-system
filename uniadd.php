<?php
// Start session and output buffering
ob_start();

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include DB connection
include('session.php'); // session_start() is already inside this
include('conn.php');


// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if (isset($_POST['submit'])) {
    $uname = trim($_POST['uname']);

    // Check if the university already exists
    $stmt = $conn->prepare("SELECT id FROM university WHERE uname = ?");
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // University already exists
        echo "<script>alert('University already exists.'); window.location.href='adduniversity.php';</script>";
    } else {
        // Insert the new university
        $insertStmt = $conn->prepare("INSERT INTO university (uname) VALUES (?)");
        $insertStmt->bind_param("s", $uname);

        if ($insertStmt->execute()) {
            echo "<script>alert('University added successfully.'); window.location.href='uniview.php';</script>";
        } else {
            echo "Error inserting university: " . $conn->error;
        }

        $insertStmt->close();
    }

    $stmt->close();
    $conn->close();
}
?>

<?php include('design.php'); ?>

<h2 style="text-align:center; margin-bottom: 20px;">Add University</h2>

<form method="post" action="" style="max-width: 400px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
    <label for="uname" style="display: block; margin-bottom: 10px;">University Name:</label>
    <input type="text" name="uname" id="uname" required style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;">
    
    <button type="submit" name="submit" style="background-color: #2c3e50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Add University</button>
</form>

</div> <!-- close content -->
</div> <!-- close main -->
</body>
</html>

<?php ob_end_flush(); ?>
