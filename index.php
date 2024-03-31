<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>

    <div class="modal" tabindex="-1" id="create_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="" id="frm">
                    <input type="hidden" name="action" id="action" value="insert">
                    <input type="hidden" name="id" id="uid" value='0'>
                    <div class="form-group mt-2">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="">Select</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others">Others</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="contact">Contact</label>
                        <input type="text" name="contact" id="contact" class="form-control">
                    </div>
                    <input  type="submit" value="submit" class="btn btn-success mt-2">
                </form>
            </div>
      
            </div>
        </div>
    </div>
    <div class="container">
        <p style="text-align: right" class=" mt-5"> <button class="btn btn-success" id="add_record">Add Records</button></p>
    

    <table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Contact</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="tbody">
    <?php
    $i=0;
        $con=mysqli_connect("localhost","root","","crud");
        $sql="SELECT * FROM user";
        $result=$con->query($sql);
        // print_r($result);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $i++;
              echo "
              <tr uid=$row[id]>
              <td>".($i)."</td>
              <td>$row[name]</td>
              <td>$row[gender]</td>
              <td>$row[contact]</td>
              <td>
              <button class='btn btn-primary btn-sm edit' id=$row[id]>Update</button>
              <button class='btn btn-danger btn-sm delete' id=$row[id]>Delete</button>
              </td>
              ";
            }
        }
    ?>
    </tbody>
    </table>

    </div>

<script src="script.js"></script>
</body>

</html>