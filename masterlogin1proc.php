<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
body,h1,h2,h3,h4,h5,h6 {font color: "white"}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>
<body>

<?php
if(isset($_POST['login'])) {
       include('adminconn.php');
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = strip_tags($_POST['username']);
        $password=strip_tags($_POST['password']);
		$station=strtolower($password);
        if($username==''){
            header('location:./login.php?error=user name empty');
            exit();
			
        }
        if($password=='') {
            header('Location:./login.php?error=password empty');
            exit();
        }
        $query = "select * from masterlogin where username='$username' and password='$password'";
        $result = mysqli_query($con,$query);
        if (mysqli_num_rows($result) != 1) {
            //Usename is taken
           header('Location:./login.php?error=not an admin');
            exit();
          
        }

    }
}
else {
    header('location:login.php');
    exit();
}
?>
<h1>logged in successfully!!</h1><br>
<br>
<div class="w3-padding-80 w3-center">
<div class=" w3-indigo w3-container w3-center" style="height:700px">
<?php


$name="root";
$pas="";
$dbname="admin";
$con=mysqli_connect("localhost",$name,$pas);

   
   if(! $con ) {
      die('Could not connect: ' );
   }
 mysqli_select_db($con,$dbname);
   $sql = "SELECT * FROM masterdetails where mail='$username'";
   
   $retval = mysqli_query( $con, $sql );
    
   if(! $retval ) {
      die('Could not get data: ' );
   }
   
   while($row = mysqli_fetch_array($retval)) {
      echo " ID :{$row['id']}  <br> ".
	    " NAME :{$row['name']}  <br> ".
         "STATION : {$row['station']} <br> ".
         "PHONE NUMBER : {$row['phno']} <br> ".
		 "MAIL : {$row['mail']} <br> ".
         "--------------------------------<br>";
   }
   echo"TRAIN DETAILS: <br>";
   $sql1 = "SELECT trno,haltno,haltstation1,arrival1,departure1,haltstation2,arrival2,departure2,haltstation3,arrival3,departure3,haltstation4,arrival4,departure4,haltstation5,arrival5,departure5 FROM haltstationdetails where haltstation1 ='$station' or haltstation2 ='$station' or haltstation3 ='$station' or haltstation4 ='$station' or haltstation5 ='$station' ";
   
   $retval1 = mysqli_query( $con, $sql1 );
    
   if(! $retval1 ) {
      die('No trains to halt in your station.' );
   }
   
   while($row = mysqli_fetch_array($retval1)) {
      echo " TRAIN NUMBER:{$row['trno']}  <br> ".
	    " NO OF HALT STATION:{$row['haltno']}  <br> ".
	    " HAlTSTATION1 :{$row['haltstation1']}  <br> ".
         "ARRIVAL : {$row['arrival1']} <br> ".
         "DEPARTURE : {$row['departure1']} <br> ".
		  " HAlTSTATION2 :{$row['haltstation2']}  <br> ".
         "ARRIVAL : {$row['arrival2']} <br> ".
         "DEPARTURE : {$row['departure2']} <br> ".
		  " HAlTSTATION1 :{$row['haltstation3']}  <br> ".
         "ARRIVAL : {$row['arrival3']} <br> ".
         "DEPARTURE : {$row['departure3']} <br> ".
		  " HAlTSTATION1 :{$row['haltstation4']}  <br> ".
         "ARRIVAL : {$row['arrival4']} <br> ".
         "DEPARTURE : {$row['departure4']} <br> ".
		  " HAlTSTATION1 :{$row['haltstation5']}  <br> ".
         "ARRIVAL : {$row['arrival5']} <br> ".
         "DEPARTURE : {$row['departure5']} <br> ". 
         "--------------------------------<br>";
   }
   
   $sql2 = "SELECT trno,fromstation,tostation,arrival,departure,noofdays FROM trdetails where fromstation ='$station' or tostation ='$station' ";
   
   $retval2 = mysqli_query( $con, $sql2 );
    
   if(! $retval2 ) {
      die('No trains to start/finish in your station.' );
   }
   while($row = mysqli_fetch_array($retval2)) {
    $value1 = $row['trno'] ;
	 $value2 =  $row['fromstation'];
      $value3  =     $row['tostation'] ;
       $value4  =    $row['arrival'] ;
		 $value5 =  $row['departure'] ;
		  $value6 =   $row['noofdays'] ;
         
   }
   
   mysqli_close($con);


?>

<form >

<table >


        <tr>

            <td >train no</td>
  <td >Title</td>

     <td >FirstName:</td>
       
 <td >Surname:</td>
 <td >Address Line 1:</td>
 <td >Address Line 2:</td>
 
        </tr>

        <tr>

           
                 <input  type="text" value='<?php echo  $value1; ?>'/></td>
                <input  type="text" value='<?php echo  $value2; ?>'/></td>
 <input type="text" value='<?php echo  $value3; ?>' /></td>
  <input type="time" value='<?php echo  $value4; ?>' /></td>
   <input  type="time" value='<?php echo  $value5; ?>' /></td>
   <input  type="number" value='<?php echo  $value6; ?>' ></td>

        </tr>


    </table>

</form>

<a href="masterhome.php" class="w3-button w3-black w3-padding-large w3-large w3-margin-top">REPORT DELAY</a>
</div>
</div>
</body>
</html>
