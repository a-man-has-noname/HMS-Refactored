<?php
     include "connect.php";
     $output = '';

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
                </tr>";
        }
        $output .="</tbody>";
        echo $output;
     }
     else{
         echo "<h3>Data not found</h3>";
     }
?>