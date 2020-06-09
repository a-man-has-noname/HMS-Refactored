<?php
     include "connect.php";
     
     $output = '';
     $_SESSION["var"] = '0';

     if(isset($_POST['query']))
     {
        $search=$_POST['query'];
        $stmt = $conn->prepare("SELECT * FROM patient where name like concat('%',?,'%') or email like concat('%',?,'%')");
        $stmt->bind_param("ss",$search,$search);
     }
     else
     {
        $stmt=$conn->prepare("Select * FROM patient"); 
     }
     $stmt->execute();
     $result=$stmt->get_result();

     if ($result->num_rows > 0)
     {
         $output = "
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
        <tbody>";
        while($row=$result->fetch_assoc()){
            $output .="
            <tr>
                <td>".$row['id']."</td>
                <td>".$row['name']."</td>
                <td>".$row['email']."</td>
                <td>".$row['birthdate']."</td>
                <td>".$row['status']."</td>
                <td>".$row['gender']."</td>
                <td>".$row['bloodtype']."</td>
                <td><button type='button' class='btn btn-dark' onclick='show()'><a href='nurse_module.php?hello=true'>Attend To</a></button></td>
            </tr>";

            $_SESSION["patient_name"]= $row['name'];
            $_SESSION["patient_email"]= $row['email'];
            $_SESSION["patient_birthdate"]= $row['birthdate'];
            $_SESSION["patient_gender"]= $row['gender'];
            $_SESSION["patient_bloodtype"]= $row['bloodtype'];
            $_SESSION["patient_bp"] = $row['bp'];
            $_SESSION["patient_weight"] = $row['weight'];
            $_SESSION["patient_height"] = $row['height'];
            $_SESSION["patient_temp"] = $row['temp'];
            $_SESSION["patient_symptoms"] = $row['symptoms'];
            $_SESSION["patient_report"] = $row['report'];
            $_SESSION["patient_id"] = $row['id'];
            
        }
        $output .="</tbody>";
        echo $output;



        // echo "<script>
        //         function show()
        //         { 
        //           sessionStorage.setItem('check', 'Shrek');
        //         }
        //      </script>"; 

     }
     else{
         echo "<h3>Data not found</h3>";
     }

?>