
<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "nandu@123", "banking_system");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

// Attempt insert query execution
$sql = "SELECT *FROM customer ";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) > 0) 
{
  
?>

<!DOCTYPE html>
<head>

<!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,
      initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="style.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href=
"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity=
"sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">

  <title>online moneytransfer Website</title>

</head>

<body>
<!--navbar-->li class="nav-item">
           
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-info">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto ">
          <li class="nav-item active">
            <a class="nav-link text-white" href="index.html"><b>HOME</b> <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="customer.php"><b>CUSTOMER</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="transfer_record.php"><b>TRANSFER RECORD</b></a>
          </li>
        </ul>
        <span class="navbar-text text-white">
          <b><i>Cash Transfer System</i></b>
        </span>
      </div>
  </nav>
  <!--navbar close-->
<br><br>

<h1 class="text-center">Transfer Money</h1>

<?php

while($row = mysqli_fetch_assoc($result)) 
  {  
    $id=$row['id'];
    if($id==$_GET['id']){

?>
<div class="col d-flex justify-content-center">
    <div class="card text-white bg-secondary mb-3" style="width: 18rem;">
        <div class="card-body">
            <p class="card-title">Credit transfer from: <?php echo  $row["name"];?> </p>
            <p class="card-title">current balance:  <?php echo  $row["current_balance"];?> </p>
        </div>
    </div>
</div>
<?php }}}?>
 
<?php 
$sql1 = "SELECT *FROM customer ";
$result1 = mysqli_query($link, $sql);
if(mysqli_num_rows($result1) > 0) 
{
    
?> 
<div class="col d-flex justify-content-center">
    <div class="card text-white bg-secondary mb-3" style="width: 18rem;">
        <div class="card-body">
            <p calss="card-title">Transfer to:</p>
            <form method="POST" action="">
                <select name="customer_name">    
                  <option>--SELECT--</option> 

                  <?php
                  $z=""; 
                  $y=0; 
                  $change_id=0;
                  while($row1 = mysqli_fetch_assoc($result1)) 
                  {   
                      if($row1['id']==$_GET['id'])
                        {    
                          $z.=$row1["name"]; 
                          $y=$row1["current_balance"]; 
                          $change_id=$row1['id'];
                        }
                  ?>
                  <option value="<?php echo $row1['name'] ?>"><?php echo  $row1['name']?></option>
                  <?php } ?><br><br><input type="number" name="num" value="num" placeholder="Enter the value" required><br><br><input type="submit" name="submit">

                  <?php
                    
                    if(isset($_POST['submit']))
                    {
                      $transfer_salary=$_POST['num'];
                      $to=$_POST["customer_name"];
                      $updated_salary=$y-$transfer_salary; 
                      $salary_to_increase=0;
                      $sql3 = "SELECT *FROM customer ";
                      $result3 = mysqli_query($link, $sql3);
                      while($row5 = mysqli_fetch_assoc($result3)) 
                      {
                        if($row5['name']==$to){
                          $salary_to_increase=$row5['current_balance'];
                        }
                      }  
                      if($updated_salary>200)
                      {
                            $sql3 = " INSERT INTO transfer (from_person,to_person,money_transferred)
                                    VALUES ('$z','$to','$transfer_salary') ";
                                    if(mysqli_query($link, $sql3))
                                    {   
                                        $total=$salary_to_increase+$transfer_salary;
                                        //echo "Records added successfully.";
                                        $sql4="UPDATE customer SET current_balance=$updated_salary WHERE id=$change_id";
                                        $sql5 = "UPDATE customer SET current_balance=$total WHERE name='$to'";
                                        if(mysqli_query($link, $sql4))
                                        {
                                            echo "<br>Money transferred successfully.";
                                        } 
                                        else
                                        {
                                            echo "ERROR: Could not able to execute $sql4. " . mysqli_error($link);
                                        } 
                                        if(mysqli_query($link, $sql5))
                                        {
                                            //echo "<br>Money transferred successfully.";
                                        } 
                                        else
                                        {
                                            echo "ERROR: Could not able to execute $sql5. " . mysqli_error($link);
                                        } 
                                        
                                    } else
                                    {
                                        echo "ERROR: Could not able to execute $sql3. " . mysqli_error($link);
                                    }
                      }


                   }
                 }
                   ?> 
                   
                </select>
            </form>

        </div>
    </div>
</div>

</body>
