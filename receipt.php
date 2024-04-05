
<?php 
error_reporting(0);
include '../Includes/dbcon.php';


//------------------------SAVE--------------------------------------------------

if(isset($_POST['save'])){
    
  $Name=$_POST['Name'];
  $idNo=$_POST['idNo'];
  $phoneNo=$_POST['phoneNo'];
  $nights=$_POST['nights'];
  $amountPerNight=$_POST['amountPerNight'];
  $totalPaid=$_POST['totalPaid'];
  $dateCreated = date("Y-m-d h:i:sa");
   
    $query=mysqli_query($conn,"select * from payment where idNo ='$idNo'");
    $ret=mysqli_fetch_array($query);

   
    if($ret > 0){ 

        $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>This Email Address Already Exists!</div>";
    }
    else{

    $query=mysqli_query($conn,"INSERT into payment(Name,idNo,phoneNo,nights,amountPerNight,totalPaid,dateCreated) 
    value('$Name','$idNo','$phoneNo','$nights','$amountPerNight','$totalPaid','$dateCreated')");

    
            if ($qu) {
                
                $statusMsg = "<div class='alert alert-success'  style='margin-right:700px;'>Created Successfully!</div>";
            }
            else
            {
                $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
            }
    }
    
  }


//---------------------------------------EDIT-------------------------------------------------------------






//--------------------EDIT------------------------------------------------------------

 if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == "edit")
  {
        $id= $_GET['id'];

        $query=mysqli_query($conn,"select * from payment where id ='$id'");
        $row=mysqli_fetch_array($query);

        //------------UPDATE-----------------------------

        if(isset($_POST['update'])){
    
                
           $Name=$_POST['Name'];
           $idNo=$_POST['idNo'];
           $phoneNo=$_POST['phoneNo'];
           $nights=$_POST['nights'];
           $amountPerNight=$_POST['amountPerNight'];
           $totalPaid=$_POST['totalPaid'];
             $dateCreated = date("Y-m-d h:i:sa");
    $query=mysqli_query($conn,"update payment set Name='$Name', idNo='$idNo',
    phoneNo='$phoneNo', nights='$nights',amountPerNight='$amountPerNight', totalPaid='$totalPaid',dateCreated='$dateCreated'
    where id='$id'");
            if ($query) {
                
                echo "<script type = \"text/javascript\">
                window.location = (\"receipt.php\")
                </script>"; 
            }
            else
            {
                $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
            }
        }
    }


//--------------------------------DELETE------------------------------------------------------------------
  if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == "delete")
  {
        $id= $_GET['id'];

        $query = mysqli_query($conn,"DELETE FROM payment WHERE id='$id'");

        if ($query == TRUE) {

                echo "<script type = \"text/javascript\">
                window.location = (\"receipt.php\")
                </script>";  
        }
        else{

            $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>"; 
         }
      }


?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Receipt Generator</title>
<style>
  body {
    font-family: Arial, sans-serif;
  }
  
  .container {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
  }

  .receipt {
    border: 1px solid #ccc;
    padding: 20px;
    margin-bottom: 20px;
  }

  .receipt h2 {
    margin-top: 0;
  }

  .receipt p {
    margin: 10px 0;
  }
  .receipt p button{
   display: block; 
   width: 30%;
   border-radius: 1px solid white;
   color: wh;
  }

  .receipt button {
    display: block;
    width: 40%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  .pymt{
    font-size: 20px;
  }
  table{
    border-collapse: collapse;
    width: 90%;
    margin-left: 20px;

  }
  th, td{
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }
</style>
</head>
<body>
<form method="post">
<div class="container">
  <div class="receipt">
    <h2>Receipt</h2>
    <p>Name: <input type="text"id="name"name="Name"value="<?php echo $row['Name'];?>" ></p>
    <p>Id no: <input type="text"id="id" name="idNo"value="<?php echo $row['idNo'];?>"></p>
    <p>Phone no: <input type="text"id="phone" name="phoneNo" value="<?php echo $row['phoneNo'];?>"></p>
    <p>No. of Nights: <input type="text" id="nights" name="nights" value="<?php echo $row['nights'];?>"></p>
    <p>Amount per Night: <input type="text"id="amount" name="amountPerNight"value="<?php echo $row['amountPerNight'];?>"></p>
    <p>Total paid : <output type="output"id="demo" name="totalPaid"value="<?php echo $row['totalPaid'];?>"></output></p>
    <p><button type="button" onclick="myFunction()" >Total </button> </p>
    <button type="submit" name="save">save</button>
</div>
 <button onclick="printReceipt()">Print Receipt</button>
</div>
</form>
 <button onclick="printReceipt()">Print Receipt</button>
 

<script>
    function myFunction() {
    let x =
    document.getElementById("nights").value;
    let y =
    document.getElementById("amount").value;
    let text;
    if (x < 1){
      text = "invalid input";
    } else {
      text = x * y;
    }
    document.getElementById("demo").innerHTML = text;
  }

  function printReceipt() {
    var name = document.getElementById('name').value;
    var nights = parseInt(document.getElementById('nights').value);
    var amount = parseFloat(document.getElementById('amount').value);
    var total = nights * amount;

    document.getElementById('name').textContent = name;
    document.getElementById('id').textContent = id;
    document.getElementById('phone').textContent = phone;
    document.getElementById('nights').textContent = nights;
    document.getElementById('amount').textContent = amount
    document.getElementById('demo').textContent = total;



    window.print();
  }

</script>
   <hr> 
   <div class="container">
              
                  <h6 class="pymt">All payment</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table payment" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Id no</th>
                        <th>Phone No</th>
                        <th>No of Nights</th>
                        <th>Amount Per Night</th>
                        <th>Total Paid</th>
                        <th>Date Created</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>print</th>
                      </tr>
                    </thead>
                  
                    <tbody>

                 
                  <?php
                      $query = "SELECT * FROM payment";
                      $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      if($num > 0)
                      { 
                        while ($rows = $rs->fetch_assoc())
                          {
                             $sn = $sn + 1;
                            echo"
                              <tr>
                                <td>".$sn."</td>
                                <td>".$rows['Name']."</td>
                                <td>".$rows['idNo']."</td>
                                <td>".$rows['phoneNo']."</td>
                                <td>".$rows['nights']."</td>
                                <td>".$rows['amountPerNight']."</td>
                                <td>".$rows['totalPaid']."</td>
                                <td>".$rows['dateCreated']."</td>
                                <td><a href='?action=edit&id=".$rows['id']."'><i class='fas fa-fw fa-edit'></i>Edit</a></td>
                                <td><a href='?action=delete&id=".$rows['id']."'><i class='fas fa-fw fa-trash'></i>Delete</a></td>
                                
                              </tr>";
                          }
                      }
                      else
                      {
                           echo   
                           "<div class='alert alert-danger' role='alert'>
                            No Record Found!
                            </div>";
                      }
                      
                      ?>
 
                    </tbody>
                  </table>
                </div>
              </div>
            
 

</body>
</html>