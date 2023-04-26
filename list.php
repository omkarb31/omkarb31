<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="list.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="icon" type="image/x-icon" href="logo.png">
</head>
<body>
<div class="m-4">
    <nav class="navbar navbar-light nav nav-pills flex-column flex-sm-row" style="background-color: #ddeeff;">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">
                <img src="logo.png" height="34" alt="RemoteLab">
            </a>
            <h3 class="nav-item brand">Remote Lab</h3>
            <a href="main.html" class="nav-item nav-link">Home</a>
            <a href="list.php" class="nav-item nav-link active">List Of Projects</a>
            <a href="#" class="nav-item nav-link">Contact Us</a>
            <a href="#" class="nav-item nav-link" >About us</a>
            <?php
            $email=$_GET['email'];
            echo"<div class='navbar-nav ms-auto'>
                <a id='ac' href='index.php' class='nav-item nav-link btn btn-outline-secondary'ata-toggle=' tooltip' data-placement='top' title='$email'>
                Login or Sign Up
                </a>
            </div> "
            ?>
        </div>
    </nav>
    <?php
      $email=$_GET['email'];
    ?>
    <script>
        document.getElementById('ac').innerHTML = "<a href='index.php' class='nav-item nav-link' >Logout</a>";
    </script>
    </div>
    <div class="list">
        <h1>List of Projects</h1>
        <table class="tab">
		<tr>
			<th>Project Name</th>
            <th>Description</th>
		</tr>
		<?php
		include('db.php');
		$email=$_GET['email'];
        $sql="SELECT * FROM `project_name` WHERE 1";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data=$row['Name'];
            $link=$row['file'];
            $desp=$row['description'];
            echo "<tr>";
			echo "<td class='st'><a class='name' href='$link?email=$email'>$data</a></td>";
            echo" <td class='nd'>$desp</td>";
			echo "</tr>";
        }
		?>
	    </table>
    </div>
</body>
</html>