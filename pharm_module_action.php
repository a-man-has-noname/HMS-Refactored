<?php
     include "connect.php";
     $output = '';

     if(isset($_POST['query']))
     {
        $search=$_POST['query'];
        $stmt = $conn->prepare("SELECT * FROM prescription where pat_adminis_to like concat('%',?,'%') ");
        $stmt->bind_param("s",$search);
     }
     else
     {
        $stmt=$conn->prepare("Select * From prescription order by pres_date desc"); 
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
                <th>Details</th>
                <th>Doctor Name</th>
                <th>Doctor ID</th>
                <th>Prescription Date</th>
            </tr>
        </thead>
        <tbody>";
        while($row=$result->fetch_assoc()){
            $output .="
            <tr>
                <td>".$row['presc_id']."</td>
                <td>".$row['pat_adminis_to']."</td>
                <td>".$row['pres_details']."</td>
                <td>".$row['doc_name']."</td>
                <td>".$row['doc_id']."</td>
                <td>".$row['pres_date']."</td>
                </tr>";
        }
        $output .="</tbody>";
        echo $output;
     }
     else{
         echo "<h3>Data not found</h3>";
     }
?>