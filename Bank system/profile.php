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
    <?php
    $sql = "SELECT * FROM banksystem;";
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck >0)
    {
        while ($row = mysqli_fetch_assoc($result))

        {
            if($row['cust_id'] == $_POST["view"])
            {
                $sl= $row['cust_id'];
                $name =$row['cust_name'];
                $email = $row['cust_email'];
                $balance =$row['cust_balance'];
                echo '<table id="det">
                <tr>
                    <td>Sl</b></td>
                    <td>'.$sl.'</td>
                </tr>
                <tr>
                    <td><b>Name</b></td>
                    <td>'.$name.'</td>
                </tr>
                <tr>
                    <td><b>Email</b></td>
                    <td>'.$email.'</td>
                </tr>
                <tr>
                    <td><b>Balance</b></td>
                    <td>'.$balance.'</td>
                </tr>
              </table>
              <form method = "post" action = "transfer.php">
                <button class="btn_transfer button_transfer2 button" name="transfer" value='.$sl.'>Transfer Money</button>
              </form>
              ';
    }
}
}
?>
<div class="footer">
    <p>Copyright Reserved</p>
    </div>
</body>
</html>