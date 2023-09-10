<?php
    session_start();

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: index.html");
        exit;
    }
    $conn = mysqli_connect('localhost', 'root', "", 'OnlineComplain');
    $email = $_SESSION['email'];
    $query = "Select * from admin where email = '$email'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
    $name = $row['Name']; 
    $u_query = "Select * from users ";
    $u_result = mysqli_query($conn,$u_query);
    $rowCount=0;
    while($u_row= mysqli_fetch_assoc($u_result))
    {$rowCount= 1+ $rowCount;}
    $u_query = "Select * from users ";
    $u_result = mysqli_query($conn,$u_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        AdminPage
    </title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: url(hostel..jpg) no-repeat center center fixed;
            background-size: cover;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #7cb9f3;
            color: white;
            padding: 10px;
            margin-bottom: 5px;
        }

        .header h1 {
            font-size: 24px;
        }

        .logout a{
            color: white;
        }

        .logout a:hover{
            text-decoration: underline;
            font-size: 25px;
            color: blue;
        }

        .content {
            padding: 20px;
            align-items: center;
            position: sticky;
        }

        .content::before{
            content: "";
            background-color: black;
            position: absolute;
            top: 0px;
            left: 0px;
            height: 59px;
            width: 100%;
            z-index: -1;
            opacity: 0.7;
        }

        .categories {
            color: white;
            font-size: 2rem;
        }

        .category {
            list-style: none;
            font-size: 1.3rem;
            font-weight: lighter;
    
        }

        .category a {
            text-decoration: none;
            color: white;
            display: block;
            padding: 3px 22px;
            border-radius: 20px;
            align-items: center;
        }

        .category a:hover {
            color: black;
            background-color: skyblue;
        }

        table{
            border: 3px solid black;
            border-style: groove;
            width: 98%;
            background-color: white;
        }
        td{
            border: 1px solid black;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .colheader{
            padding-left: 3rem;
            padding-right: 3rem;
            padding-top: 1rem;
            padding-bottom: 1rem;
            column-width: 4rem;
        }
        .colheader1{
            padding-left: 3rem;
            padding-right: 3rem;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

    </style>
</head>
<body>
    <div class="header">
        <div class="admin-details">
            <h1>Welcome, Admin</h1>
            <p><?php echo $name; echo "($email)" ?></p>
        </div>
        <div class="logout">
            <a href="index.html" style="hover">Logout</a>
        </div>
    </div>
    <div class="content">
        <ul class="categories" class="categories" style="display: flex;">
            <li class="category">
                <a href="AdminInterface.php" style="font-size: 1.7rem; color: white;">Complaints</a>
            </li>
            <li class="category">
                <a href="All_users.php" style="font-size: 1.7rem; color: white;">Users</a>
            </li>
        </ul>
    </div>
    <p style="color: white;">Total Users: 
        <?php 
            echo $rowCount;
        ?>
    </p>
    <div class="complaints">
        <table class="table" style="background-color: White;">
            <tr style="font-size: 20px;">
                <th class="colheader1">Username</th>
                <th class="colheader">Room</th>
                <th class="colheader">Enrolment no.</th>
                <th class="colheader">Email</th>
                <th class="colheader">Date Time</th>
            </tr>

            <?php
                while($u_row = mysqli_fetch_assoc($u_result))
                {
                    $u_name = $u_row['username'];
                    $u_room = $u_row['room'];
                    $enroll = $u_row['enroll_no'];
                    $email = $u_row['email'];
                    $date = $u_row['DateTime'];
        
            ?>
                    <tr>
                        <td> <?php echo $u_name ?> </td>
                        <td> <?php echo $u_room ?> </td>
                        <td> <?php echo $enroll ?> </td>
                        <td> <?php echo $email ?> </td>
                        <td> <?php echo $date ?> </td>
                    </tr>
            <?php
                }
            ?>

        </table>
    </div>
</body>
</html>