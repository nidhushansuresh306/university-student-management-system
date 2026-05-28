<?php
include('session.php');
include('conn.php');
include('design.php'); // header/sidebar
?>

<div style="margin: 30px auto; max-width: 600px; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
  <h2 style="text-align:center; color: #2c3e50;">Add Staff</h2>
  <form action="staffinsert.php" method="POST" enctype="multipart/form-data">
    <label>Staff Name:</label>
    <input type="text" name="sname" required class="form-control" style="margin-bottom: 15px;">

    <label>Staff ID:</label> <!-- Added -->
    <input type="text" name="staffid" required class="form-control" style="margin-bottom: 15px;">

    <label>Phone Number:</label>
    <input type="text" name="sphone" required class="form-control" style="margin-bottom: 15px;">

    <label>Email:</label>
    <input type="email" name="semail" required class="form-control" style="margin-bottom: 15px;">

    <label>Photo:</label>
    <input type="file" name="sphoto" accept="image/*" required class="form-control" style="margin-bottom: 15px;">

    <label>University:</label>
    <select name="uname" id="uname" required class="form-control" style="margin-bottom: 15px;">
      <option value="">-- Select University --</option>
      <?php
      $res = $conn->query("SELECT uname FROM university");
      while ($row = $res->fetch_assoc()) {
        echo "<option value=\"{$row['uname']}\">{$row['uname']}</option>";
      }
      ?>
    </select>

    <label>College:</label>
    <select name="cname" id="cname" required class="form-control" style="margin-bottom: 15px;">
      <option value="">-- Select College --</option>
    </select>

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

    <button type="submit" class="btn btn-primary w-100">Submit</button>
  </form>
</div>

<script>
document.getElementById('uname').addEventListener('change', function () {
    let uname = this.value;

    fetch('deptclg.php?uname=' + encodeURIComponent(uname))
        .then(response => response.json())
        .then(data => {
            let cnameDropdown = document.getElementById('cname');
            cnameDropdown.innerHTML = '<option value="">-- Select College --</option>';
            data.forEach(college => {
                cnameDropdown.innerHTML += `<option value="${college}">${college}</option>`;
            });
            document.getElementById('dept').innerHTML = '<option value="">-- Select Department --</option>';
        });
});

document.getElementById('cname').addEventListener('change', function () {
    let uname = document.getElementById('uname').value;
    let cname = this.value;

    fetch(`get_dept.php?uname=${encodeURIComponent(uname)}&cname=${encodeURIComponent(cname)}`)
        .then(response => response.json())
        .then(data => {
            let deptDropdown = document.getElementById('dept');
            deptDropdown.innerHTML = '<option value="">-- Select Department --</option>';
            data.forEach(dept => {
                deptDropdown.innerHTML += `<option value="${dept}">${dept}</option>`;
            });
        });
});
</script>
