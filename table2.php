<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table 2</title>
</head>
<body>
    <table border = "5">
        <tr>
            <th>S.no</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Department</th>
            <th>update</th>

        </tr>

        <?php

        include('conn.php');
        $table=mysqli_query($conn,"Select * from student");
        $num = 1 ;
        while($fetch =mysqli_fetch_assoc($table))
        {
            $id = $fetch['id'];
        ?>
        

        <tr>
            <td><?php echo $num++ ?></td>
            <td><?php echo $fetch['name'] ?></td>
            <td><?php echo $fetch['phone'] ?></td>
            <td><?php echo $fetch['email'] ?></td>
            <td><?php echo $fetch['dpet'] ?></td>
            <td><a href = "update1.php?id=<?php echo $id ?>"> update </a></td>
        </tr>
            
        <?php 
        }
        ?>
    
</body>
</html>