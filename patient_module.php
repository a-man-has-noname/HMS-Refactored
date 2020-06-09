<?php
    include "connect.php";
    
    // update patient
    if(isset($_POST['update_patient']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone_no = $_POST['phone_no'];
        $birthdate = $_POST['birthdate'];
        $gender = $_POST['gender'];
        $status = $_POST['status'];
        $address = $_POST['address'];
        $id = $_SESSION['user_id'];

        $sql = "UPDATE patient SET name='$name', email='$email', phone_no = '$phone_no', birthdate='$birthdate', status='$status', gender='$gender', address='$address' WHERE id = $id";
        if ($conn->query($sql) === TRUE) 
        {
        //   header('location: admin_module.php');
          echo '<script type="text/javascript">alert("Record updated. Changes will be seen on next Login")</script>' ;
        } 
        else {
            echo "Error updating record: " . $conn->error;
        }
        
        
        $conn->close();
    }
    // update patient

    // appoint
    elseif(isset($_POST['appoint']))
    {
        $appoint_date = $_POST['appoint_date'];
        $appoint_type = $_POST['appoint_type'];
        $patient_name = $_SESSION['name'];
        $date_set = date('Y-m-d');
        $status = 'Pending';
        $doc_assigned = 'None Yet';

        

        $sql = "INSERT INTO appointments (app_pname, app_type, date_set, app_date, status, doc_assigned)
                                 VALUES ('$patient_name', '$appoint_type', '$date_set', '$appoint_date', '$status', '$doc_assigned')";
        if ($conn->query($sql) === TRUE) 
        {
        //   header('location: admin_module.php');
          echo '<script type="text/javascript">alert("Your Appoint has been set. Regularly check appointments to know if Approved")</script>' ;
        } 
        else {
            echo "Error updating record: " . $conn->error;
        }
        
        
        $conn->close();
    }
    // appoint
?>

    <!doctype html>
    <html lang="en">

    <head>
        <title>Patient(HMS)</title>
        <!-- Check and hide -->
        <script>
            function info() {
                var prescriptionForm = document.getElementById("prescription");
                var infoForm = document.getElementById("info");
                var appoints = document.getElementById("appointments");

                prescriptionForm.style.display = "none";
                infoForm.style.display = "block";
                appoints.style.display = "none";
            }

            function pres() {
                var prescriptionForm = document.getElementById("prescription");
                var infoForm = document.getElementById("info");
                var appoints = document.getElementById("appointments");

                infoForm.style.display = "none";
                prescriptionForm.style.display = "block";
                appoints.style.display = "none";
            }

            function appoint() {
                var prescriptionForm = document.getElementById("prescription");
                var infoForm = document.getElementById("info");
                var appoints = document.getElementById("appointments");

                prescriptionForm.style.display = "none";
                infoForm.style.display = "none";
                appoints.style.display = "block";
            }

            function chk_app() {
                var chk_app = document.getElementById("chk_app");
                if (chk_app.style.display == "none")
                {
                    chk_app.style.display = "block";
                }
                
                
                
            }
        </script>
        <!-- Check and hide -->
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>

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
                            <button type="button" class="btn btn-primary" onclick="info()">Info</button>
                        </li>&nbsp;&nbsp;&nbsp;
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary" onclick="pres()">Prescription</button>
                        </li>&nbsp;&nbsp;&nbsp;
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary" onclick="appoint()">Set Appointment</button>
                        </li>
                    </ul>
                    <hr>

                    <!--info content-->
                    <form method="POST" name="patient_add" action="patient_module.php" id="info" style="display: block;">
                        <div class="info">

                            <!--Name and email-->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Name</span>
                                </div>
                                <input type="text" name="name" class="form-control" value="<?php echo $_SESSION["name"]?>" aria-label="Username" aria-describedby="basic-addon1">&nbsp;&nbsp;&nbsp;
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Email</span>
                                </div>
                                <input type="text" name="email" id="email" class="form-control" value="<?php echo $_SESSION["email"]?>" aria-label="Username" aria-describedby="basic-addon1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Phone Number</span>
                                </div>
                                <input type="number" name="phone_no" class="form-control" value="<?php echo $_SESSION['phone_no']?>" aria-label="Username" aria-describedby="basic-addon1">

                            </div>
                            <!--Name and email-->

                            <!--birthdate and status-->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Birthdate</span>
                                </div>
                                <input type="date" name="birthdate" value="<?php echo $_SESSION["birthdate"]?>" min="1957-01-01" max="2020-12-31">&nbsp;&nbsp;&nbsp;
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Status</span>
                                </div>
                                <select name="status">
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
                                <input type="text" name="address" value="<?php echo $_SESSION["address"]?>">&nbsp;&nbsp;&nbsp;
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Gender</span>
                                </div>
                                <select name="gender">
                                        <option selected><?php echo $_SESSION['gender']?></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                            </div>
                            <!--gender and address-->

                            <!--BP Temp Bloodtype-->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Bp</span>
                                </div>
                                <input type="text" disabled class="form-control" value="<?php echo $_SESSION["bp"]?>" aria-label="Username" aria-describedby="basic-addon1">&nbsp;&nbsp;&nbsp;
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Temp</span>
                                </div>
                                <input type="text" disabled class="form-control" value="<?php echo $_SESSION["temp"]?>" aria-label="Username" aria-describedby="basic-addon1">&nbsp;&nbsp;&nbsp;
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Blood Type</span>
                                </div>
                                <input type="text" disabled class="form-control" value="<?php echo $_SESSION["bloodtype"]?>" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <!--BP Temp Bloodtype-->

                            <!--Weight and Height-->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Weight</span>
                                </div>
                                <input type="text" disabled class="form-control" value="<?php echo $_SESSION["weight"]?>" aria-label="Username" aria-describedby="basic-addon1">&nbsp;&nbsp;&nbsp;
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Height</span>
                                </div>
                                <input type="text" disabled class="form-control" value="<?php echo $_SESSION["height"]?>" aria-label="Username" aria-describedby="basic-addon1">&nbsp;&nbsp;&nbsp;
                            </div>
                            <!--Weight and Height-->

                            <!--Symptoms-->
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Symptoms</span>
                                </div>
                                <textarea readonly class="form-control" aria-label="With textarea"><?php echo $_SESSION["symptoms"]?> </textarea>
                            </div>
                            <!--Symptoms-->


                        </div><br>
                        <button type="submit" name="update_patient" class="btn btn-primary" onclick="ValidateEmail()">Update Info</button>
                    </form>
                    <!--info content-->

                    <!--Prescription-->
                    <div id="prescription" style="display: none;">
                        <?php
                                        $patient_name = $_SESSION['name'];
                                        $sql = "SELECT * FROM prescription where pat_adminis_to = '$patient_name' ORDER BY pres_date DESC";
                                        $result = mysqli_query($conn, $sql);

                                        echo '<table class="table table-hover table light table-striped" id="table-data">';
                                                    echo '<thead>';
                                                        echo '<tr>';
                                                            echo '<th>#</th>';
                                                            echo '<th>Details</th>';
                                                            echo '<th>Administered To</th>';
                                                            echo '<th>Prescribed By</th>';
                                                            echo '<th>Date</th>';
                                                        echo '</tr>';
                                                    echo '</thead>';
                                                    echo '<tbody>';
                                                    while($row=$result->fetch_assoc())
                                                    { 
                                                        echo '<tr>';
                                                                echo '<td>'; echo $row['presc_id']; echo'</td>';
                                                                echo '<td>'; echo $row['pres_details']; echo '</td>';
                                                                echo '<td>'; echo $row['pat_adminis_to']; echo '</td>';
                                                                echo '<td>'; echo $row['doc_name']; echo '</td>';
                                                                echo '<td>'; echo $row['pres_date']; echo '</td>';
                                                        echo '</tr>';
                                                    }
                                                    
                                                echo '</tbody>';
                                        echo '</table>';
                                ?>
                    </div>
                    <!--Prescription-->

                    <!--Add appointments-->
                    <form method="POST" id="appointments" style="display: none;" action="patient_module.php">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Date of Appointment</span>
                            </div>
                            <input type="date" name="appoint_date" class="form-control">&nbsp;&nbsp;&nbsp;
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Type of Appointment</span>
                            </div>
                            <select name="appoint_type" class="form-control">
                                        <option>Check Up</option>
                                        <option>Dentist</option>
                                        <option>Eye Appointment</option>
                                        <option>Surgery</option>
                                        <option>Radiology</option>
                                        <option>I am not sure</option>
                                    </select>
                        </div>
                        <button type="submit" name="appoint" class="btn btn-primary">Set Appointment</button>

                        <hr>
                        <!--Check appointments-->
                        <button type="button" class="btn btn-primary" onclick="chk_app()">Check Appointments</button>
                        <br>
                        <div id="chk_app" style="display: none;">
                            <?php
                                $patient_name = $_SESSION['name'];
                                $sql_app = "SELECT * FROM appointments where app_pname = '$patient_name' ORDER BY date_set DESC";
                                $result = mysqli_query($conn, $sql_app);

                                echo '<table class="table table-hover table light table-striped" id="table-data">';
                                            echo '<thead>';
                                                echo '<tr>';
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
                        <hr>
                        <!--Check appointments-->
                    </form>
                    <!--Add appointments-->
                </div>
            </div>
        </div>


        <!-- Optional JavaScript -->

        

        <!-- email validation -->
        <script>
            function ValidateEmail() {
                var email = document.getElementById("email");
                var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

                if (email.value.match(mailformat)) {
                    email.setCustomValidity('');
                } else {
                    email.setCustomValidity('Invalid Email');
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