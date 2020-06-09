<?php
    include 'connect.php';

    if(isset($_POST['update_doc']))
    {
        $doc_name = $_POST['doc_name'];
        $doc_email = $_POST['doc_email'];
        $doc_birthdate = $_POST['doc_birthdate'];
        $doc_status = $_POST['doc_status'];
        $doc_address = $_POST['doc_address'];
        $doc_gender = $_POST['doc_gender'];
        $id = $_SESSION['user_id'];
        $doc_tin_no = $_SESSION['doc_tin'];

        $sql = "UPDATE pharmacist SET name='$doc_name', email='$doc_email', birthdate='$doc_birthdate', status='$doc_status', address='$doc_address', gender='$doc_gender' WHERE id = $id";
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
?>

    <!Doctype html>
    <html>

    <head>

        <title>Pharmacist(HMS)</title>
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
                            <button type="button" class="btn btn-primary" onclick="show_hide_patients()">Search Tab</button>
                        </li>&nbsp;&nbsp;&nbsp;
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary" onclick="show_hide_info()">Info Tab</button>
                        </li>
                    </ul>
                    <hr>
                    
                    <!-- Live Search patients with drugs-->
                    <div id="live_search">
                        <div class="form-inline">
                            <label for="search" class="font-weight-bold lead text-dark">Search for Patient</label>&nbsp;&nbsp;&nbsp;
                            <input type="text" name="search" id="search-text" class="form-control form-control-lg rounded-0 border-primary" placeholder="Search...">
                        </div>
                        <hr>
                        <?php
                            $stmt = $conn->prepare("Select * From Prescription order by pres_date desc");
                            $stmt->execute();
                            $result = $stmt->get_result();
                        ?>
                        <table class="table table-hover table light table-striped" id="table-data">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Details</th>
                                    <th>Doctor Name</th>
                                    <th>Doctor ID</th>
                                    <th>Prescription Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while ($row=$result->fetch_assoc()){ ?>
                                    <tr>
                                        <td>
                                            <?=$row['presc_id']; ?>
                                        </td>
                                        <td>
                                            <?=$row['pat_adminis_to']; ?>
                                        </td>
                                        <td>
                                            <?=$row['pres_details']; ?>
                                        </td>
                                        <td>
                                            <?=$row['doc_name']; ?>
                                        </td>
                                        <td>
                                            <?=$row['doc_id']; ?>
                                        </td>
                                        <td>
                                            <?=$row['pres_date']; ?>
                                        </td>
                                    </tr>
                                    <?php } 
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Live Search patients with drugs-->

                    <!-- Pharm info-->
                        <div id="doc_info" style="display: none;">
                            <form method="POST" action="pharm_module.php" >
                                        <div>

                                            <!--Name and email-->
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Name</span>
                                                </div>
                                                <input type="text" name="doc_name" class="form-control" value="<?php echo $_SESSION["name"]?>" aria-label="Username" aria-describedby="basic-addon1">&nbsp;&nbsp;&nbsp;
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Email</span>
                                                </div>
                                                <input type="text" name="doc_email" id="email" class="form-control" value="<?php echo $_SESSION["email"]?>" aria-label="Username" aria-describedby="basic-addon1">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Phone number</span>
                                                </div>
                                                <input type="number" name="phone_no" class="form-control" value="<?php echo $_SESSION["phone_no"]?>" aria-label="Username" aria-describedby="basic-addon1">
                                            
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
                                            </div>
                                            <!--Tin no and Doctortype-->

                                        </div><br>
                                        
                                        <button type="submit" name="update_doc" class="btn btn-primary" onclick="ValidateEmail()">Update Info</button>
                                        <hr>
                                </form>
                        </div>
                    <!-- Pharm info-->

                </div>
            </div>
        </div>

        <!-- javascript/ajax for live search  -->
        <script type="text/javascript">
            $(document).ready(function() {
                $("#search-text").keyup(function() {
                    var search = $(this).val();
                    $.ajax({
                        url: 'pharm_module_action.php',
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


         <!-- javascript/ajax for email-->
         <script>
            function ValidateEmail(inputText)
            {
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
        <!-- javascript/ajax for email -->

        <!-- javascript to hide tabs  -->
        <script>
            function show_hide_patients() {
                var search = document.getElementById("live_search");
                var info = document.getElementById("doc_info");

                info.style.display = "none";
                search.style.display = "block";
            }

            function show_hide_info() {
                var search = document.getElementById("live_search");
                var info = document.getElementById("doc_info");

                info.style.display = "block";
                search.style.display = "none";
            }   
        </script>
        <!-- javascript to hide tabs -->

    </body>

    </html>