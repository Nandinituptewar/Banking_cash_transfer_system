
<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "nandu@123", "banking_system");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

// Attempt insert query execution
$sql = "SELECT *FROM transfer ";
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
<!--navbar-->
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
<table class="table">
  <thead class="thead-light">
  	<tr>
      <th scope="col">ID</th>
      <th scope="col">From</th>
      <th scope="col">To</th>
      <th scope="col">Date</th>
      <th scope="col">Amount</th>
    </tr>
   </thead>
  	<?php while($row = mysqli_fetch_assoc($result)) 
	{ 
		$id=$row['id_transfer'];
		$from=$row['from_person'];
		$to=$row['to_person'];
    $time=$row['time_of_transfer'];
    $money=$row['money_transferred'];

     ?>
  
  <tbody>
    <tr>
      <th scope="row"><?php echo $id; ?></th>
      <td><?php echo $from; ?></td>
      <td><?php echo $to; ?></td>
      <td><?php echo $time; ?></td>
      <td><?php echo $money; ?></td>
    </tr>
  </tbody>
  <?php }} ?>
</table>
</body>