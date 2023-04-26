<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="icon" type="image/x-icon" href="logo.png">
</head>
<body>
    <div class="container d-flex justify-content-center mt-5 pt-5">
        <div class="card mt-5" style="width:500px">
            <div class="card-header">
                <h1 class="text-center">Creat New Password</h1>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="mt-2">
                        <label for="Password">Password : </label>
                        <input type="password" name="Password" class="form-control" placeholder="Creat New Password">
                    </div>
                    <div class="mt-4 text-end">
                        <input type="submit" name="update" value="update" class="btn btn-primary">
                        <a href="index.php" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
include('db.php');
if (isset($_POST['update'])) {
    $pass = $_POST['Password'];
    echo $pass;
    $email = $_GET['email'];  
    echo $email;

    $update = "UPDATE `logindetails` SET `Password`='$pass' WHERE `EmailId` = '$email'";

    if ($conn->query($update)===TRUE) {
        echo "
            <script>
                alert('New Password Created Successfully');
                window.location.href='index.php'                
                </script>"; 
    }else{
        echo "Error: ".$sql."<br>".$conn->error;
        echo "
            <script>
            alert('Password not updated');
            window.location.href='index.php'                     
            </script>";
    }
}
?>
</body>
</html>
