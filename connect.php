<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hms";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: ".$conn->connect_error);
    }


    //Logout code
    if(isset($_POST['Logout']))
    {
        session_destroy();
        header("Location:index.php");
    }

    // add employee
    elseif(isset($_POST['add_employee']))
    {    
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = $_POST['email'];
        $password = mysqli_real_escape_string($conn, $_POST['password1']);
        $password = md5($password);
        $AccountType = $_POST['AccountType'];
        $tin_no = $_POST['tin_no'];
        $employee_id = $_POST['employee_id'];
        $phone_no = $_POST['phone_no'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $birthdate = $_POST['birthdate'];
        $status = $_POST['status'];
        $employees = 'employees';

           //check through individual account types if there is a match 
            $sql_email = "SELECT * FROM $AccountType  WHERE email='$email'";
            $sql_tin_no = "SELECT * FROM $AccountType WHERE tin_no='$tin_no'";
            $sql_employee_id = "SELECT * FROM $AccountType WHERE employee_id='$employee_id'";
            
            
            $res_email = $conn->query($sql_email);
            $res_tin_no = $conn->query($sql_tin_no);
            $res_employee_id = $conn->query($sql_employee_id);

            	
            if($res_email-> num_rows > 0){
                echo '<script type="text/javascript">alert("Email already used")</script>';
                exit();
                $conn->close();	 
            }
            else if($res_tin_no-> num_rows > 0){
                echo '<script type="text/javascript">alert("Tin number already used")</script>';
                exit();
                $conn->close();
            }
            else if($res_employee_id-> num_rows > 0){
                echo '<script type="text/javascript">alert("Please Generate Another ID")</script>';
                exit();
                $conn->close();
            }
            //check through individual account types if there is a match 

            //check through all account types if there is a match 
            $sql_email1 = "SELECT * FROM $employees  WHERE email='$email'";
            $sql_tin_no1 = "SELECT * FROM $employees WHERE tin_no='$tin_no'";
            $sql_employee_id1 = "SELECT * FROM $employees WHERE employee_id='$employee_id'";
            
            
            $res_email1 = $conn->query($sql_email1);
            $res_tin_no1 = $conn->query($sql_tin_no1);
            $res_employee_id1 = $conn->query($sql_employee_id1);

            	
            if($res_email1-> num_rows > 0){
                echo '<script type="text/javascript">alert("Email already used")</script>';
                exit();
                $conn->close();	 
            }
            else if($res_tin_no1-> num_rows > 0){
                echo '<script type="text/javascript">alert("Tin number already used")</script>';
                exit();
                $conn->close();
            }
            else if($res_employee_id1-> num_rows > 0){
                echo '<script type="text/javascript">alert("Please Generate Another ID")</script>';
                exit();
                $conn->close();
            }
            //check through all account types if there is a match 
    
            $sql = "INSERT INTO $AccountType (name, email, password, phone_no, gender, address, birthdate, status, AccountType, tin_no, employee_id)
            VALUES ('$name', '$email', '$password', '$phone_no', '$gender', '$address','$birthdate', '$status','$AccountType', '$tin_no', '$employee_id')";
            $employees_sql = "INSERT INTO $employees (name, email, password, phone_no, gender, address, birthdate, status, AccountType, tin_no, employee_id)
            VALUES ('$name', '$email', '$password', '$phone_no', '$gender', '$address','$birthdate', '$status','$AccountType', '$tin_no', '$employee_id')";
            
            if ($conn->query($sql) === TRUE) {
                echo '<script type="text/javascript">alert("Employee added")</script>';

            } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            if($conn->query($employees_sql) === TRUE ){
                echo '<script type="text/javascript">alert("Employee added to employees list")</script>';

            } 
            else {
                echo "Error: " . $employees_sql . "<br>" . $conn->error;
            }

        $conn->close();
    } 
    // add employee

    //view all
    elseif(isset($_POST['view_all']))
    {
        $AccountType = $_POST['view_type'];
        $view_query = "SELECT * FROM $AccountType";

        if ($AccountType != 'Patient')
        {
            echo '<!doctype html>';
            echo '<html lang="en">';
             echo' <head>';
                echo '<title>Table</title>';
                echo '<!-- Required meta tags -->';
                echo '<meta charset="utf-8">';
                echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
                echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
            echo '</head>';
            echo '<body>';

            echo '<table class="table table-hover table light table-striped" id="table-data">';
            echo '<thead>';
                echo '<tr>';
                    echo '<th>Name</th>';
                    echo '<th>Email</th>';
                    echo '<th>Phone number</th>';
                    echo '<th>Account Type</th>';
                    echo '<th>Employee ID</th>';
                    echo '<th>Tin number</th>';
                echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            if ($result = $conn->query($view_query)) {
                while ($row = $result->fetch_assoc()) {
            echo '<tr>';
                    echo '<td>'; echo $row['name']; echo'</td>';
                    echo '<td>'; echo $row['email']; echo '</td>';
                    echo '<td>'; echo $row['phone_no']; echo'</td>';
                    echo '<td>'; echo $row['AccountType']; echo '</td>';
                    echo '<td>'; echo $row['employee_id']; echo '</td>';
                    echo '<td>'; echo $row['tin_no']; echo'</td>';
            echo '</tr>';
                }
             } 
             echo '</tbody>';
         }

        elseif($AccountType == 'Patient')
        {

            echo '<!doctype html>';
            echo '<html lang="en">';
             echo' <head>';
                echo '<title>Table</title>';
                echo '<!-- Required meta tags -->';
                echo '<meta charset="utf-8">';
                echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
                echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
            echo '</head>';
            
            echo '<body>';
            echo '<table class="table table-hover table light table-striped" id="table-data">';
            echo '<thead>';
                echo '<tr>';
                    echo '<th>Name</th>';
                    echo '<th>Email</th>';
                    echo '<th>ID Type</th>';
                    echo '<th>ID Number</th>';
                    echo '<th>Birthdate</th>';
                    echo '<th>Status</th>';
                    echo '<th>Gender</th>';
                echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            if ($result = $conn->query($view_query)) {
                while ($row = $result->fetch_assoc()) {
         
            echo '<tr>';
                    echo '<td>'; echo $row['name']; echo'</td>';
                    echo '<td>'; echo $row['email']; echo '</td>';
                    echo '<td>'; echo $row['IDType']; echo '</td>';
                    echo '<td>'; echo $row['IDNumber']; echo'</td>';
                    echo '<td>'; echo $row['birthdate']; echo'</td>';
                    echo '<td>'; echo $row['status']; echo'</td>';
                    echo '<td>'; echo $row['gender']; echo'</td>';
            echo '</tr>';
                }
             } 
             echo '</tbody>';

        }    
            echo '<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>';
            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>';
            echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>';
            echo '</body>';
            echo '</html>';
            
    }
    //view all

?>
