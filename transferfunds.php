<?php
$timezone = date_default_timezone_set('Asia/Kolkata');
$date = date('m/d/Y h:i:s a', time());
$success = false;
$failure = false;
$Abort = false;

include 'connection.php';


if (isset($_POST['submit'])) {

    $userFrom = $_POST['userFrom'];
    $userTo = $_POST['userTo'];
    $tAmount = $_POST['tAmount'];

    $sql1 = "SELECT * FROM `customers` WHERE `srNo`=$userFrom";
    $result1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_assoc($result1);

    $sql3 = "SELECT fullName FROM `customers` WHERE `srNo`=$userFrom";
    $result3 = mysqli_query($con, $sql3);
    $row3 = mysqli_fetch_assoc($result3);

    $sql2 = "SELECT * FROM `customers` WHERE `srNo`=$userTo";
    $result2 = mysqli_query($con, $sql2);
    $row2 = mysqli_fetch_assoc($result2);

    $sql4 = "SELECT fullName FROM `customers` WHERE `srNo`=$userTo";
    $result4 = mysqli_query($con, $sql4);
    $row4 = mysqli_fetch_assoc($result4);

    if ($tAmount > $row1['currentBalance']) {
        $failure = true;
    } else if ($tAmount <= 0) {
        $Abort = true;
    } else {
        $updatedAmount1 = $row1['currentBalance'] - $tAmount;
        $updatedAmount2 = $row2['currentBalance'] + $tAmount;
        $sql = "UPDATE `customers` SET `currentBalance`=$updatedAmount1 WHERE `srNo`=$userFrom";
        $result = mysqli_query($con, $sql);

        $sql = "UPDATE `customers` SET `currentBalance`=$updatedAmount2 WHERE `srNo`=$userTo";
        $result = mysqli_query($con, $sql);

        $sender = $row1['accNo'];
        $receiver = $row2['accNo'];


        $senderName = $row3['fullName'];
        $receiverName = $row4['fullName'];





        $query = "INSERT INTO transfers( `transferFromAccount`, `transferToAccount`, `transferFromName`, `transferToName`, `transferredAmount`, `dateTime`) VALUES('$sender', '$receiver', '$senderName', '$receiverName', '$tAmount', '$date')";
        $result = mysqli_query($con, $query);
        if ($result) {
            $success = true;
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>

  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/navbar.css">
    <title>Mega Bank Transfers</title>
    <link rel="icon" href="./Images/logo.png">

    <style>
     select { width: 400px; text-align: center; }
select .lt { text-align: center; }

    .footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: #343A40;
   color: white;
   text-align: center;
}

    </style>

</head>

<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="#">
    <img src="./Images/logo.png" alt="logo" style="width:70px;">
  </a>
  

  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link"  href="index.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="  text-decoration: none; color: white;"  href="customers.php"><b>Customers</b></a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="transfers.php">Transfers</a>
    </li>
  </ul>
</nav>

 <h1 style="text-align: center; ">Transfer Money</h1>
<h4 class="text-center text-success">
                <?php if ($success) echo'<script>alert("Transaction Successful")</script>'; ?>
                <?php if ($failure) echo '<script>alert("Not enough Balance")</script>'; ?>
                <?php if ($Abort) echo'<script>alert("Amount should be greater than zero")</script>';?>
            </h4>
   <form method="POST">
    <label style="margin-left: 330px; font-size: 20px; "><b>Transfer From :</b></label>
       <select style="width: 550px; height: 30px; margin-left: 40px; margin-top: 40px; " name="userFrom" >
                            
                            <?php
                            $accNo = $_GET['accNo'];
                             
                           $query =  "select * from customers where accNo=$accNo";
                            $result = mysqli_query($con, $query);
                            $num_rows = mysqli_num_rows($result);
                            while ($rows = mysqli_fetch_assoc($result)) {
                            ?>
                            <option  value="<?php echo $rows['srNo'] ?>">
                                <?php echo $rows['fullName'] ?>  (Rs.<?php echo $rows['currentBalance'] ?>)</option>
                            <?php
                            }
                            ?>
                        </select>   <br><br>
    <label style="margin-left: 330px; font-size: 20px; "><b>Transfer To :</b></label>
                        <select style="width: 550px; height: 30px; margin-left: 70px; margin-top: 50px; "name="userTo">
                            <option></option>
                            <?php
                            $query = 'SELECT * FROM `customers`';
                            $result = mysqli_query($con, $query);
                            $num_rows = mysqli_num_rows($result);
                            while ($rows = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value="<?php echo $rows['srNo'] ?>"><?php echo $rows['fullName'] ?>  (RS.<?php echo $rows['currentBalance'] ?>)</option>
                            <?php
                            }
                            ?>
                        </select> <br><br>
        <label style="margin-left: 330px; font-size: 20px; "><b>Transfer Amount :</b></label>
                    <input style="width: 550px; height: 30px; margin-left: 15px; margin-top: 50px; " name="tAmount" >
                </div>
                <br><br>
                <button  type="submit" name="submit" style="border: none; margin-left: 670px; " class="btn btn-success"  action="transfers.php">Transfer Funds</button>

            </form>

<!--
    <div class="container-fluid bg-overlay3">
        
        <div class="container mt-5">
            <h1 class="text-center mt-5">Transfer Money</h1>
            <h4 class="text-center text-success">
                <?php if ($success) echo 'Transaction Successful'; ?>
                <?php if ($failure) echo "Not enough Balance"; ?>
                <?php if ($Abort) echo "Amount should be greater than zero"; ?>
            </h4>
            <form method="POST">
                <div class="row">
                    <div class="my-3 col-md-6">
                        <label for="amount" class="my-2">Transfer From</label>
                        <select class="form-select" aria-label="Default select example" name="userFrom">
                            <option></option>
                            <?php




                            $query = 'SELECT * FROM `customers`';
                            $result = mysqli_query($con, $query);
                            $num_rows = mysqli_num_rows($result);
                            while ($rows = mysqli_fetch_assoc($result)) {
                            ?>
                            <option class="lt" value="<?php echo $rows['srNo'] ?>">
                                <?php echo $rows['fullName'] ?>  (Rs.<?php echo $rows['currentBalance'] ?>)</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="my-3 col-md-6">
                        <label for="amount" class="my-2">Transfer To</label>
                        <select class="form-select" aria-label="Default select example" name="userTo">
                            <option></option>
                            <?php
                            $query = 'SELECT * FROM `customers`';
                            $result = mysqli_query($con, $query);
                            $num_rows = mysqli_num_rows($result);
                            while ($rows = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value="<?php echo $rows['srNo'] ?>"><?php echo $rows['fullName'] ?> (Id -
                                <?php echo $rows['accNo'] ?>) (<?php echo $rows['currentBalance'] ?>)</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="">
                    <label for="amount" class="my-2">Transfer Amount</label>
                    <input type="number" class="form-control" name="tAmount" placeholder="Enter Amount ">
                </div>
                <button type="submit" name="submit" class="btn btn-secondary col-sm-12 mt-4" action="transfers.php">Transfer Funds</button>

            </form>
        </div>
    </div>

    -->
<div class="footer">
  <br>
  <p><b>Siddhi Chaudhari 2021 © | The Sparks Foundation</b></p>
</div>

</body>

</html>