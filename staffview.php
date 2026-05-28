<?php
include('session.php');
include('conn.php');
include('design.php');
?>

<div style="margin: 30px auto; max-width: 600px; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
  <h2 style="text-align:center;">View Staff</h2>
  <form action="staffview2.php" method="GET">
    <label>University:</label>
    <select name="uname" id="uname" class="form-control" required>
      <option value="">-- Select University --</option>
      <?php
      $res = $conn->query("SELECT uname FROM university");
      while ($row = $res->fetch_assoc()) {
        echo "<option value=\"{$row['uname']}\">{$row['uname']}</option>";
      }
      ?>
    </select><br>

    <label>College:</label>
    <select name="cname" id="cname" class="form-control" required>
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

    <button type="submit" class="btn btn-primary w-100">View Staff</button>
  </form>
</div>

<script>
document.getElementById('uname').addEventListener('change', function () {
    const uname = this.value;
    fetch('deptclg.php?uname=' + encodeURIComponent(uname))
      .then(response => response.json())
      .then(data => {
        const collegeDropdown = document.getElementById('cname');
        collegeDropdown.innerHTML = '<option value="">-- Select College --</option>';
        data.forEach(college => {
          collegeDropdown.innerHTML += `<option value="${college}">${college}</option>`;
        });

        document.getElementById('dept').innerHTML = '<option value="">-- Select Department --</option>';
      });
});

document.getElementById('cname').addEventListener('change', function () {
    const uname = document.getElementById('uname').value;
    const cname = this.value;
    fetch(`get_dept.php?uname=${encodeURIComponent(uname)}&cname=${encodeURIComponent(cname)}`)
      .then(response => response.json())
      .then(data => {
        const deptDropdown = document.getElementById('dept');
        deptDropdown.innerHTML = '<option value="">-- Select Department --</option>';
        data.forEach(dept => {
          deptDropdown.innerHTML += `<option value="${dept}">${dept}</option>`;
        });
      });
});
</script>
