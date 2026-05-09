<?php 


include('../db.php');
if(isset($_POST["btnCreate"])){
    $userName = $_POST["username"];
    $userEmail = $_POST["useremail"];
    $userPassword = $_POST["userpassword"];
    $ConfirmPassword = $_POST["usercpass"];
    $filename = $_FILES["userimage"]["name"];
    $fileTempPath = $_FILES["userimage"]["tmp_name"];
    $ext = pathinfo($filename,PATHINFO_EXTENSION);
    $filesize = $_FILES["userimage"]["size"];
    $allowedExtension = ["png","jpg","jpeg","avif","gif"];
    $emailCheckRecord = mysqli_query($con,"SELECT * FROM users WHERE userEmail = '$userEmail'");

    if(!in_array($ext,$allowedExtension)){
        echo "File Extension Error";
    }
    else if($filesize >= 2000000){
        echo "File Size must be in 2mb";
    }
    else if($userPassword != $ConfirmPassword){
        echo "Password & Confirm Password does not matched";
    }
    else if(mysqli_num_rows($emailCheckRecord) > 0){
        echo "Account Already Exists";
    }
    else{
        $NewFileName = uniqid("user_").".".$ext;
        $mainDirectory = "userimages/".$NewFileName;
        $isMoved = move_uploaded_file($fileTempPath,$mainDirectory);
        if($isMoved){
            $hashpass = password_hash($userPassword,PASSWORD_DEFAULT);
            $response = mysqli_query($con,"INSERT INTO users (userName,userImage,userEmail,userPassword,role_id_fk) VALUES ('$userName','$NewFileName','$userEmail','$hashpass',3)");

            if($response){
                echo "<script>window.location.href='getusers.php'</script>";
            }
            else{
                echo "Something went wrong";
            }
        }
        else{
            echo "File Upload Error";
        }
    }

}

?>
<?php require('./header.php')?>
<div class="container">
      <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h1 class="m-0 font-weight-bold text-primary">Create New User</h1>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample">
                                    <div class="card-body">
                                       <form method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="" class="form-label">User Name</label>
                                            <input type="text" class="form-control" placeholder="Enter username" name="username">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-label">User Image</label>
                                            <input type="file" class="form-control" placeholder="Enter userimage" name="userimage">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-label">User Email</label>
                                            <input type="email" class="form-control" placeholder="Enter useremail" name="useremail">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-label">User Password</label>
                                            <input type="password" class="form-control" placeholder="Enter userpassword" name="userpassword">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-label">User Confirm Password</label>
                                            <input type="text" class="form-control" placeholder="Enter user confirm password" name="usercpass">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Create User" name="btnCreate" class="btn btn-primary mt-2">
                                        </div>
                                       </form>
                                    </div>
                                </div>
                            </div>
</div>
<?php require('./footer.php')?>