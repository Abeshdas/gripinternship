<?php
include_once 'data/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="form.css">
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
    
    <form id = "transfer" method = "POST">
    <div id = "select_sender">
        <label for="sender">Sender: </label>
        <select name="sender" id="sender" onchange="disabledSelectedOption()">
            <option value=0 selected disabled>Select</option>
            <?php
            $sql = "SELECT * FROM banksystem;";
            $result = mysqli_query($conn,$sql);
            $resultCheck = mysqli_num_rows($result);
            
            if($resultCheck >0)
            {
                while ($row = mysqli_fetch_assoc($result))
        
                {
                    $sl = $row['cust_id'];
                    $name =$row['cust_name'];
                    $current_balance=$row['cust_balance'];
                    if($_POST["transfer"] != NULL)
                    {
                        if($row['cust_id'] == $_POST["transfer"])
                        {

                            echo '<option value='.$sl.' selected>'.$name.'</option>';
                        }

                        else
                        {
                            echo '<option value='.$sl.'>'.$name.'</option>';
                        }
                    }
                }
            }
        ?>
    </select>
</div>
<div id = "select_receiver">
        <label for="receiver">Receive: </label>
        <select name="receiver" id="receiver">
            <option selected disabled>Select</option>
            <?php
                $sql = "SELECT * FROM banksystem;";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                
                if($resultCheck > 0)
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $sl = $row['cust_id'];
                        $name = $row['cust_name'];

                        echo '<option value='.$sl.'>'.$name.'</option>';
                    }
                }
            ?>
        </select>
    </div>

    <div id = "input_amount">
        <label for="amount">Amount: </label>
        <input type="number" id="amount" name="amount" min="0" oninput="validity.valid||(value='');">
    </div>

    <div id = "transfer_now_button">
        <button class = "transfer button" name = "transfer" type="submit" onclick="checkDetails()" value=NULL>Transfer Now</button>
    </div>
</form>

<script>
disabledSelectedOption(); //calls the function immediately

function disabledSelectedOption() 
{
  var sender = document.getElementById("sender").value;
  var receiver = document.getElementById("receiver").getElementsByTagName("option");
  
  document.getElementById("receiver").disabled = false;
  if(sender == 0)
  {
      document.getElementById("receiver").disabled = true;
  }

  for (var i = 1; i < receiver.length; i++) 
  {
    receiver[i].disabled = false;

    if (receiver[i].value == sender) 
    {
        receiver[i].disabled = true;
    }
  }
}

function checkDetails() {
  var sender = document.getElementById("sender").value;
  var receiver = document.getElementById("receiver").value;
  var balance = parseFloat("<?php echo $current_balance;?>");
  var amount = parseFloat(document.getElementById("amount").value);

  if(sender > 0 && receiver > 0 && balance >= amount){
    confirm("Transaction Successful!");
    document.getElementById("transfer").action = "history.php";
  }
  else if (sender > 0 && receiver > 0){
    alert("Transaction Failed. Insufficient Balance.")
    document.getElementById("transfer").action = "transfer.php";  
  }
  else{
    alert("Transaction Failed. Incomplete Details.")
    document.getElementById("transfer").action = "transfer.php";   
  }
}
</script>
<div class="footer">
    <p>Copyright Reserved</p>
    </div>

</body>
</html>
