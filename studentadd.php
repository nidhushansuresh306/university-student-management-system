<?php
include('session.php');
include('conn.php');
include('design.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $rollno = $_POST['rollno'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $uname = $_POST['uname'];
    $cname = $_POST['cname'];
    $dept = $_POST['dept'];

    // Handle photo upload
    $targetDir = "studentuploads/";
    $photo = basename($_FILES["photo"]["name"]);
    $targetFile = $targetDir . $photo;
    move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile);

    // Insert student data
    $stmt = $conn->prepare("INSERT INTO student (name, rollno, email, phone, photo, uname, cname, dept) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $rollno, $email, $phone, $photo, $uname, $cname, $dept);
    $stmt->execute();

    echo "<script>alert('Student added successfully');</script>";
}
?>

<div style="margin: 30px auto; max-width: 600px; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
  <h2 style="text-align:center;">Add Student</h2>
  <form method="POST" enctype="multipart/form-data">
    
    <label>Student Name:</label>
    <input type="text" name="name" required class="form-control"><br>

    <label>Roll Number:</label>
    <input type="text" name="rollno" required class="form-control"><br>

    <label>Email:</label>
    <input type="email" name="email" required class="form-control"><br>

    <label>Phone Number:</label>
    <input type="text" name="phone" required class="form-control"><br>

    <label>Photo:</label>
    <input type="file" name="photo" required class="form-control"><br>

    <label>University:</label>
    <select name="uname" id="uname" required class="form-control">
      <option value="">-- Select University --</option>
      <?php
      $res = $conn->query("SELECT uname FROM university");
      while ($row = $res->fetch_assoc()) {
          echo "<option value=\"{$row['uname']}\">{$row['uname']}</option>";
      }
      ?>
    </select><br>

    <label>College:</label>
    <select name="cname" id="cname" required class="form-control">
      <option value="">-- Select College --</option>
    </select><br>

    <label>Department:</label>
    <select name="dept" required class="form-control">
      <option value="">-- Select Department --</option>
      <option>CS</option>
      <option>Economics</option>
      <option>Physics</option>
      <option>Chemistry</option>
      <option>Business</option>
      <option>Finance</option>
    </select><br>

    <button type="submit" class="btn btn-primary" style="width: 100%;">Add Student</button>
  </form>
</div>

<script>
document.getElementById('uname').addEventListener('change', function () {
    var uname = this.value;
    var collegeDropdown = document.getElementById('cname');

    collegeDropdown.innerHTML = '<option>Loading...</option>';

    fetch('studentaddclg.php?uname=' + encodeURIComponent(uname))
        .then(response => response.json())
        .then(data => {
            collegeDropdown.innerHTML = '';
            if (data.length === 0) {
                collegeDropdown.innerHTML = '<option>No colleges found</option>';
            } else {
                data.forEach(function (college) {
                    var opt = document.createElement('option');
                    opt.value = college;
                    opt.textContent = college;
                    collegeDropdown.appendChild(opt);
                });
            }
        })
        .catch(error => {
            console.error(error);
            collegeDropdown.innerHTML = '<option>Error loading colleges</option>';
        });
});
</script>
