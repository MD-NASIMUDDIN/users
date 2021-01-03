<?php
include "inc/header.php";
?>
<!-- dashbord start from here -->
<div class="content-wrapper">



    <!-- users data start from here in row -->
    <div class="row">

        <?php     

        $do=  isset($_GET['do']) ? $_GET['do'] : 'Manage';
        if($do == 'Manage'){
                //view all users
            ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    All Users Information
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone No</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Serial</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone No</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>

                                <!-- read all user info -->
                                <?php 

                                                //3 step
                                $query = "SELECT * FROM users";
                                $result = mysqli_query($db,$query);
                                $i = 0;

                                while($row = mysqli_fetch_assoc($result)){

                                    $u_id       = $row['u_id'];
                                    $u_name     = $row['u_name'];
                                    $u_mail     = $row['u_mail'];
                                    $u_phone    = $row['u_phone'];
                                    $u_pass     = $row['u_pass'];
                                    $u_address  = $row['u_address'];
                                    $u_photo    = $row['u_photo'];
                                    $u_role     = $row['u_role'];
                                    $i++;

                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td>
                                            <img src="img/users/<?php echo $u_photo; ?>" width ="100%">
                                        </td>
                                        <td><?php echo $u_name; ?></td>
                                        <td><?php echo $u_mail; ?></td>
                                        <td><?php echo $u_phone; ?></td>
                                        <td><?php echo $u_address; ?></td>
                                        <td>
                                            <?php 

                                            if($u_role == 1){
                                                echo "<span class='badge badge-danger'>Administrator</span>";
                                            } 
                                            if($u_role == 0){
                                                echo "<span class='badge badge-info'>Subscriber</span>";
                                            }

                                            ?>

                                        </td>


                                        <td>

                                            <a href="" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal<?php echo $u_id;?>">
                                                Edit
                                            </a>

                                            <a href="" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal<?php echo $u_id;?>">
                                                Delete
                                            </a>
                                            
                                        </td>

                                    </tr>

                                    <!-- Modal -->
                                    <div id="myModal<?php echo $u_id?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5>Confirm Action</h5>
                                                    <button style="text-align:right;" type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <!-- <h4 style="text-align:left;" class="modal-title">Modal Header</h4> -->
                                                </div>
                                                <div class="modal-body">
                                                    <center>
                                                        <a href="users.php?do=delete&&deleteId=<?php echo $u_id;?>"><button class="btn-danger btn-sm">delete</button> </a>

                                                        <a href=""><button class="btn-success btn-sm">edit</button></a>
                                                    </center>                  
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <?php
                                }

                                ?>





                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
        } 


    //add new user section start from here 


        else if($do == 'add'){
                //add new users
                ?>

                <div class="card" style="margin-top: 30px;">
                    <div class="card-body">
                     <form action="" method="POST" enctype="multipart/form-data">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                        <label for="text">Full Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="username">
                      </div>
                      <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" placeholder="Enter Email" name="useremail">
                      </div>
                      <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password">
                      </div>
                      <div class="form-group">
                        <label>Repeat Password:</label>
                        <input type="password" class="form-control" placeholder="Enter Repeat Password" name="repeatPassword">
                      </div>
                      
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                        <label>Address:</label>
                        <input type="text" class="form-control" placeholder="Address" name="address">
                      </div>
                      <div class="form-group">
                        <label>Phone:</label>
                        <input type="text" class="form-control" placeholder="Phone" name="phone">
                      </div>
                      <div class="form-group">
                        <label>User Photo:</label>
                        <input type="file" class="form-control" name="image">
                      </div>
                       <div class="form-group">
                        <label>User Role:</label>
                        <select name="user_role" class="form-control">
                            <option value="1">Administrator</option>
                            <option value="0" selected>Subscriber</option>
                            <option value="2">Editor</option>
                        </select>
                        
                      </div>

                      
                      <div class="checkbox">
                        <label><input type="checkbox"> Remember me</label>
                      </div>
                      <button type="submit" class="btn btn-primary" name="addUser">Add New User</button>
                          </div>
                      </div>
                    </form>

                    <!-- add new user -->
                    <?php  

                        if(isset($_POST['addUser'])){
                            $username       = $_POST['username'];
                            $useremail      = $_POST['useremail'];
                            $password       = $_POST['password'];
                            $repeatPassword = $_POST['repeatPassword'];
                            $address        = $_POST['address'];
                            $user_role      = $_POST['user_role'];
                            $phone          = $_POST['phone'];
                            //image
                            $file_name      =$_FILES['image']['name'];
                            $tmp_name       =$_FILES['image']['tmp_name'];
                            // $file_name      =$_FILES['image']['name'];

                            $extension = strtolower(end(explode('.', $_FILES['image']['tmp_name'])));

                            //universal
                            $extensions = array("jpeg","png","jpg");



                           //form validation
                            if(empty($username) || empty($useremail) || empty($password) || empty($repeatPassword) || empty($address) || empty($phone) || empty($file_name)){

                                    echo " <div class='alert alert-danger'>
                                        Please Fill All the Information
                                    </div> ";
                        
                            }else{
                                //user fill all information
                                //check password
                                if($password==$repeatPassword){
                                    //insert data
                                    $hasspassword = sha1($password);

                                    //3 step

                                    //if file type is an image
                                    if (in_array($extension, $extensions)== false) {
                                            //not an image
                                    }else{

                                        //move the image a folder
                                       $random = rand();
                                       $updatedName = $random.$file_name;
                                        //img/user/imagename
                                        move_uploaded_file($tmp_name, "img/users/".$updatedName); 

                                        $query = "INSERT INTO users(u_name,u_mail,u_phone,u_pass,u_address,u_photo,u_role) VALUES ('$username','$useremail','$phone','$hasspassword','$address','$updatedName',$user_role)";

                                    $result = mysqli_query($db,$query);



                                            if($result) {
                                                header('Location: users.php');
                                            }else{
                                                die("Insert user Error!".mysqli_error($db));
                                       


                                        echo " 
                                        <div class='alert alert-danger'>
                                            Please select any jpg,jpeg, or png format image!
                                        </div>
                                         ";
                                    }


                                }else{
                                    echo " <div class='alert alert-danger'>
                                        Password Not Matched!
                                    </div> ";
                                }
                            }
                        

                        }
                    ?>
                    </div>
                </div>
                <?php
        }
        else if($do == 'edit'){
                //edit users  

        }
        else if($do == 'update'){



        }
        else if($do == 'delete'){
                //delete

        }
        ?>
    </div>
    <!-- users data end from here -->



</div> 
<?php
include "inc/footer.php";
?>
