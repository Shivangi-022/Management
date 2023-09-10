<?php
    session_start();

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: login.html");
        exit;
    }
    $conn = mysqli_connect('localhost', 'root', "", 'OnlineComplain');
    $email = $_SESSION['email'];
    $query = "Select * from users where email = '$email'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
    $name = $row['username']; 
    $room = $row['room'];
    $c_query = "Select * from complaints where username = '$name' And room = '$room' ";
    $c_result = mysqli_query($conn,$c_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Registration - Student</title>
    <style>
        body {
            background-color: #d3d3bc;
            background-size: cover;
        }

        .header {
            top: 10%;
            left: 40%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #161612;
            color: white;
            padding: 10px;
            margin-bottom: 20px;
            opacity:80%;
        }

        .header h1 {
            font-size: 24px;
            color: white;
        }

        .user-details p {
            font-size: 16px;
        }

        .logout a{
            color: white;
        }
        .user-details h1:hover,
        .logout a:hover{
            text-decoration: underline;
            font-size: 25px;
        }

        .container {
            max-width: 100%;
            padding: 30px;
            background-color: rgba(194, 222, 235, 0.74);
            color: black;
            opacity: 99%;
            border: 1px solid rgb(240, 198, 81);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-left: 30;
            margin-right: 30;
            margin: 20;
            
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        select,
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            display: block;
            width: 20%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #complaintList {
            margin-top: 20px;
        }

        .complaint-item {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f2f2f2;
            border-radius: 5px;
        }

        .submit input:hover{
            font-size: 20px;
        }

        .history select{
            width: 15%;
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
        <div class="user-details">
            <h1>Welcome, <?php echo $name;?></h1>
            <p><?php echo $email ?></p>
        </div>
        <div class="logout">
            <a href="login.html">Logout</a>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <h2>Register your complaint here</h2>
            <form id="complaintForm" action="complaint.php" method="POST">
                    <input type="hidden" name="roomNumber" value="<?php echo $room;?>">
                    <input type="hidden" name="username" value="<?php echo $name;?>">
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select name="category" id="category">
                        <option>Select</option>
                        <option value="Mess_food">Mess_food</option>
                        <option value="Cleaning">Cleaning</option>
                        <option value="plumbing">Plumbing</option>
                        <option value="electrical">Electrical</option>
                        <option value="Carpentary">Carpentary</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="complaint">Complaint:</label>
                    <textarea id="complaint" name="complaint" required></textarea>
                </div>
                <div class="submit">
                <input type="submit" Submit Complaint >
                </div>
            </form>
        </div>
        <div class= "container"> 
            <div class= "history">
                <h2> History</h2>
                    <table class="table">
                        <tr>
                            <th class="">c_no.</th>
                            <th class="colheader1"> Complaint</th>
                            <th class="colheader">Category</th>
                            <th class="colheader">Date</th>
                            <th class="colheader"> Status</th>
                        </tr>

                        <?php
                            while($c_row = mysqli_fetch_assoc($c_result))
                            {
                                $c_Id = $c_row['c_Id'];
                                $complain = $c_row['complain'];
                                $category = $c_row['category'];
                                $date = $c_row['date'];
                                $status = $c_row['status'];
                        ?>
                            <tr>
                                <td> <?php echo $c_Id ?> </td>
                                <td> <?php echo $complain ?> </td>
                                <td> <?php echo $category ?> </td>
                                <td> <?php echo $date ?> </td>
                                <td> <?php echo $status ?> </td>
                            </tr>
                        <?php
                            }
                        ?>

                    </table>
            </div>
        </div>
    </div>
</body>
</html>
