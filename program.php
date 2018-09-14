<html>
<head>

<!--Style tag to make the elements look good-->

  <style>
  input[type=text] {
  width: 100%;
  padding:12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  }
  input[type=submit] {
  width: 100%;
  background-color:red;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  }

input[type=submit]:hover {
background-color: #45a049;
}


</style>
</head>
</html>

<!--Php code to connect to Databases and Perform Validations-->

<?php
echo "<center>";
echo "<h1>Hello,Please enter your details below</h1>";
echo "<div style= 'border-radius: 5px;background-color: #f2f2f2;padding: 20px;width:700px'>";

//Form that helps to enter the text fields

echo "<form action='program.php' method='post'>";
echo "<input type='text' name='t1' placeholder='NAME'>";

echo "<br>";
echo "<input type='text' name='t2' placeholder='CITY'>";
echo "<br>";
echo "<input type='text' name='t3' placeholder='STATE'>";
echo "<br>";
echo "<input type='text' name='t4' min='1111111111' max='9999999999' placeholder='PHONE NUMBER'>";

echo "<input type='submit' name='submit' value='register'>";
echo "<input type='submit' name='getDetails' value='Get Data of People'>";
echo "</form>";
echo "</div>";


  //Get the Data of people.
if(isset($_POST['getDetails']))
{
try
{
$dsn="mysql:host=courses;dbname=z1815642";
$user="z1815642";
$pwd="1994Nov16";
//Creating the Connection with the help of PDO Constructor
$conn=new PDO($dsn,$user,$pwd);
//Setting the Attributes of PDO
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


$query1="select * from people";
$res=$conn->query($query1);

  echo "<table border=1>";
  echo "<tr>";
  echo "<th>Name</th>";
  
  echo "<th>Phone</th>";
  echo "<th>City</th>";
  echo "<th>State</th>";
  echo "</tr>";
  foreach($conn->query($query1) as $row)
   {
   echo "<tr>";
   echo "<td>";
   echo $row['name'];
   echo "</td>";
   echo "<td>";
   echo $row['phone'];
   echo "</td>";
   echo "<td>";
   echo $row['city'];
   echo "</td>";
   echo "<td>";		    
   echo $row['state'];
   echo "</td>";
   echo "</tr>";
}
echo "</table>";
}

//Catching any Exceptions generated above

catch(PDOException $e)
{
echo "Unable to establish Connection".$e->getMessage();
}

}
  
//If the submit Button is clicked then perform the following

if(isset($_POST['submit']))
{


//If the Name is not entered ,Print the error message
if($_POST['t1']=="")
echo "<h1>Please Enter Your  Name</h1>";

//If the City is not entered ,Print the error message

else if($_POST['t2']=="")
echo "<h1>Please enter City</h1>";

//If the State is not entered ,Print the error message

else if($_POST['t3']=="")
echo "<h1>Please enter State</h1>";

//If the Phone number  is not entered ,Print the error message
else if($_POST['t4']=="")
echo "<h1>Please enter Phone number</h1>";


//If every thing is entered,Then create a connection and send the data entered into tables

else
{
 try
    {
       $dsn="mysql:host=courses;dbname=z1815642";
       $user="z1815642";
       $pwd="1994Nov16";
       $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

//Creating new Connection by Calling the PDO COnstrcutor

   	   $pdo=new PDO($dsn,$user,$pwd);


        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

   $insertq1=" insert into people(name,city,state,phone) values(?,?,?,?);";

//Getting the For variables into the local variables

   $x=$_POST['t1'];
      $y=$_POST['t2'];
         $z=$_POST['t3'];
	 $p=$_POST['t4'];
	 

//Preparing and executing the queries by passing the values into associative array

   $stmt=$pdo->prepare($insertq1);
      $res=$stmt->execute(array($x,$y,$z,$p));
     

      }

//Catching the Exception If any generated above

   catch(PDOException $e)
      {
         echo "Connection is not established".$e->getMessage();
	    }
	    }
}
?>
