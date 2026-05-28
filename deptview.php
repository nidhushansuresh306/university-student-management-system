<?php
include('session.php');
include('conn.php');
include('design.php'); // your sidebar/header
?>

<div style="margin: 30px auto; max-width: 600px; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
  <h2 style="text-align:center; color: #2c3e50;">View Departments</h2>
  <form method="GET" action="deptview2.php">
    <label for="uname">Select University:</label>
    <select name="uname" id="uname" required style="width:100%; padding:10px; margin-bottom:20px;">
      <option value="">-- Select University --</option>
      <?php
      $res = $conn->query("SELECT uname FROM university");
      while ($row = $res->fetch_assoc()) {
        echo "<option value=\"{$row['uname']}\">{$row['uname']}</option>";
      }
      ?>
    </select>

    <label for="cname">Select College:</label>
    <select name="cname" id="cname" required style="width:100%; padding:10px; margin-bottom:20px;">
      <option value="">-- Select College --</option>
    </select>

    <button type="submit" style="width:100%; background-color: #2a5298; color: white; padding: 12px; border: none; border-radius: 5px;">View Departments</button>
  </form>
</div>

<script>
    function loadColleges() {
        var university = document.getElementById('uname').value;
        var collegeSelect = document.getElementById('cname');
        collegeSelect.innerHTML = '<option>Loading...</option>';

        fetch('deptclg.php?uname=' + encodeURIComponent(university))
            .then(response => response.json())
            .then(data => {
                collegeSelect.innerHTML = '';
                if (data.length === 0) {
                    collegeSelect.innerHTML = '<option>No colleges found</option>';
                } else {
                    data.forEach(college => {
                        var option = document.createElement('option');
                        option.value = college;
                        option.text = college;
                        collegeSelect.appendChild(option);
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                collegeSelect.innerHTML = '<option>Error loading colleges</option>';
            });
    }

    document.getElementById('uname').addEventListener('change', loadColleges);
</script>


