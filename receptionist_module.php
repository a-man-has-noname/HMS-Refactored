<?php
    include 'connect.php';

    if(isset($_POST['ADD_Patient']))
    {    
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = $_POST['email'];
        $birthdate = $_POST['birthdate'];
        $status = $_POST['Status'];
        $address = $_POST['Address'];
        $gender = $_POST['Gender'];
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password = md5($password);
        $AccountType = 'patient';
        $IDType = $_POST['IDType'];
        $IDNumber = $_POST['IDNumber'];
        // $bp = $_POST['bp'];
        // $temp = $_POST['temp'];
        // $weight = $_POST['weight'];
        // $height = $_POST['height'];

           
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
    
            $sql = "INSERT INTO $AccountType (name, email, password, AccountType, IDType, IDNumber, birthdate, status, gender, address) 
                                     VALUES ('$name', '$email', '$password', '$AccountType', '$IDType', '$IDNumber', '$birthdate', '$status', '$gender', '$address')";
    
            if ($conn->query($sql) === TRUE) 
            {
                header('location: receptionist_module.php');
                // echo '<script type="text/javascript">alert("Patient Added Successfully")</script>';
            } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

        $conn->close();
    } 

    elseif(isset($_POST['ass_btn']))
    {
        $app_id = $_POST['app_id'];
        $doc_name = $_POST['doc_name'];
        $status = 'Approved';

        $sql = "UPDATE appointments SET doc_assigned='$doc_name', status='$status' WHERE app_id ='$app_id'";
        if ($conn->query($sql) === TRUE) 
        {
            echo '<script type="text/javascript">alert("Appointment Set")</script>' ;
        } 
        else {
            echo "Error updating record: " . $conn->error;
        }

        $conn->close();
    }

?>

    <!Doctype html>
    <html>

    <head>

        <title>Receptionist(HMS)</title>

        <style type="text/css">
            body{
                font-family: Arial, sans-serif;
            }
            /* Formatting search box */
            .search-box{
                width: 300px;
                position: relative;
                display: inline-block;
                font-size: 14px;
            }
            .search-box input[type="text"]{
                height: 50px;
                padding: 5px 10px;
                border: 1px solid #CCCCCC;
                font-size: 14px;
            }
            .result{
                position: absolute;        
                z-index: 999;
                top: 100%;
                left: 0;
                background: #f2f2f2;
            }
            .search-box input[type="text"], .result{
                width: 100%;
                box-sizing: border-box;
            }
            /* Formatting result items */
            .result p{
                margin: 0;
                padding: 7px 10px;
                border: 1px solid #CCCCCC;
                border-top: none;
                cursor: pointer;
            }
            .result p:hover{
                background: #CCCCCC;
            }
        </style>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </head>

    <body class='bg-secondary'>

        <!-- nav bar-->
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
        <!-- nav bar-->

        

        <!-- Live Search patients-->
        <div class="container-fluid" id="lv_sr">
            <div class="row justify-content-center">
                <div class="col-md-10 bg-light mt-2 rounded">
                    <hr>
                    <button type="button"  class="btn btn-primary" onclick="search_div()">Live Search</button>
                    <button type="button" id="add-patient" class="btn btn-primary" onclick="hide_div()">Add Patient</button>
                    <button type="button"  class="btn btn-primary" onclick="show_div()">Assign Appointments</button>
                    


                    <!-- Add Patients-->
                    <div class="container-fluid" style="display: none;" id="to_hide">
                        <div class="row justify-content-center">
                            <div class="col-md-10 bg-light mt-2 rounded">
                                <form name="add_form" action="receptionist_module.php" method="POST">
                                    <br>
                                    <!--Name and birthdate-->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Name</span>
                                        </div>
                                        <input type="text" name="name" class="form-control" placeholder="Name(Surname/First Name/Other Names)" aria-label="Username" aria-describedby="basic-addon1"> &nbsp;&nbsp;&nbsp;
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Birthdate</span>
                                        </div>
                                        <input type="date" name="birthdate" value="1999-01-01" min="1957-01-01" max="2020-12-31">
                                    </div>
                                    <!--Name and birthdate-->

                                    <!--ID Type and ID Number-->
                                    <p>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">ID Type</span>
                                            </div>
                                            <select name="IDType">
                                                    <option value="NHIS">NHIS</option>
                                                    <option value="Voters ID">Voter ID</option>
                                                    <option value="Drivers License">Drivers License</option>
                                                </select> &nbsp;&nbsp;&nbsp;
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">ID Number</span>
                                            </div>
                                            <input type="number" class="form-control" name="IDNumber" placeholder="8947382" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </p>
                                    <!--ID Type and ID Number-->

                                    <!--Address and civil status-->
                                    <p>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Civil Status</span>
                                            </div>
                                            <select name="Status">
                                                    <option value="Married">Married</option>
                                                    <option value="Single">Single</option>
                                                </select> &nbsp;&nbsp;&nbsp;
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Address</span>
                                            </div>
                                            <input type="text" class="form-control" name="Address" placeholder="Atasomanso PLT 9 Blk A" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </p>
                                    <!--Address and civil status-->

                                    <!--email and gender-->
                                    <p>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Gender</span>
                                            </div>
                                            <select name="Gender">
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select> &nbsp;&nbsp;&nbsp;
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Email</span>
                                            </div>
                                            <input type="text" class="form-control" required name="email" placeholder="example@gmail.com" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </p>
                                    <!--email and gender-->

                                    <!--Password-->
                                    <p>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Password</span>
                                            </div>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="*****" aria-label="Username" aria-describedby="basic-addon1"> &nbsp;&nbsp;&nbsp;
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Confirm password</span>
                                            </div>
                                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="*****" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </p>
                                    <!--Password-->

                                    <!-- Bp & temp-->
                                    <!-- <p>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" name="bp" id="basic-addon1">BP</span>
                                            </div>
                                            <input type="number" name="bp" class="form-control" placeholder="45" aria-label="Username" aria-describedby="basic-addon1">mmHg &nbsp;&nbsp;&nbsp;
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Temp</span>
                                            </div>
                                            <input type="number" name="temp" class="form-control" placeholder="96" aria-label="Username" aria-describedby="basic-addon1">°C

                                        </div>

                                    </p> -->
                                    <!--Bp and temp

                                    <!--weight and height-->
                                    <!-- <p>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Weight</span>
                                            </div>
                                            <input type="number" name="weight" class="form-control" placeholder="45" aria-label="Username" aria-describedby="basic-addon1">Kg &nbsp;&nbsp;&nbsp;
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Height</span>
                                            </div>
                                            <input type="number" name="height" class="form-control" placeholder="96" aria-label="Username" aria-describedby="basic-addon1">cm

                                        </div>

                                    </p> -->
                                    <!--weight and height-->

                                    <button type="submit" class="btn btn-primary" onclick="validatePassword(); ValidateEmail(document.add_form.email)" name="ADD_Patient">ADD PATIENT</button>
                                    
                                    <hr>

                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Add Patients -->
                    <hr>
                    <div id="searching">
                        <h1 class="text-primary p-2">Live Search Of Patients</h1>
                        <hr>
                        <div class="form-inline">
                            <label for="search" class="font-weight-bold lead text-dark">Search Record</label>&nbsp;&nbsp;&nbsp;
                            <input type="text" name="search" id="search-text" class="form-control form-control-lg rounded-0 border-primary" placeholder="Search...">
                        </div>
                        <hr>
                        <?php
                            $stmt = $conn->prepare("Select * From Patient");
                            $stmt->execute();
                            $result = $stmt->get_result();
                        ?>
                            <table class="table table-hover table light table-striped" id="table-data">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Birthdate</th>
                                        <th>Status</th>
                                        <th>Gender</th>
                                        <th>Blood Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while ($row=$result->fetch_assoc()){ ?>
                                        <tr>
                                            <td>
                                                <?=$row['id']; ?>
                                            </td>
                                            <td>
                                                <?=$row['name']; ?>
                                            </td>
                                            <td>
                                                <?=$row['email']; ?>
                                            </td>
                                            <td>
                                                <?=$row['birthdate']; ?>
                                            </td>
                                            <td>
                                                <?=$row['status']; ?>
                                            </td>
                                            <td>
                                                <?=$row['gender']; ?>
                                            </td>
                                            <td>
                                                <?=$row['bloodtype']; ?>
                                            </td>
                                        </tr>
                                        <?php } 
                                    ?>
                                </tbody>
                            </table>
                    </div>

                        <!-- check appointments -->
                        
                            <div id="chk_app" style="display: none;">
                                <?php
                                    $sql_app = "SELECT * FROM appointments where status ='Pending' ORDER BY date_set ASC";
                                    $result = mysqli_query($conn, $sql_app);

                                    echo '<table class="table table-hover table light table-striped" id="table-data">';
                                                echo '<thead>';
                                                    echo '<tr>';
                                                        echo '<th>Appointment ID</th>';
                                                        echo '<th>Date set</th>';
                                                        echo '<th>Appointment Date</th>';
                                                        echo '<th>Appointment Type</th>';
                                                        echo '<th>Status</th>';
                                                        echo '<th>Assigned To</th>';    
                                                    echo '</tr>';
                                                echo '</thead>';
                                                echo '<tbody>';
                                                while($row=$result->fetch_assoc())
                                                { 
                                                    echo '<tr>';
                                                            echo '<td>'; echo $row['app_id']; echo'</td>';
                                                            echo '<td>'; echo $row['date_set']; echo'</td>';
                                                            echo '<td>'; echo $row['app_date']; echo '</td>';
                                                            echo '<td>'; echo $row['app_type']; echo '</td>';
                                                            echo '<td>'; echo $row['status']; echo '</td>';
                                                            echo '<td>'; echo $row['doc_assigned']; echo '</td>';
                                                            echo '<td>'; echo '<button type="button" onclick="assign()" class="btn btn-primary">Assign Doctor</button>'; echo '</td>';
                                                    echo '</tr>';
                                                }
                                                
                                            echo '</tbody>';
                                    echo '</table>';
                                ?>
                            </div>
                        <!-- check appointments -->

                        <!-- Assign Appointments -->
                            <hr>
                            <div id="assigning" style="display: none;">
                                 <form action="receptionist_module.php" method="POST">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Appointment ID</span>
                                        </div>
                                        <input type="number" name="app_id" class="form-control" placeholder="Appointment ID" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Doctor's Name</span>
                                        </div>
                                        <div class="search-box">
                                        <input type="text" name="doc_name" class="form-control" placeholder="or email" autocomplete="off" placeholder="Search Doctor..." aria-label="Username" aria-describedby="basic-addon1">
                                        <div class="result"></div>
                                    </div><hr>
                                    <button  type="submit" class="btn btn-success" name="ass_btn">Assign</button>&nbsp;&nbsp;&nbsp;  
                                    <button type="button" class="btn btn-danger" onclick="close_div()">Close</button>
                            
                                 </form>
                            </div>
                        <!-- Assign Appointments -->    
                </div>
            </div>
        </div>
        <!-- Live Search patients-->

        

        <!-- javascript/ajax for live search  -->
        <script type="text/javascript">
            $(document).ready(function() {
                $("#search-text").keyup(function() {
                    var search = $(this).val();
                    $.ajax({
                        url: 'reception_module_action.php',
                        method: 'POST',
                        data: {
                            query: search
                        },
                        success: function(response) {
                            $("#table-data").html(response);
                        }
                    });
                });
            });
        </script>
        <!-- javascript/ajax for live search  -->

        <!-- javascript/ajax for add patient  -->
        <script>
            function hide_div() {
                var x = document.getElementById("to_hide");
                var showthis = document.getElementById("chk_app");
                var hidethis = document.getElementById("searching");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    showthis.style.display = "none";
                    hidethis.style.display = "none";
                }
            }

            function show_div(){
                var showthis = document.getElementById("chk_app");
                var x = document.getElementById("to_hide");
                var hidethis = document.getElementById("searching");
                if (showthis.style.display === "none") {
                    showthis.style.display = "block";
                    hidethis.style.display = "none";
                    x.style.display = "none";
                }
            }

            function search_div(){
                var showthis = document.getElementById("chk_app");
                var x = document.getElementById("to_hide");
                var hidethis = document.getElementById("searching");
                if (hidethis.style.display === "none") {
                    hidethis.style.display = "block";
                    showthis.style.display = "none";
                    x.style.display = "none";
                }
            }
        </script>
        <!-- javascript/ajax for add patient  -->

        <!-- javascript/ajax for Assigning appoints  -->
        <script>
            function assign(){
                var show_assignments = document.getElementById("assigning");
                if(show_assignments.style.display == "none"){
                    show_assignments.style.display = "block";
                }
            }

            function close_div()
            {
                var show_assignments = document.getElementById("assigning");
                if(show_assignments.style.display == "block"){
                    show_assignments.style.display = "none";
                }
            }
            

            function search_div(){
                var showthis = document.getElementById("chk_app");
                var x = document.getElementById("to_hide");
                var hidethis = document.getElementById("searching");
                if (hidethis.style.display === "none") {
                    hidethis.style.display = "block";
                    showthis.style.display = "none";
                    x.style.display = "none";
                }
            }
        </script>
        <!-- javascript/ajax for Assigning appoints  -->

         <!-- javascript/ajax for email $ password  -->
         <script>
            function validatePassword(){
                var password = document.getElementById("password"),
                    confirm_password = document.getElementById("confirm_password");
                var passwd = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,10}$/;

                if (password.value != confirm_password.value) {
                    confirm_password.setCustomValidity("Passwords Don't Match");
                }
                else
                {
                    confirm_password.setCustomValidity("");
                }

                if (password.value.match(passwd)) 
                {
                    confirm_password.setCustomValidity('');
                } 
                else
                {
                    confirm_password.setCustomValidity('Password must between 6 to 10 characters which contain at least one numeric digit and a special character');
                }
            }

            function ValidateEmail(inputText)
            {
                var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                if(inputText.value.match(mailformat))
                {
                    document.form1.text1.focus();
                    return true;
                }
                else
                {
                    alert("You have entered an invalid email address!");
                    document.form1.text1.focus();
                    return false;
                }
            }
         </script>
        <!-- javascript/ajax for email $ password  -->

        <!-- javascript/ajax for assign  -->
        <script type="text/javascript">
            $(document).ready(function(){
                $('.search-box input[type="text"]').on("keyup input", function(){
                    /* Get input value on change */
                    var inputVal = $(this).val();
                    var resultDropdown = $(this).siblings(".result");
                    if(inputVal.length){
                        $.get("backend-search.php", {term: inputVal}).done(function(data){
                            // Display the returned data in browser
                            resultDropdown.html(data);
                        });
                    } else{
                        resultDropdown.empty();
                    }
                });
                
                // Set search input value on click of result item
                $(document).on("click", ".result p", function(){
                    $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                    $(this).parent(".result").empty();
                });
            });
        </script>
         <!-- javascript/ajax for assign  -->

    </body>

    </html>