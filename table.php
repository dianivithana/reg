        <?php
$severname="localhost";
$username="root";
$password="";


//Create Connection
$con = mysql_connect($severname, $username, $password) or die('Connection error');

//Select a DB

mysql_select_db('STUDENTS');






$sql_s="SELECT * FROM student";
$result = mysql_query($sql_s);

echo "<table border='1' style='border-collapse:collapse>'";
echo "<th>ID</th><th>Name</th><th>Email</th><th>Tel No</th><th>Subject</th>";    

while($row =  mysql_fetch_array($result)){
   echo "<tr><td>".$row['fname']."".$row['lname']."</td><td>".$row['email']."</td><td>".$row['tel']."</td><td>".$row['subject']."</td></tr>";
}
echo "</table>";
mysql_close($con);
?>
