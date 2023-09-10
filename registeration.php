<?php
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $enroll_no = $_POST["enroll_no"];
    $room = $_POST["room"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $exists = false;

    // Insert form data into the database
    if(($password == $cpassword) && $exists == false){
        $sql = "INSERT INTO `users` (`username`, `enroll_no`, `room`, `email`, `password`, `DateTime`) VALUES ('$username', '$enroll_no', '$room', '$email', '$password', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if($result) {
            echo "Registered Successfully";
            header("location: login.html");
        }    
        else {
            // Error in registration
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    else{
         "Password Missmatch!";
    }
}

// Close the database connection
mysqli_close($conn);
?>