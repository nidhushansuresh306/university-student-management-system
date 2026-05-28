<?php
include('session.php');
include('conn.php');
include('design.php');

// Insert department on form submit
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['university'];
    $cname = $_POST['college'];
    $dept = trim($_POST['department']);

    if (!empty($uname) && !empty($cname) && !empty($dept)) {
        $stmt = $conn->prepare("INSERT INTO department (uname, cname, dept) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $uname, $cname, $dept);
        if ($stmt->execute()) {
            $message = "Department added successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
        $stmt->close();
    }
}

// Fetch universities for dropdown
$universities = $conn->query("SELECT DISTINCT uname FROM university");
?>

<div style="max-width:600px; margin:40px auto; background:white; padding:30px; border-radius:10px; box-shadow:0 5px 15px rgba(0,0,0,0.1);">
    <h2 style="text-align:center; color:#2c3e50;">Add Department</h2>

    <?php if ($message): ?>
        <p style="text-align:center; color:green;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>University:</label>
        <select name="university" id="university" required style="width:100%; padding:10px; margin-bottom:15px;">
            <option value="">-- Select University --</option>
            <?php while ($row = $universities->fetch_assoc()): ?>
                <option value="<?php echo htmlspecialchars($row['uname']); ?>"><?php echo htmlspecialchars($row['uname']); ?></option>
            <?php endwhile; ?>
        </select>

        <label>College:</label>
        <select name="college" id="college" required style="width:100%; padding:10px; margin-bottom:15px;">
            <option value="">-- Select College --</option>
        </select>

        <label>Department:</label>
        <input type="text" name="department" required style="width:100%; padding:10px; margin-bottom:15px;">

        <input type="submit" value="Add Department" style="background-color:#2a5298; color:white; padding:10px 20px; border:none; border-radius:5px; cursor:pointer;">
    </form>
</div>

<script>
    document.getElementById('university').addEventListener('change', function () {
        var uname = this.value;

        fetch('deptclg.php?uname=' + encodeURIComponent(uname))
            .then(response => response.json())
            .then(data => {
                const collegeSelect = document.getElementById('college');
                collegeSelect.innerHTML = '<option value="">-- Select College --</option>';
                data.forEach(function (college) {
                    const option = document.createElement('option');
                    option.value = college;
                    option.textContent = college;
                    collegeSelect.appendChild(option);
                });
            });
    });
</script>

</div> <!-- content -->
</div> <!-- main -->
</body>
</html>
