<?php 
        $con=mysqli_connect("localhost","root","","crud");
        if(!$con){
            die("Connection failed: " . mysqli_connect_error());
        }

        $action=$_REQUEST['action'];
        if($action=='insert'){
            $name=mysqli_real_escape_string($con,$_POST['name']);
            $gender=$_POST['gender'];
            $contact=$_POST['contact'];
            $query="insert into user (name,gender,contact) values ('$name','$gender','$contact')";
            if($con->query($query)){
                $last_id=$con->insert_id;
                $row_html= "
                <tr uid='$last_id'>
                <td>$last_id</td>
                <td>$name</td>
                <td>$gender</td>
                <td>$contact</td>
                <td>
                <button class='btn btn-primary btn-sm edit' id='update_btn'>Update</button>
                <button class='btn btn-danger btn-sm delete' id='delete_btn'>Delete</button>
                </td>
                ";
                echo json_encode(array("status" => "success", "message" => "Record inserted successfully", "data" => $row_html));
            }
            else{
                echo json_encode(array("status" => "error", "message" => "Error inserting record: " . $con->error));
            }
        }

        else if($action=='update'){
            $id=$_POST['id'];
            $name=mysqli_real_escape_string($con,$_POST['name']);
            $gender=$_POST['gender'];
            $contact=$_POST['contact'];
            $query="UPDATE user SET name='$name',gender='$gender',contact='$contact' WHERE id='$id'";
            if($con->query($query)){
                $row_html= "
                <td>$id</td>
                <td>$name</td>
                <td>$gender</td>
                <td>$contact</td>
                <td>
                <button class='btn btn-primary btn-sm edit' id='update_btn'>Update</button>
                <button class='btn btn-danger btn-sm delete' id='delete_btn'>Delete</button>
                </td>
                ";
                echo json_encode(array("status" => "success", "message" => "Record updated successfully", "data" => $row_html));
        }else{
            echo json_encode(array("status" => "error", "message" => "Error updating record: " . $con->error));
        }
    }
    else if($action=='delete'){
        $id=$_POST['uid'];
        $query="DELETE FROM user where id='$id'";
        if($con->query($query)){
            echo json_encode(array("status" => "success", "message" => "Record deleted successfully"));
        }else{
            echo json_encode(array("status" => "error", "message" => "Error deleting record: " . $con->error));
        }
    }

?>