<?php
    include_once 'data/db.php';

    if(array_key_exists('sender', $_POST))
    {
        if($_POST["sender"] != NULL && $_POST["receiver"] != NULL && $_POST["amount"] != NULL)
        {
            $sql = "SELECT * FROM banksystem;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0)
            {
                $sender_id = $_POST["sender"];
                $receiver_id = $_POST["receiver"];
                $amount = $_POST["amount"];
                $sender_sl = intval($sender_id);
                $receiver_sl = intval($receiver_id);

                while ($row = mysqli_fetch_assoc($result))
                {
                    if($row['cust_id'] == $sender_id)
                    {
                        $sender_name = $row['cust_name'];
                        $sender_new_balance = floatval($row['cust_balance']) - floatval($amount);
                        $sql_select = "SELECT cust_name FROM banksystem WHERE cust_id = $receiver_sl;";
                        $result_select = mysqli_query($conn, $sql_select);
                        while($row = mysqli_fetch_assoc($result_select))
                        {
                            $receiver_name = $row['cust_name'];
                            
                        }
                        $sql_insert = "INSERT INTO transfer_history (transaction_id, sender_name, receiver_name, transferred_amount, transaction_date) VALUES (NULL, '$sender_name', '$receiver_name', '$amount', current_timestamp());";
                    
                        mysqli_query($conn, $sql_insert);
                        
                        $sql_update = "UPDATE banksystem SET cust_balance = $sender_new_balance WHERE cust_id = $sender_sl;";
                        mysqli_query($conn, $sql_update);
                    }
                    else if($row['cust_id'] == $receiver_id)
                    {
                        $receiver_new_balance = floatval($row['cust_balance']) + floatval($amount);

                        $sql_update = "UPDATE banksystem SET cust_balance = $receiver_new_balance WHERE cust_id = $receiver_sl;";
                        mysqli_query($conn, $sql_update);
                    }
                }
            }
        }
    }
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
    <li><a href="view.php">View Consumer</a></li>
    <li><a href="transfer.php">Transfer History</a></li>
    </ul>

    <table id = "transfer_history">
    <tr>
        <th>Sl</th>
        <th>Sender</th> 
        <th>Reciever</th>
        <th>Recieved Amount</th> 
        <th>Transaction Date</th>
    </tr>
<?php 
 $sql = "SELECT * FROM transfer_history;";
 $result = mysqli_query($conn, $sql);
 $resultCheck = mysqli_num_rows($result);
 if($resultCheck > 0){
    while ($row = mysqli_fetch_assoc($result)){
        $transaction_id = $row['transaction_id'];
        $sender_name = $row['sender_name'];
        $receiver_name = $row['receiver_name'];
        $amount = $row['transferred_amount'];
        $transaction_date = $row['transaction_date'];

        echo '<tr> 
                <td>'.$transaction_id.'</td> 
                <td>'.$sender_name.'</td> 
                <td>'.$receiver_name.'</td> 
                <td>'.$amount.'</td>    
                <td>'.$transaction_date.'</td>                
            </tr> 
            <br>';
    }
}
?>
</table>
<div class="footer">
    <p>Copyright Reserved</p>
    </div>

</body>
</html>