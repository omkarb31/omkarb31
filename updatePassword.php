<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upadte Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="icon" type="image/x-icon" href="logo.png">
</head>
<body>
    <?php 
        
        require ('db.php');
        if (isset($_GET['email']) && isset($_GET['reset_token'])) {

            date_default_timezone_set('Asia/kolkata');
            $date = date("Y-m-d");
            
            $email = $_GET['email'];    
            $reset_token = $_GET['reset_token'];
            echo $email;
            echo $reset_token;
            $query=mysqli_query($conn,"SELECT * FROM `password_reset_temp` WHERE `email` LIKE '$email' AND `key` LIKE '$reset_token'");
            if($query){
            $row=mysqli_num_rows($query);
            mysqli_query($conn,"DELETE FROM `password_reset_temp` WHERE `email` LIKE '$email' AND `key` LIKE '$reset_token'");
            if ($row == 1) {
                        echo"ajun aat";
                        echo " <script>
                        window.location.href='update.php?email=$email'
                    </script>";
                }else{
                        echo "
                            <script>
                                alert('invelid or Expired link');
                                window.location.href='index.php'
                            </script>";
                    }
            }   
            else {
                echo"<script> alert('server down');
                </script>";
            }
        }
        ?>
    
</body>
</html>