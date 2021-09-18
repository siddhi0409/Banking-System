<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mega Bank</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="icon" href="./Images/logo.png">
<style type="text/css">
	.table-hover tbody tr:hover td  
    {  
        
        cursor: pointer;
    } 
    td, tr {
        text-align: center;

    }
  
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
      <a class="nav-link"  style="  text-decoration: none; color: white;" href="customers.php" ><b>Customers</b></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="transfers.php">Transfers</a>
    </li>
  </ul>
</nav>
<div class="table-responsive">
            <table class="table table-hover" >
                <thead  class="thead-dark">
                    <tr>
                        <th scope="col">Sr. No.</th>
                        <th scope="col">Account Number</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Current Balance</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>

                <?php

                include 'connection.php';

                $selectquery = " select * from customers";

                $query = mysqli_query($con, $selectquery);

                $nums = mysqli_num_rows($query);

                while($res = mysqli_fetch_array($query)){
    
                ?>
                <tr>
                 <td><?php echo $res['srNo']; ?></td>
                 <td><?php echo $res['accNo']; ?></td>
                 <td><?php echo $res['fullName']; ?></td>
                 <td><?php echo $res['phone']; ?></td>
                 <td><?php echo $res['address']; ?></td>
                 <td><?php echo $res['currentBalance']; ?> INR</td>
                <td><a href="transferfunds.php?accNo=<?php echo $res['accNo']; ?>"><button type="button" class="btn btn-success" >Transfer</button></a></td>
                </tr>


               <?php
                }

                ?>
               
                  
                </tbody>
            </table>
        </div>
        
</body>
</html>