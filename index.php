<?php
    include 'connect.php';
     
    //Login code
     if(isset($_POST['LogIn']))
     {    
          $email = $_POST['email1'];
          $password = $_POST['password1'];
          $password = md5($password);
          $AccountType = $_POST['AccountType'];
          
     
            $sql="SELECT * FROM $AccountType WHERE email='$email' and password='$password'";
            $result = mysqli_query($conn,$sql);
            $result_arr= mysqli_num_rows($result);
            $row  = mysqli_fetch_array($result);
         
            if($result && $result_arr == 1) 
            {
                $_SESSION['email']= $row['email'];
                $_SESSION['name']= $row['name'];
                $_SESSION['phone_no']= $row['phone_no'];
                $_SESSION['birthdate']= $row['birthdate'];
                $_SESSION['status']= $row['status'];
                $_SESSION['gender']= $row['gender'];
                $_SESSION['address']= $row['address'];
                $_SESSION['bp']= $row['bp'];
                $_SESSION['temp']= $row['temp'];
                $_SESSION['weight']= $row['weight'];
                $_SESSION['height']= $row['height'];
                $_SESSION['bloodtype']= $row['bloodtype']; 
                $_SESSION['symptoms']= $row['symptoms']; 
                $_SESSION['user_id']= $row['id']; 
                $_SESSION['doc_tin']= $row['tin_no'];
                $_SESSION['doc_type']= $row['doc_type'];

                
                switch ($AccountType) {
                    case "Admin":
                        header('location: admin_module.php');
                        break;
                    case "Doctor":
                        header('location: doctor_module.php');
                        break;
                    case "Pharmacist":
                        header('location: pharm_module.php');
                        break;
                    case "Nurse":
                        header('location: nurse_module.php');
                        break;
                    case "Receptionist":
                        header('location: receptionist_module.php');
                        break;
                    case "Patient":
                        header('location: patient_module.php');
                        break; 
                    default:
                    header('location: index.php');
                    };   
            } 
             else 
             {
                echo '<script type="text/javascript">alert("Invalid Username or Password or UserType!")</script>';
             }
            
     }
     //Login code


     // SIGNUP PHP CODE
     elseif(isset($_POST['signUp']))
     {    
         $name = mysqli_real_escape_string($conn, $_POST['name']);
         $email = $_POST['email'];
         $password = mysqli_real_escape_string($conn, $_POST['password1']);
         $password = md5($password);
         $AccountType = 'patient';
         $IDType = $_POST['IDType'];
         $IDNumber = $_POST['IDNumber'];
 
            
             $sql_email = "SELECT * FROM $AccountType  WHERE email='$email'";
             $sql_id = "SELECT * FROM $AccountType WHERE IDNumber='$IDNumber' and IDType='$IDType'";
             
             $res_email = $conn->query($sql_email);
             $res_id = $conn->query($sql_id);
 
                 
             if($res_email-> num_rows > 0)
             {
                 echo '<script type="text/javascript">alert("Email already used")</script>';
                 exit();
                 $conn->close();	 
             }
             else if($res_id-> num_rows > 0)
             {
                 echo '<script type="text/javascript">alert("ID already used")</script>';
                 exit();
                 $conn->close();
             }
     
             $sql = "INSERT INTO $AccountType (name, email, password, AccountType, IDType, IDNumber)
             VALUES ('$name', '$email', '$password', '$AccountType', '$IDType', '$IDNumber')";
     
             if ($conn->query($sql) === TRUE) 
             {
                 //header('location: login.html');
                 echo '<script type="text/javascript">alert("Account Created Successfully")</script>';
             } 
             else {
                 echo "Error: " . $sql . "<br>" . $conn->error;
             }
 
         $conn->close();
     } 
     // SIGNUP PHP CODE

?>

<!DOCTYPE html>
<html>

<Head>
    <Title>HMS</Title>
    <link rel="stylesheet" href="style.css" type="text/css">
</Head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="index.php" method="POST">
                <h1>Create Account</h1>
                <input type="text" name="name" placeholder="Name(Surname/First Name/Other Names)" required />
                <input type="email" name="email" placeholder="Email" required/>
                <input type="password" name="password1" id="password" placeholder="Password" required maxlength="10"/>
                <input type="password" name="password2" id="confirm_password" placeholder="Confirm Password" required maxlength="10"/>

                <!-- <select name="AccountType" onchange="showDiv('patient', this)">
                    <option value="Doctor">Doctor</option>
                    <option value="Pharmacist">Pharmacist</option>
                    <option value="Nurse">Nurse</option>
                    <option value="Receptionist">Receptionist</option>
                    <option value="Patient">Patient</option>
                </select> -->

                <select name="IDType" id="patient_reg">
                    <option>NHIS</option>
                    <option>Voter ID</option>
                    <option>Drivers License</option>
                </select>

                <input type="number" name="IDNumber" placeholder="ID Number" maxlength="20">

                <button type="submit" name="signUp" onclick="validatePassword()" >Sign Up</button>
            </form>
        </div>


        <div class="form-container sign-in-container">
            <form action="index.php" method="POST">
                <h1>Sign in</h1>
                <input type="email" placeholder="Email" name="email1" />
                <input type="password" placeholder="Password" name="password1" />

                <select name="AccountType"> <!--onchange="showDiv('hide', this), hideDiv('hide',this)" -->
                    <option selected value="Patient">Patient</option>
                    <option value="Admin">Admin</option>
                    <option value ="Doctor">Doctor</option>
                    <option value="Pharmacist">Pharmacist</option>
                    <option value="Nurse">Nurse</option>
                    <option value="Receptionist">Receptionist</option>
                </select>

                <!-- <input type="number" id="hide" placeholder="Employee ID" name="employee_id"> -->
            
                <a href="# ">Forgot your password?</a>
                <button type="submit " name="LogIn">Log In</button>
            </form>
        </div>
        <div class="overlay-container ">
            <div class="overlay ">
                <div class="overlay-panel overlay-left ">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost " id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right ">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost " id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="javascript.js">
        function validatePassword() {
                var password = document.getElementById("password"),
                    confirm_password = document.getElementById("confirm_password");
                    passwd =  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,10}$/;

                if (password.value != confirm_password.value) {
                    confirm_password.setCustomValidity("Passwords Don't Match");
                } else {
                    confirm_password.setCustomValidity('');
                }

                if(password.value.match(passwd)) 
                    { 
                        password.setCustomValidity('');
                    }
                    else
                    {
                        password.setCustomValidity('Password must between 6 to 10 characters which contain at least one numeric digit and a special character');
                    }

            }
    </script>
</body>

</html>