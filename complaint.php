<?php
    // Create a connection to MySQL database
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "OnlineComplain";
    $conn = mysqli_connect($server, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $category = $_POST["category"];
        $roomNumber = $_POST["roomNumber"];
        $complaint = $_POST["complaint"];
        $name = $_POST["username"];
        $exists = false;
        // Insert form data into the database
        if($exists == false){
            $sql = "INSERT INTO `complaints` (`complain`, `room`, `username`, `date`, `status`, `category`) VALUES ('$complaint', '$roomNumber', '$name', current_timestamp(),'Registered', '$category')";
            $result = mysqli_query($conn, $sql);
            if($result) {
                echo "<script>alert('Submitted Successfully');</script>";
                header("location: UserInterface.php");
            }    
            else {
                // Error in registration
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
    
    // Close the database connection
    mysqli_close($conn);
?>