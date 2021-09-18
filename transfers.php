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
</head>
<style type="text/css">
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
      <a class="nav-link"   href="customers.php">Customers</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="  text-decoration: none; color: white;" href="transfers.php"><b>Transfers</b></a>
    </li>
  </ul>
</nav>

<div class="table-responsive">
            <table class="table table-hover">
                <thead  class="thead-dark">
                    <tr>
                        <th scope="col">Sr. No.</th>
                        <th scope="col" colspan="2">Transferred From</th>
                        <th scope="col" colspan="2">Transferred To</th>
                        <th scope="col">Transferred Amount</th>
                        <th scope="col">Date</th>
                      

                    </tr>
                </thead>
                <tbody>

                <?php

                include 'connection.php';

                $selectquery = " select * from transfers";

                $query = mysqli_query($con, $selectquery);

                $nums = mysqli_num_rows($query);

                while($res = mysqli_fetch_array($query)){
    
                ?>
                <tr>
                 <td><?php echo $res['srNo']; ?></td>
                 <td><?php echo $res['transferFromAccount']; ?></td>
                 <td><?php echo $res['transferFromName']; ?></td>
                 <td><?php echo $res['transferToAccount']; ?></td>
                 <td><?php echo $res['transferToName']; ?></td>
                 <td>Rs. <?php echo $res['transferredAmount']; ?></td>
                 <td><?php echo $res['dateTime']; ?></td>
                 
               
                </tr>


               <?php
                }

                ?>
                 
                  
                </tbody>
            </table>
        </div>
        <div class="footer">
  <br>
  <p><b>Siddhi Chaudhari 2021 © | The Sparks Foundation</b></p>
</div>
</body>
</html>