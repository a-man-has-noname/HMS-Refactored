<?php
    include 'connect.php';

    if(isset($_POST['update_patient']))
    {
        $temp = $_POST['temp'];
        $bp = $_POST['bp'];
        $bloodtype = $_POST['bloodtype'];
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $symptoms = $_POST['symptoms'];
        $report = $_POST['report'];
        $id = $_SESSION["patient_id"];

        $sql = "UPDATE patient SET temp='$temp', bp='$bp', bloodtype='$bloodtype', weight='$weight', height='$height', symptoms='$symptoms', report='$report' WHERE id = $id";
        if ($conn->query($sql) === TRUE) 
        {
          echo '<script type="text/javascript">alert("Record updated. Changes will be seen on next Login")</script>' ;
        } 
        else {
            echo "Error updating record: " . $conn->error;
        }
        
        
        $conn->close();
    }

    elseif(isset($_POST['update_doc']))
    {
        $doc_name = $_POST['doc_name'];
        $doc_email = $_POST['doc_email'];
        $doc_birthdate = $_POST['doc_birthdate'];
        $doc_status = $_POST['doc_status'];
        $doc_address = $_POST['doc_address'];
        $doc_gender = $_POST['doc_gender'];
        $doc_type = $_POST['doc_type'];
        $phone_no = $_POST['doc_phone'];
        $doc_tin_no = $_SESSION['doc_tin'];
        $id = $_SESSION['user_id'];

        $sql = "UPDATE doctor SET name='$doc_name', phone_no = '$phone_no', email='$doc_email', birthdate='$doc_birthdate', status='$doc_status', address='$doc_address', gender='$doc_gender', doc_type='$doc_type' WHERE id = $id";
        if ($conn->query($sql) === TRUE) 
        {
          echo '<script type="text/javascript">alert("Record updated. Changes will be seen on next Login")</script>' ;
        } 
        else {
            echo "Error updating record: " . $conn->error;
        }

        $sql_emp = "UPDATE employees SET name='$doc_name', email='$doc_email', birthdate='$doc_birthdate', status='$doc_status', address='$doc_address', gender='$doc_gender' WHERE tin_no = $doc_tin_no";
        if ($conn->query($sql_emp) === TRUE) 
        {
          echo '<script type="text/javascript">alert("All Done")</script>' ;
        } 
        else {
            echo "Error updating record: " . $conn->error;
        }
        
        
        $conn->close();
    }

    elseif(isset($_POST['prescribe']))
    {
        $prescription = $_POST['prescription'];
        $pres_date = $_POST['pres_date'];
        $doc_id = $_SESSION['user_id'];
        $doc_name = $_SESSION['name'];
        $patient_to = $_SESSION["patient_name"];

        $sql = "INSERT INTO prescription (pres_details, pat_adminis_to, pres_date, doc_name, doc_id)
        VALUES ('$prescription', '$patient_to', '$pres_date', '$doc_name', '$doc_id')";
        if ($conn->query($sql) === TRUE) 
        {
          echo '<script type="text/javascript">alert("Prescription Given")</script>' ;
        } 
        else {
            echo "Error updating record: " . $conn->error;
        }
        
        
        $conn->close();
    }

    elseif(isset($_GET['hello'])) 
    {
        $_SESSION['checker'] = '1';
    }else{ $_SESSION['checker'] = '0'; }
    



    
?>

    <!Doctype html>
    <html>

    <head>

        <title>Doctor(HMS)</title>
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



        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10 bg-light mt-2 rounded">
                    <hr>
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary" onclick="show_hide_patients()">Patients Tab</button>
                        </li>&nbsp;&nbsp;&nbsp;
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary" onclick="show_hide_info()">Info Tab</button>
                        </li>&nbsp;&nbsp;&nbsp;
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary" onclick="show_hide_appoint()">Appointments</button>
                        </li>
                    </ul>
                    <hr>
                    <!-- Live Search patients-->
                    <div id="live_search">
                        <!-- Live Search patients-->
                        <div class="form-inline">
                            <label for="search" class="text-dark">Search Patients</label>&nbsp;&nbsp;&nbsp;
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
                        <!-- Live Search patients-->

                        <!-- Attend to-->
                        <hr>
                        <!--patient info content-->
                        <form method="POST" id="patient_form" action="doctor_module.php">
                            <!--Name and email-->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Name</span>
                                    </div>
                                    <input type="text" name="name" disabled class="form-control" value="<?php echo $_SESSION["patient_name"]?>" aria-label="Username" aria-describedby="basic-addon1">&nbsp;&nbsp;&nbsp;
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Email</span>
                                    </div>
                                    <input type="text" name="email" disabled class="form-control" value="<?php echo $_SESSION["patient_email"]?>" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <!--Name and email-->

                                <!--birthdate and gender-->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Birthdate</span>
                                    </div>
                                    <input type="date" disabled name="birthdate" value="<?php echo $_SESSION["patient_birthdate"]?>" min="1957-01-01" max="2020-12-31">&nbsp;&nbsp;&nbsp;
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Gender</span>
                                    </div>
                                    <select name="gender" disabled>
                                        <option selected><?php echo $_SESSION["patient_gender"]?></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <!--birthdate and gender-->

                                <!--BP Temp Bloodtype-->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Bp</span>
                                    </div>
                                    <input type="text" name="bp" class="form-control" value="<?php echo $_SESSION["patient_bp"]?>" aria-label="Username" aria-describedby="basic-addon1">&nbsp;&nbsp;&nbsp;
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Temp</span>
                                    </div>
                                    <input type="text" name="temp" class="form-control" value="<?php echo $_SESSION["patient_temp"]?>" aria-label="Username" aria-describedby="basic-addon1">&nbsp;&nbsp;&nbsp;
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Blood Type</span>
                                    </div>
                                    <input type="text" name="bloodtype" class="form-control" value="<?php echo $_SESSION["patient_bloodtype"]?>" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <!--BP Temp Bloodtype-->

                                <!--Weight and Height-->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Weight</span>
                                    </div>
                                    <input type="text" name="weight" class="form-control" value="<?php echo $_SESSION["patient_weight"]?>" aria-label="Username" aria-describedby="basic-addon1">&nbsp;&nbsp;&nbsp;
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Height</span>
                                    </div>
                                    <input type="text" name="height" class="form-control" value="<?php echo $_SESSION["patient_height"]?>" aria-label="Username" aria-describedby="basic-addon1">&nbsp;&nbsp;&nbsp;
                                </div>
                                <!--Weight and Height-->

                                <!--Symptoms and Doctor's Report-->
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Symptoms</span>
                                    </div>
                                    <textarea class="form-control" name="symptoms" aria-label="With textarea"><?php echo $_SESSION["patient_symptoms"]?> </textarea>&nbsp;&nbsp;&nbsp;
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Report</span>
                                    </div>
                                    <textarea class="form-control" name="report" aria-label="With textarea"><?php echo $_SESSION["patient_report"]?> </textarea>
                                </div>
                                <br>
                                <!--Symptoms and Doctor's Report-->
                                <button type="submit" name="update_patient" class="btn btn-primary">Update Info</button>

                                <hr>
                                <!--prescription-->
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Prescription</span>
                                    </div>
                                    <textarea class="form-control" name="prescription" aria-label="With textarea"></textarea>&nbsp;&nbsp;&nbsp;
                                   <div class="input-group-prepend">
                                        <span class="input-group-text">Date</span>
                                    </div>
                                    <input type="date" name="pres_date">
                                </div>
                                <br>
                                <button type="submit" name="prescribe" class="btn btn-primary">Prescribe Drug</button>
                                <!--prescription-->

                                <br>
                                <hr>
                            <button type="button" class="btn btn-danger" onclick="close_patients()">Close</button>
                        </form>
                        <!--info content-->
                        <!-- Attend to-->
                    </div>
                    <!-- Live Search patients-->

                    <!-- Doc Info-->
                    <div id="doc_info" style="display: none;">
                        <form method="POST" action="doctor_module.php" >
                                <div class="info">

                                    <!--Name and email-->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Name</span>
                                        </div>
                                        <input type="text" name="doc_name" class="form-control" value="<?php echo $_SESSION["name"]?>" aria-label="Username" aria-describedby="basic-addon1">&nbsp;&nbsp;&nbsp;
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Email</span>
                                        </div>
                                        <input type="text" name="doc_email" id="email" class="form-control" value="<?php echo $_SESSION["email"]?>" aria-label="Username" aria-describedby="basic-addon1">&nbsp;&nbsp;&nbsp;
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Phone Number</span>
                                        </div>
                                        <input type="number" name="doc_phone" value="<?php echo $_SESSION["phone_no"]?>">&nbsp;&nbsp;&nbsp;
                                    </div>
                                    <!--Name and email-->

                                    <!--birthdate and status-->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Birthdate</span>
                                        </div>
                                        <input type="date" name="doc_birthdate" value="<?php echo $_SESSION["birthdate"]?>" min="1957-01-01" max="2020-12-31">&nbsp;&nbsp;&nbsp;
                                        
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Status</span>
                                        </div>
                                        <select name="doc_status">
                                            <option selected><?php echo $_SESSION['status']?></option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                        </select>
                                    </div>
                                    <!--birthdate and status-->

                                    <!--gender and address-->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Address</span>
                                        </div>
                                        <input type="text" name="doc_address" value="<?php echo $_SESSION["address"]?>">&nbsp;&nbsp;&nbsp;
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Gender</span>
                                        </div>
                                        <select name="doc_gender">
                                            <option selected><?php echo $_SESSION['gender']?></option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <!--gender and address-->

                                    <!--Tin no and Doctortype-->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Tin No</span>
                                        </div>
                                        <input type="text" disabled class="form-control" value="<?php echo  $_SESSION['doc_tin']?>" aria-label="Username" aria-describedby="basic-addon1">&nbsp;&nbsp;&nbsp;
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Doc Type</span>
                                        </div>
                                        <input type="text" name="doc_type" class="form-control" value="<?php echo $_SESSION["doc_type"]?>" aria-label="Username" aria-describedby="basic-addon1">&nbsp;&nbsp;&nbsp;
                                    </div>
                                    <!--Tin no and Doctortype-->

                                </div><br>
                                <button type="submit" name="update_doc" class="btn btn-primary" onclick="ValidateEmail()">Update Info</button>
                        </form>
                    </div>
                    <!-- Doc Info-->
                    
                    <!-- CheckAppointments-->
                        <div id="appointments" style="display: none;">
                            <?php
                                $doc_name =$_SESSION['name'];
                                $sql_app = "SELECT * FROM appointments where doc_assigned ='$doc_name' ORDER BY app_date desc";
                                $result = mysqli_query($conn, $sql_app);

                                echo '<table class="table table-hover table light table-striped" id="table-data">';
                                            echo '<thead>';
                                                echo '<tr>';
                                                    echo '<th>Appointment ID</th>';
                                                    echo '<th>By Patient</th>';
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
                                                        echo '<td>'; echo $row['app_pname']; echo'</td>';
                                                        echo '<td>'; echo $row['date_set']; echo'</td>';
                                                        echo '<td>'; echo $row['app_date']; echo '</td>';
                                                        echo '<td>'; echo $row['app_type']; echo '</td>';
                                                        echo '<td>'; echo $row['status']; echo '</td>';
                                                        echo '<td>'; echo $row['doc_assigned']; echo '</td>';
                                                echo '</tr>';
                                            }
                                            
                                        echo '</tbody>';
                                echo '</table>';
                            ?>
                        </div>
                    <!-- CheckAppointments-->


                    <hr>
                </div>
            </div>
        </div>


        <!-- javascript/ajax for live search  -->
        <script type="text/javascript">
            $(document).ready(function() {
                $("#search-text").keyup(function() {
                    var search = $(this).val();
                    $.ajax({
                        url: 'doc_action.php',
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

        <!-- javascript to check click  -->
        <script>
            var check = '<?php echo $_SESSION["checker"];?>';
            var hider = document.getElementById("patient_form");
            if (check == '1') {
                hider.style.display = "block";
            } else {
                hider.style.display = "none";
            }
            function close_patients() {
                if (hider.style.display == "block")
                {
                    hider.style.display = "none";
                }
                
            }
        </script>
        <!-- javascript to check click  -->

        <!-- javascript to hide tabs  -->
        <script>
            function show_hide_patients() {
                var search = document.getElementById("live_search");
                var info = document.getElementById("doc_info");
                var appoint = document.getElementById("appointments");

                info.style.display = "none";
                search.style.display = "block";
                appoint.style.display = "none";
            }

            function show_hide_info() {
                var search = document.getElementById("live_search");
                var info = document.getElementById("doc_info");
                var appoint = document.getElementById("appointments");

                info.style.display = "block";
                search.style.display = "none";
                appoint.style.display = "none";
            }   

            function show_hide_appoint(){
                var search = document.getElementById("live_search");
                var info = document.getElementById("doc_info");
                var appoint = document.getElementById("appointments");

                info.style.display = "none";
                search.style.display = "none";
                appoint.style.display = "block";
            }
        </script>
        <!-- javascript to hide tabs -->

        <!-- email validation -->
        <script>
               function ValidateEmail(){
                var email = document.getElementById("email");
                var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

                if (email.value.match(mailformat)) 
                {
                    email.setCustomValidity('');
                } 
                else
                {
                    email.setCustomValidity('Invalid Email');
                }
            }

        </script>
        <!-- email validation -->

    </body>

    </html>