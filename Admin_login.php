<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //MySQL database credentials
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "OnlineComplain";
        // Create a connection to MySQL database
        $conn = mysqli_connect($server, $username, $password, $database);
        // Check if the connection was successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $email = $_POST["email"];
        $password = $_POST["password"];
        $sql = "Select * from admin where email = '$email' AND password = '$password' ";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        
        if($num == 1){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['email']= $email;
            header("location: AdminInterface.php");
        }
        
        else{
            echo "Invalid Credentials";
        } 
    }
?>
