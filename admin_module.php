<?php
    include 'connect.php';
    // session_start();

    // find employee
    if (isset($_POST['find_employee']))
    {    
        
        $_SESSION['checker'] = 0;
        $email = $_POST['email_find'];
        $tin_no_find = $_POST['tin_no_find'];
        $AccountType = $_POST['AccountType'];
        
   
          $sql="SELECT * FROM $AccountType WHERE email='$email' and tin_no='$tin_no_find'";
          $result = mysqli_query($conn,$sql);
          $result_arr= mysqli_num_rows($result);
       
              if($result && $result_arr == 1 ){
                $_SESSION['checker'] = 1;
                // echo "<script type=\"text/javascript\">".
                //      "window.alert('Employee found. Go ahead and update');".
                //      "top.location = 'admin_module.php';".
                //      "</script>";
                echo '<script type="text/javascript">alert("Employee found. Go ahead an update now.")</script>';
                echo '<script type="text/javascript">
                        var check = 1;
                      </script>';
              }
              else
              {
                echo '<script type="text/javascript">alert("Employee not in database")</script>';
                echo '<script type="text/javascript">
                var check = 0;
                </script>';
              }
          
    }
    // find employee

    // update employee
    elseif(isset($_POST['update_employee']))
    {
        $name = $_POST['update_name'];
        $email = $_POST['update_email'];
        $phone_no = $_POST['update_phone_no'];
        $password = md5($_POST['update_password1']);
        $AccountType = $_POST['update_AccountType'];
        $tin_no = $_POST['update_tin_no'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $birthdate = $_POST['birthdate'];
        $status = $_POST['status'];
        $employees = 'employees';

        //update account type
        $sql = "UPDATE $AccountType SET name='$name', email='$email', address='$address', gender='$gender', birthdate='$birthdate', status='$status', phone_no = '$phone_no', password='$password', AccountType='$AccountType'
                                    WHERE tin_no = $tin_no";
        if ($conn->query($sql) === TRUE) 
        {
        //   header('location: admin_module.php');
          echo '<script type="text/javascript">alert("Record updated")</script>' ;
        } 
        else {
            echo "Error updating record: " . $conn->error;
        }
        //update employee table
        $employee_sql = "UPDATE employees SET name='$name', email='$email', address='$address', gender='$gender', birthdate='$birthdate', status='$status', phone_no = '$phone_no', password='$password', AccountType='$AccountType'
                                             WHERE tin_no = $tin_no";
        if ($conn->query($employee_sql) === TRUE) 
        {
          echo '<script type="text/javascript">alert("Record updated in employee table")</script>' ;
        } 
        else {
            echo "Error updating record in employee table: " . $conn->error;
        }
        
        $conn->close();
    }
    // update employee

    //del record
    elseif(isset($_POST['find_n_del']))
    {    
        $email = $_POST['email_del'];
        $id = $_POST['id_del'];
        $AccountType = $_POST['Del_find_AccType'];
        $employees = 'employees';

            $sql="SELECT * FROM $AccountType WHERE email='$email' and tin_no='$id'";
            $del_sql = "DELETE FROM $AccountType WHERE email='$email' and tin_no='$id'";
            $del_sql_emp = "DELETE FROM $employees WHERE email='$email' and tin_no='$id'";
            
            $result = mysqli_query($conn,$sql);
            $result_arr= mysqli_num_rows($result);
       
            if($result && $result_arr == 1 ){
            
            // echo "<script type=\"text/javascript\">".
            //      "window.alert('Employee found. Go ahead and update');".
            //      "top.location = 'admin_module.php';".
            //      "</script>";
            echo '<script type="text/javascript">alert("User found")</script>';
            }
            else
            {
            echo '<script type="text/javascript">alert("User not in Found")</script>';
            }
            
            if ($conn->query($del_sql) === TRUE)
            {
                echo '<script type="text/javascript">alert("User Deleted")</script>';
            }
            else
            {  
                echo '<script type="text/javascript">alert("User could not be Deleted")</script>';
            }

            if ($conn->query($del_sql_emp) === TRUE)
            {
                echo '<script type="text/javascript">alert("User Deleted from employee record also")</script>';
            }
            else
            {  
               
            }

    
          
    }
    //del record

?>

    <!doctype html>
    <html lang="en">

    <head>
        <title>Admin(HMS)</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
        <!-- Nav Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Welcome, <?php echo $_SESSION["email"]; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>

                <form class="form-inline my-2 my-lg-0" action="connect.php" method="POST">
                    <button class="btn btn-outline-danger my-2 my-sm-0" type="submit" name="Logout">Logout</button>
                </form>
            </div>
        </nav>
        <!-- Nav Bar -->


        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10 bg-dark mt-2 rounded">
                    <hr>
                    <!-- add and update employee details-->
                    <div class="card text-center">
                        <div class="card-header">
                            Add/Update Employee
                        </div>
                        <div class="card-body">
                            <p class="card-text">Select either button to add an employee or update employee details respectively</p>
                            <p>
                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#AddUser" aria-expanded="false" aria-controls="collapseExample">
                        Add Employee
                    </button>&NonBreakingSpace;
                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#UpdateUser" aria-expanded="false" aria-controls="collapseExample">
                        Update Employee Details
                    </button>
                            </p>
                            <!-- add button content -->
                            <div class="collapse" id="AddUser">
                                <div class="card card-body">
                                    <form action="admin_module.php" method="POST">
                                        <!-- Name & email -->
                                        <div class="input-group flex-nowrap">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping">Name</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Surname/First Name/Other Names" name="name" aria-label="Username" aria-describedby="addon-wrapping" required>&nbsp;&nbsp;&nbsp;
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping">Email</span>
                                            </div>
                                            <input type="email" class="form-control" id=email"" name="email" placeholder="example@gmail.com" aria-label="Username" aria-describedby="addon-wrapping" required>&nbsp;&nbsp;&nbsp;
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping">Phone number</span>
                                            </div>
                                            <input type="number" class="form-control" placeholder="0247283893" name="phone_no" aria-label="Username" aria-describedby="addon-wrapping" required>
                                        </div>
                                        <!-- Name & email -->

                                        <!-- Password & Verify password -->
                                        <p>
                                            <div class="input-group flex-nowrap">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="addon-wrapping">Password</span>
                                                </div>
                                                <input type="password" maxlength="10" class="form-control" aria-label="Username" name="password1" id="password" aria-describedby="addon-wrapping" required> &nbsp;&nbsp;&nbsp;
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="addon-wrapping">Confirm Password</span>
                                                </div>
                                                <input type="password" maxlength="10" class="form-control" aria-label="Username" name="password2" id="confirm_password" aria-describedby="addon-wrapping" required>
                                            </div>
                                        </p>
                                        <!-- Password & Verify password -->

                                        <!--gender and address-->
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Gender</span>
                                                    </div>
                                                        <select name="gender">
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Other">Other</option>
                                                        </select>&nbsp;&nbsp;&nbsp;
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Address</span>
                                                    </div>
                                                    <input type="text" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" name="address">&nbsp;&nbsp;&nbsp;
                                                </div>
                                        <!--gender and address-->


                                        <!--birthdate and status-->
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Birthdate</span>
                                                </div>
                                                <input type="date" name="birthdate">&nbsp;&nbsp;&nbsp;
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Status</span>
                                                </div>
                                                <select name="status">
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                </select>
                                            </div>
                                <!--birthdate and status-->

                                        <!-- Account-Type -->
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Employee Type</label>
                                            </div>
                                            <select name="AccountType" class="custom-select" id="inputGroupSelect01">
                                                <option value="Doctor">Doctor</option>
                                                <option value="Pharmacist">Pharmacist</option>
                                                <option value="Nurse">Nurse</option>
                                                <option value="Receptionist">Receptionist</option>
                                            </select>
                                        </div>
                                        <!-- Account-Type -->

                                        <!-- Tin no and Generate ID -->
                                        <p>
                                            <div class="input-group flex-nowrap">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="addon-wrapping">Tin number</span>
                                                </div>
                                                <input type="number" class="form-control" aria-label="Username" name="tin_no" aria-describedby="addon-wrapping" required>&nbsp;&nbsp;&nbsp;
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-secondary" onclick="num_gen()" type="button" id="button-addon1">GENERATE</button>
                                                </div>
                                                <input type="text" id="eightrandom" name="employee_id" class="form-control" placeholder="Hit generate " aria-describedby="button-addon1">
                                            </div>
                                        </p>
                                        <!-- Tin no and Generate ID -->
                                        <button type="submit" name="add_employee" onclick="validatePassword(); ValidateEmail()" class="btn btn-success">ADD</button>
                                    </form>
                                </div>
                            </div>
                            <!-- add button content -->

                            <!-- update button content -->
                            <div class="collapse" id="UpdateUser">
                                <div class="card card-body">
                                    <!-- Find button content -->
                                    <form method="POST" action="admin_module.php" id="to_hide">
                                        <p>Enter the following details to find Employee first</p>
                                        <div class="input-group mb-3" id="find_content">

                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Employee Type</label>
                                            </div>
                                            <select name="AccountType" class="custom-select" id="inputGroupSelect01">
                                                <option value="Doctor">Doctor</option>
                                                <option value="Pharmacist">Pharmacist</option>
                                                <option value="Nurse">Nurse</option>
                                                <option value="Receptionist">Receptionist</option>
                                            </select>&nbsp;&nbsp;&nbsp;

                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Employee tin number</span>
                                            </div>
                                            <input type="text" name="tin_no_find" class="form-control" placeholder="12345" aria-label="Username" aria-describedby="basic-addon1">&nbsp;&nbsp;&nbsp;
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Employee email address</span>
                                            </div>
                                            <input type="text" name="email_find" class="form-control" placeholder="example@gmail.com" aria-label="Username" aria-describedby="basic-addon1">



                                        </div>
                                        <button type="submit" name="find_employee" onclick="" class="btn btn-success">Find</button>
                                    </form>
                                    <!-- Find button content -->

                                    <!-- Update User content -->
                                    <form method="POST" action="admin_module.php" id="to_show" style="display: none;">
                                        <!-- Name & email -->
                                        <div class="input-group flex-nowrap">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping">Name</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Surname/First Name/Other Names" name="update_name" aria-label="Username" aria-describedby="addon-wrapping" required>&nbsp;&nbsp;&nbsp;
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping">Email</span>
                                            </div>
                                            <input type="email" class="form-control" id="update_email" name="update_email" placeholder="example@gmail.com" aria-label="Username" aria-describedby="addon-wrapping" required>&nbsp;&nbsp;&nbsp;
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping">Phone_no</span>
                                            </div>
                                            <input type="number" class="form-control" placeholder="0247283893" name="update_phone_no" aria-label="Username" aria-describedby="addon-wrapping" required>
                                        </div>
                                        <!-- Name & email -->

                                        <!-- Password & Verify password -->
                                        <p>
                                            <div class="input-group flex-nowrap">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="addon-wrapping">Password</span>
                                                </div>
                                                <input type="password" maxlength="10" class="form-control" aria-label="Username" name="update_password1" id="password" aria-describedby="addon-wrapping" required> &nbsp;&nbsp;&nbsp;
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="addon-wrapping">Confirm Password</span>
                                                </div>
                                                <input type="password" maxlength="10" class="form-control" aria-label="Username" name="update_password2" id="confirm_password" aria-describedby="addon-wrapping" required>
                                            </div>
                                        </p>
                                        <!-- Password & Verify password -->

                                        <!--gender and address-->
                                        <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Gender</span>
                                                    </div>
                                                        <select name="gender">
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Other">Other</option>
                                                        </select>&nbsp;&nbsp;&nbsp;
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Address</span>
                                                    </div>
                                                    <input type="text" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" name="address">&nbsp;&nbsp;&nbsp;
                                                </div>
                                        <!--gender and address-->


                                        <!--birthdate and status-->
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Birthdate</span>
                                                </div>
                                                <input type="date" name="birthdate">&nbsp;&nbsp;&nbsp;
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Status</span>
                                                </div>
                                                <select name="status">
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                </select>
                                            </div>
                                        <!--birthdate and status-->

                                        <!-- Account-Type -->
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Employee Type</label>
                                            </div>
                                            <select name="update_AccountType" class="custom-select" id="inputGroupSelect01">
                                            <option value="Doctor">Doctor</option>
                                            <option value="Pharmacist">Pharmacist</option>
                                            <option value="Nurse">Nurse</option>
                                            <option value="Receptionist">Receptionist</option>
                                            </select>
                                        </div>
                                        <!-- Account-Type -->

                                        <!-- Tin no-->
                                        <p>
                                            <div class="input-group flex-nowrap">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="addon-wrapping">Tin number</span>
                                                </div>
                                                <input type="number" placeholder="Enter your current tin number for validation purposes" class="form-control" aria-label="Username" name="update_tin_no" aria-describedby="addon-wrapping" required>
                                            </div>
                                        </p>
                                        <!-- Tin no-->
                                        <button type="submit" name="update_employee" onclick="validatePassword()" class="btn btn-success">Update</button>
                                    </form>
                                    <!-- Update User content -->
                                </div>
                            </div>
                            <!-- update button content -->
                        </div>
                    </div>
                    <hr>
                    <!-- add and update employee details-->

                    <!-- View All Employees or Patients-->
                    <div class="card text-center">
                        <div class="card-header">
                            View Employees/Patients
                        </div>
                        <div class="card-body">
                            <form method="POST" action="connect.php">
                                <p class="card-text">Select to View employees or patients</p>
                                <p>
                                    <div class="dropdown">
                                        <select name="view_type">
                            <option value="Doctor"> All Doctors</option>
                            <option value="Nurse">All Nurses </option>>
                            <option value="Pharmacist">All Pharmacists</option>
                            <option value="Receptionist"> All Receptionists</option>
                            <option value="Patient">All Patients</option>
                            <option value="employees">All Employees</option>
                        </select>
                                    </div>
                                </p>
                                <p><button type="submit" data-toggle="collapse" name="view_all" aria-expanded="false" aria-controls="collapseExample" class="btn btn-primary">Click Here to View</button></p>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <!-- View All Employees or Patients-->

                    <!-- Delete Employees or Patients-->
                    <div class="card text-center">
                        <div class="card-header">
                            Delete Employee/Patient Record
                        </div>
                        <div class="card-body">
                            <!-- Find and del button content -->
                            <form method="POST" action="admin_module.php" id="">
                                <p>Enter the following details to find and Delete Employee/patient</p>
                                <div class="input-group mb-3" id="">

                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Account Type</label>
                                    </div>
                                    <select name="Del_find_AccType" class="custom-select" id="inputGroupSelect01">
                                        <option value="Doctor">Doctor</option>
                                        <option value="Pharmacist">Pharmacist</option>
                                        <option value="Nurse">Nurse</option>
                                        <option value="Receptionist">Receptionist</option>
                                        <option value="Receptionist">Patient</option>
                                </select>&nbsp;&nbsp;&nbsp;

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Employee tin number/ID Number</span>
                                    </div>
                                    <input type="text" name="id_del" class="form-control" placeholder="12345" aria-label="Username" aria-describedby="basic-addon1"> &nbsp;&nbsp;&nbsp;
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Email address</span>
                                    </div>
                                    <input type="text" name="email_del" class="form-control" placeholder="example@gmail.com" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <button type="submit" name="find_n_del" onclick="" class="btn btn-danger">Find And Delete</button>
                            </form>
                            <!-- Find button content -->

                            <!-- Update User content -->
                            <form method="POST" action="admin_module.php" id="to_show" style="display: none;">
                                <!-- Name & email -->
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="addon-wrapping">Name</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Surname/First Name/Other Names" name="update_name" aria-label="Username" aria-describedby="addon-wrapping" required>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="addon-wrapping">Email</span>
                                    </div>
                                    <input type="email" class="form-control" name="update_email" placeholder="example@gmail.com" aria-label="Username" aria-describedby="addon-wrapping" required>
                                </div>
                                <!-- Name & email -->
                        </div>
                    </div>
                    <hr>
                    <!-- Delete Employees or Patients-->
                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <script>
            //Check user function then hid find div
            if (check == 1) {
                var div_to_hide = document.getElementById("to_hide");
                var div_to_show = document.getElementById("to_show");
                div_to_hide.style.display = "none";
                div_to_show.style.display = "block";
            } else {
                div_to_hide.style.display = "block";
                div_to_show.style.display = "none";
            }
            //Check user function then hid find div



            // Number generator 
            function num_gen() {
                var eightdigitrandom = Math.floor(10000000 + Math.random() * 90000000);
                document.getElementById("eightrandom").value = eightdigitrandom;
                document.getElementById("button-addon1").disabled = true;
            }
            // Number generator

            // Password Match
            function validatePassword() {
                var password = document.getElementById("password"),
                    confirm_password = document.getElementById("confirm_password");
                passwd = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,10}$/;

                if (password.value != confirm_password.value) {
                    confirm_password.setCustomValidity("Passwords Don't Match");
                } else {
                    confirm_password.setCustomValidity('');
                }

                if (password.value.match(passwd)) {
                    password.setCustomValidity('');
                } else {
                    password.setCustomValidity('Password must between 6 to 10 characters which contain at least one numeric digit and a special character');
                }

            }


            // Password Match
        </script>

        <!-- email validation -->
        <script>
               function ValidateEmail(){
                var email = document.getElementById("email");
                var update_email = document.getElementById("update_email");
                var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

                if(email.value.match(mailformat)) 
                {
                    email.setCustomValidity('');
                }

                else{
                    email.setCustomValidity('Invalid email');
                }

                if(update_email.value.match(mailformat))
                {
                    update_email.setCustomValidity('');
                }else{
                    update_email.setCustomValidity('Invalid email');
                }

            }

        </script>
        <!-- email validation -->

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>

    </html>