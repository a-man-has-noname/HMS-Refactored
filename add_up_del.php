<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hms";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }
    echo '<script type="text/javascript">alert("Connected")</script>';

    // //Create DB
    // $sql = "create Database hms";
    // if ($conn->query($sql) === TRUE){
    //     echo "Created Database Successfully";
    // }
    // else{
    //     echo "There was an error" .$conn->error;
    // }

    // //Create Table
    // $sql = "CREATE Table patients (
    //     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //     fullname VARCHAR(30) NOT NULL,
    //     username VARCHAR(30) not null,
    //     password VARCHAR(100) NOT NULL,
    //     email VARCHAR(60),
    //     id_no VARCHAR(60) NOT NULL,
    //     age INT(4) NOT NULL,
    //     gender VARCHAR(100),
    //     phone_no INT(100),
    //     address VARCHAR(100) NOT NULL)";

    //     if ($conn->query($sql) === TRUE){
    //         echo "Table Created";
    //     }
    //     else{
    //         echo "there was an error : " . $conn->error;
    //     }



    if(isset($_POST['login']))
    {    
         $cust_username = $_POST['username'];
         $cust_password = $_POST['password'];
         $userType = $_POST['userType'];
    
           $sql="SELECT * FROM $userType WHERE username='$cust_username' and password='$cust_password'";
           $result = mysqli_query($conn,$sql);
           $result_arr= mysqli_num_rows($result);
        
           if($result && $result_arr == 1 ){
               echo '<script type="text/javascript">alert("Login Successful")</script>';
               switch ($userType) {
                   case "Admin":
                       header('location: admin_index.html');
                       break;
                   case "Doctor":
                       header('location: doctor_index.html');
                       break;
                   case "Pharmacist":
                       header('location: pharm_index.html');
                       break;
                   case "Pharmacist":
                       header('location: nurse_index.html');
                       break;
                   case "Pharmacist":
                       header('location: receptionist_index.html');
                       break;
                   default:
                   header('location: index.html');
               }
           
           }else{
               echo '<script type="text/javascript">alert("Wrong Username/password/Account Type")</script>';
               header('location: login.html');
           }
    }
    //Insert into table
    elseif(isset($_POST['create']))
    {    
        $firstname = $_POST['firstname'];
        $othernames=$_POST['othernames'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $password = $_POST['password1'];
        $email = $_POST['email'];
        $id_no = $_POST['id_no'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $phone_no = $_POST['phone_no'];
        $address = $_POST['address'];
        $userType = $_POST['userType'];

            $sql_u = "SELECT * FROM $userType WHERE username='$username'";
            $sql_e = "SELECT * FROM $userType WHERE email='$email'";
            $sql_i = "SELECT * FROM $userType WHERE id_no='$id_no'";
            $res_u = $conn->query($sql_u);
            $res_e = $conn->query($sql_e);
            $res_i = $conn->query($sql_i);

            if ($res_u-> num_rows > 0) {
                echo '<script type="text/javascript">alert("Username taken")</script>'; 
                exit();
                $conn->close();	
            }else if($res_e-> num_rows > 0){
                echo '<script type="text/javascript">alert("Email already used")</script>';
                exit();
                $conn->close();	 
            }else if($res_i-> num_rows > 0){
                echo '<script type="text/javascript">alert("ID already used")</script>';
                exit();
                $conn->close();
            }
    
            $sql = "INSERT INTO $userType (firstname, othernames, lastname, username, password, email, id_no, age, gender, phone_no, address)
            VALUES ('$firstname', '$othernames', '$lastname', '$username', '$password', '$email', '$id_no', '$age', '$gender', '$phone_no', '$address')";
    
            if ($conn->query($sql) === TRUE) {
                //header('location: login.html');
                echo '<script type="text/javascript">alert("New record added successfully")</script>';

            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

        $conn->close();
    } 

    elseif(isset($_POST['signup_patient']))
    {    
        $firstname = $_POST['firstname'];
        $othernames = $_POST['othernames'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $password = $_POST['password1'];
        $email = $_POST['email'];
        $id_no = $_POST['id_no'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $phone_no = $_POST['phone_no'];
        $address = $_POST['address'];
        $userType = $_POST['userType'];

            $sql_u = "SELECT * FROM $userType WHERE username='$username'";
            $sql_e = "SELECT * FROM $userType WHERE email='$email'";
            $sql_i = "SELECT * FROM $userType WHERE id_no='$id_no'";
            $res_u = $conn->query($sql_u);
            $res_e = $conn->query($sql_e);
            $res_i = $conn->query($sql_i);

            if ($res_u-> num_rows > 0) {
                echo '<script type="text/javascript">alert("Username taken")</script>'; 
                exit();
                $conn->close();	
            }else if($res_e-> num_rows > 0){
                echo '<script type="text/javascript">alert("Email already used")</script>';
                exit();
                $conn->close();	 
            }else if($res_i-> num_rows > 0){
                echo '<script type="text/javascript">alert("ID already used")</script>';
                exit();
                $conn->close();
            }
    
            $sql = "INSERT INTO $userType (firstname, othernames, lastname, username, password, email, id_no, age, gender, phone_no, address)
            VALUES ('$firstname', '$othernames', '$lastname', '$username', '$password', '$email', '$id_no', '$age', '$gender', '$phone_no', '$address')";
    
            if ($conn->query($sql) === TRUE) {
                //header('location: login.html');
                echo '<script type="text/javascript">alert("New record added successfully")</script>';

            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

        $conn->close();
        }    

    elseif (isset($_POST['check']))
    {    
        $username = $_POST['check_username'];
        $id_no = $_POST['check_id'];
        $userType = $_POST['userType'];
        
   
          $sql="SELECT * FROM $userType WHERE username='$username' and id_no='$id_no'";
          $result = mysqli_query($conn,$sql);
          $result_arr= mysqli_num_rows($result);
       
              if($result && $result_arr == 1 ){
                  echo '<script type="text/javascript">alert("User found")</script>' ;
                  header('location: update.html');
              }
              else
              {
                  echo '<script type="text/javascript">alert("User Not In Database")</script>';
                  header('location: find.html');
              }
          
    }
    elseif(isset($_POST['update'])){
          $old_username = $_POST['old_username'];
          $new_firstname = $_POST['new_firstname'];
          $new_othernames = $_POST['new_othernames'];
          $new_lastname = $_POST['new_lastname'];
          $userType = $_POST['new_userType'];
          $newusername = $_POST['newusername'];
          $newpassword = $_POST['newpassword1'];
          $newemail = $_POST['newemail'];
          $newid_no = $_POST['newid_no'];
          $newage = $_POST['newage'];
          $newgender = $_POST['newgender'];
          $newphone_no = $_POST['newphone_no'];
          $newaddress = $_POST['newaddress'];


          $sql = "UPDATE $userType SET firstname='$new_firstname',
                                   othernames='$new_othernames',
                                   lastname='$new_lastname',
                                   username='$newusername',
                                   password='$newpassword',
                                   email='$newemail',
                                   id_no='$newid_no',
                                   age='$newage',
                                   gender='$newgender',
                                   phone_no='$newphone_no',
                                   address='$newaddress'
                                WHERE username='$old_username'";
          if ($conn->query($sql) === TRUE) 
          {
            echo '<script type="text/javascript">alert("Recorded Sucessfully")</script>' ;
          } 
          else {
              echo "Error updating record: " . $conn->error;
          }
          
          $conn->close();
    }
    elseif(isset($_POST['delete'])){
        {    
            $cust_username = $_POST['del_username'];
            $userType = $_POST['del_userType'];
            $id_no = $_POST['del_id'];
            
            $sql = "DELETE FROM $userType WHERE username='$cust_username' and id_no='$id_no'";
            if ($conn->query($sql) === TRUE)
            {
              echo 'Recorded Deleted' ;
            } 
            else {
                echo "Error updating record: " . $conn->error;
            }
            
            $conn->close();
          }
    }
    elseif(isset($_POST['view'])){
        {    
            $cust_fullname = $_POST['check_fullname'];
            $userType = $_POST['userType'];
            $id_no = $_POST['check_id'];
            
            $sql = "SELECT * FROM $userType WHERE fullname='$cust_fullname' and id_no='$id_no'";
            $result = $conn->query($sql);

            

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<style> 
                            .flat-table {
                                display: block;
                                font-family: sans-serif;
                                -webkit-font-smoothing: antialiased;
                                font-size: 115%;
                                overflow: auto;
                                width: auto;
                                
                                th {
                                background-color: rgb(112, 196, 105);
                                color: white;
                                font-weight: normal;
                                padding: 20px 30px;
                                text-align: center;
                                }
                                td {
                                background-color: rgb(238, 238, 238);
                                color: rgb(111, 111, 111);
                                padding: 20px 30px;
                                }
                            }
                        </style>";
                    echo "<table class='flat-table' border='1'>
                        <tr>
                            <th>Fullname</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>ID Number</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Phone-number</th>
                            <th>Address</th>
                        </tr>";
                    echo "<tr>";
                        echo  "<td>". $row["fullname"]."</td>" ;
                        echo  "<td>" .$row["username"]. "</td>";
                        echo  "<td>" .$row["password"]. "</td>";
                        echo  "<td>" .$row["email"]. "</td>";
                        echo  "<td>" .$row["id_no"]. "</td>";
                        echo  "<td>" .$row["age"]. "</td>";
                        echo  "<td>" .$row["gender"]. "</td>";
                        echo  "<td>" .$row["phone_no"]. "</td>";
                        echo  "<td>" .$row["address"]. "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No one found with details Provided";
            }
            $conn->close();
          }
    }
    elseif(isset($_POST['view_all'])){
        {    
            $userType = $_POST['userType_all'];
            
            $sql = "SELECT * FROM $userType";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {

                    echo "<style> 
                            .flat-table {
                                display: block;
                                font-family: sans-serif;
                                -webkit-font-smoothing: antialiased;
                                font-size: 115%;
                                overflow: auto;
                                width: auto;
                                
                                th {
                                background-color: rgb(112, 196, 105);
                                color: white;
                                font-weight: normal;
                                padding: 20px 30px;
                                text-align: center;
                                }
                                td {
                                background-color: rgb(238, 238, 238);
                                color: rgb(111, 111, 111);
                                padding: 20px 30px;
                                }
                            }
                        </style>";

                    echo "<table class='flat-table' border='1'>
                        <tr>
                            <th>Fullname</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>ID Number</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Phone-number</th>
                            <th>Address</th>
                        </tr>";
                    echo "<tr>";
                        echo  "<td>". $row["fullname"]."</td>" ;
                        echo  "<td>" .$row["username"]. "</td>";
                        echo  "<td>" .$row["password"]. "</td>";
                        echo  "<td>" .$row["email"]. "</td>";
                        echo  "<td>" .$row["id_no"]. "</td>";
                        echo  "<td>" .$row["age"]. "</td>";
                        echo  "<td>" .$row["gender"]. "</td>";
                        echo  "<td>" .$row["phone_no"]. "</td>";
                        echo  "<td>" .$row["address"]. "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No one found under account type";
            }
            $conn->close();
          }
    }
?>