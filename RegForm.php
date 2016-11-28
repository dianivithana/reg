<?php
$databaseHostName = "localhost";
$databaseUserName = "root";
$databasePassword = "";
$databaseName = "reg";

$con = mysql_connect($databaseHostName, $databaseUserName, $databasePassword) or die('Connection error');
mysql_select_db($databaseName, $con);

if ($_POST) {
        $Name = $_POST["name"];
        $NIC = $_POST["nic"];
        $Address = $_POST["address"];
        $Gender = $_POST["gender"];
        $TPnum = $_POST["tpnum"];
        $Subjects = $_POST["subject"];
        $City = $_POST["city"];

        $sql = "INSERT INTO regdetails(Name,NIC,Address,Gender,TPnum,Subjects,City) VALUES ('$Name','$NIC','$Address','$Gender','$TPnum','$Subjects','$City')";

        if (mysql_query($sql)) {
            echo 'Successfully added to the table';
        } else {
            echo 'Somethings wrong';
        }
    }
   
   
//var_dump($result_e);
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'edit' && isset($_GET['id'])) {
        //var_dump($_GET['id']);
        $query = mysql_query("SELECT * FROM regdetails WHERE ID=" . $_GET['id']);
        $result_e = mysql_fetch_object($query);
        //var_dump($result_e);
        if ($_POST) {
            $id = $_GET['id'];
            $Name = $_POST["name"];
            $NIC = $_POST["nic"];
            $Address = $_POST["address"];
            $Gender = $_POST["gender"];
            $TPnum = $_POST["tpnum"];
            $Subjects = $_POST["subject"];
            $City = $_POST["city"];

            $sql_e = "UPDATE regdetails SET (name = $Name, nic = $NIC, address = $Address, gender = $Gender, tpnum = $TPnum, subject = $Subjects, city = $City) WHERE id = $id";
            mysql_query($sql_e);
            
            
        }
        
    

    if ($_GET['action'] == 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql_d = "DELETE FROM regdetails WHERE id = " . $_GET['id'];
        $result_d = mysql_query($sql_d);
    }  
   
}
}

$query = "SELECT * FROM regdetails";
$results = mysql_query($query);

mysql_close($con);
?>


<html>
    <head>
        <title>
            Registration Form
        </title>  
        <link href="css/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="style.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>

        <div class="container">
            
            <form method="POST" onsubmit="formValidation()">  
                <h2 class="h2">Registration Form</h2>
                <div class="row">
                    <div class="col-sm-4">Name: <input class="input" type="text" name="name" id="name" placeholder="Name" value="<?= $result_e->Name?>"/></div>
                        
                    <div class="col-sm-4">NIC number: <input class="input" type="text" name="nic" id="nic" placeholder="NIC"  value="<?= $result_e->NIC?>" /> </div>
                    
                </div>
                    
                <div class="row">
                    <div class="col-sm-8">Address:
                        <input class="input" type="text" name="address" id="address" placeholder="Address" value="<?= $result_e->Address?>"/>
                    </div>    
                </div>
                <div class="row">
                    <div class="col-sm-4">Gender:
                        <label class="radio-inline"><input type="radio" name="gender"  value="<?= $result_e->Male?>"/>Male</label>
                        <label class="radio-inline"<input type="radio" name="gender" value="<?= $result_e->Female?>"/>Female</label>
                    </div>
                    <div class="col-sm-4">Contact Details: <input class="input" type="number" name="tpnum" id="tpnum" value="<?= $result_e->TPnum?>"/></div>
                </div>
                    
                <div class="row">
                    <div class="col-sm-4">Subjects:
                        <label class="checkbox-inline"><input type="checkbox" name="subject" value="Maths" value="<?= $result_e->Subjects?>"/>Maths</label>
                        <label class="checkbox-inline"><input type="checkbox" name="subject" value="IT" value="<?= $result_e->Subjects?>"/>IT</label>
                        <label class="checkbox-inline"><input type="checkbox" name="subject" value="Science" value="<?= $result_e->Subjects?>"/>Science</label>
                    </div>
                    <div class="col-sm-4">City:
                        <select class="form-control" name="city" value="<?= $result_e->City?>">
                                <option value="colombo">Colombo</option>
                                <option value="galle">Galle</option>
                                <option value="kandy">Kandy</option>
                            </select> 
                    </div>
                </div>
                <div class="row"><br><br></div>
                <div class="row">
                     <div class="col-sm-4"><input class="btn btn-success"  type="reset" name="reset" id="reset"/></div>
                     <div class="col-sm-4"><input class="btn btn-primary" type="submit" name="submit" id="submit"/></div>
                </div> 
                 <br/>
                <!-- <input type="button" name="new" id="new" value="New" onclick="resetForm()" /> -->
            </form>
            <br><br><br><br><br>
            <form method="POST">
                <table class="table table-hover table-responsive table-condensed">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>NIC</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Contact Details</th>
                        <th>Subjects</th>
                        <th>City</th>

                    </tr>
                    <?php
                    while ($array = mysql_fetch_assoc($results)) {
                        //var_dump($array);
                        ?>
                        <tr>
                            <td><?php echo $array['id'] ?></td>
                            <td><?php echo $array['Name'] ?></td>
                            <td><?php echo $array['NIC'] ?></td>
                            <td><?php echo $array['Address'] ?></td>
                            <td><?php echo $array['Gender'] ?></td>
                            <td><?php echo $array['TPnum'] ?></td>
                            <td><?php echo $array['Subjects'] ?></td>
                            <td><?php echo $array['City'] ?></td>
                            <td>
                                <a href="?action=edit&id=<?php echo $array['id']; ?>">Edit </a>
                                <a href="?action=delete&id=<?php echo $array['id']; ?>">Delete </a>

                        </tr>  
                    <?php } ?>

                </table>

            </form>
        </div>

     

    </body>
</html>



