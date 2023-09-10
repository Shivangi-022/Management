<?php
    $conn = mysqli_connect('localhost', 'root', "", 'OnlineComplain');
    if(isset($_POST['submit']))
    {
        $statupdate=$_POST['editstat'];
        $c_Id=$_POST['c_Id'];
        $query="UPDATE complaints SET status='$statupdate' where c_Id='$c_Id'";
        $result = mysqli_query($conn, $query);
        echo "<script> window.location='AdminInterface.php';</script>";
    }
?>