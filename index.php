<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://kit.fontawesome.com/0d0d81e2ae.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="index.css">
    <link rel="icon" type="image/x-icon" href="logo.png">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <div class="title">
                <h1 id="signup" >Sign Up</h1> 
                <h1 id="signin" class="disable">Sign In</h1>
            </div>
            <form method="post">
                <div class="group">
                <div class="items" id="text">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" placeholder="Name" Name="UserName">
                </div>
                <div class="items">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" placeholder="Email" name="EmailId">
                </div>
                <div class="items">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" placeholder="Password" name="Password">
                </div>
                <p>Forgot password <a href="forgotPassword.php" >Click Here..</a></p>
                
                </div>
                <input type="submit" id="sbtn" class="sign_up btn" name="login" value="Sign Up"></input>
            </form>
        <?php
        include('db.php');
        
    
        $val= $_COOKIE['val'];
        if(isset($_POST['login']) && $val=='Sign In') {
            $EmailId=$_POST['EmailId'];
            $Password=$_POST['Password'];
            $query=mysqli_query($conn,"SELECT * FROM `logindetails` WHERE EmailId LIKE '$EmailId' AND Password LIKE '$Password'");
            $row=mysqli_num_rows($query);
            if($row==1)
            {
                echo "<script>
                window.location.href='list.php?email=$EmailId'
                </script>";
            }
            else {
                echo '<script>myFunction();</script>';
            }
        }
        if(isset($_POST['login']) && $val=='Sign Up') {
            $EmailId=$_POST['EmailId'];
            $Password=$_POST['Password'];
            $UserName=$_POST['UserName'];
            if (!filter_var($EmailId, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format";
            }
            else{
            $sql="INSERT INTO `logindetails` (`UserName`, `EmailId`, `Password`) VALUES ('$UserName', '$EmailId', '$Password');";
            echo "<script>console.log('Debug Objects: " . $UserName . "' );</script>";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } 
              else{
                echo $conn->error;
            }
            }
        }
        if (isset($_POST['send-link'])) {
        
            $EmailId = $_POST['email'];
    
            $sql="SELECT * FROM `logindetails` WHERE EmailId = '$EmailId'";
            $result = $conn->query($sql);
            
    
            if ($result) {
                $query=mysqli_query($conn,"SELECT * FROM `logindetails` WHERE EmailId LIKE '$EmailId'");
                $row=mysqli_num_rows($query);
                if ($row==1) {
                    
                    $reset_token=bin2hex(random_bytes(16));
                    date_default_timezone_set('Asia/kolkata');
                    $date = date("Y-m-d");
                    $sql = "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`) VALUES ('$EmailId', '$reset_token', '$date');";
                    $conn->query($sql);
                    $result=exec(escapeshellcmd("emailing.py $EmailId $reset_token"));
                     if ($result=='0') {
                            echo "
                                <script>
                                    alert('Password reset link send to mail.'); 
                                     window.location.href='index.php'
                                </script>"; 
                        }else{
                            echo "
                                <script>
                                    alert('Something got Wrong');
                                     window.location.href='forgotPassword.php'
                                </script>";
                        }

                    // if (sendmail($EmailId,$reset_token )===TRUE) {
                    //         echo "
                    //             <script>
                    //                 alert('Password reset link send to mail.');
                    //                  window.location.href='index.php'    
                    //             </script>"; 
                    //     }else{
                    //         echo "
                    //             <script>
                    //                 alert('Something got Wrong');
                    //                  window.location.href='forgotPassword.php'
                    //             </script>";
                    //     }
    
                }
                else{
                    echo "
                        <script>
                            alert('Email Address Not Found');
                             window.location.href='forgotPassword.php'
                        </script>";
                }   
                
            }else{
                echo "
                    <script>
                        alert('Server Down');
                         window.location.href='forgotPassword.php'
                    </script>";
            }
        }

        ?>
        <div class="popup">
        <span class="popuptext" id="myPopup">Wrong password or id</span>
        </div>
        </div>
        
    </div>
    <script>
        document.cookie = "val=Sign Up";
        let signinbtn=document.getElementById("signin");
        let signupbtn=document.getElementById("signup");
        let text=document.getElementById("text");
        let button=document.getElementById("sbtn");

        signinbtn.onclick=function(){
            document.cookie = "val=Sign In";
            text.style.maxHeight="0";
            signinbtn.classList.remove("disable");
            signupbtn.classList.add("disable");
            document.querySelector('input[name="login"]').value = 'Sign In';
        }
        signupbtn.onclick=function(){
            document.cookie = "val=Sign Up";
            text.style.maxHeight="60px";
            signinbtn.classList.add("disable");
            signupbtn.classList.remove("disable");
            document.querySelector('input[name="login"]').value = 'Sign Up';
        }
        function myFunction() {
            var popup = document.getElementById("myPopup");
            popup.classList.add("show");
            window.setTimeout(function() { popup.classList.remove("show") }, 2000);
        }
    </script>
</body>
</html>
