<?php
include_once 'data/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking System</title>
</head>
<body >
    <h1 id="logo">TSF BANK</h1>
    
    <ul>
    <li><a href="#">Home</a></li>
    <li><a href="#">View Consumer</a></li>
    <li><a href="#">Transfer History</a></li>
    </ul>
   <table>
    <tr>
     <th>Sl</th>
     <th>Name</th>
     <th>Email</th>
     <th>Balance</th>
     <th>Profile</th>
     </tr>
     

<?php
$sql = "SELECT * FROM banksystem;";
$result = mysqli_query($conn,$sql);
$resultCheck = mysqli_num_rows($result);
if($resultCheck >0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            $sl= $row['cust_id'];
            $name =$row['cust_name'];
            $email = $row['cust_email'];
            $balance =$row['cust_balance'];
          
            echo '<tr>
            <td>'.$sl. '</td>
            <td>'.$name.'</td>
            <td>'.$email.'</td>
            <td> ₹' .$balance.'</td>
            <td> <form method = "post" action = "profile.php"><button class = "btn_view button" name="view" value='.$sl.'> VIEW </button></form></td>
           
            

            </tr> 
            <br>';

        }
    }
    ?>
   
   

</body>

</html>