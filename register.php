<?php 

include('./db.php');
if(isset($_POST["btnRegister"])){
    $userName = $_POST["userName"];
    $userEmail = $_POST["userEmail"];
    $userPassword = $_POST["userPassword"];
    $ConfirmPassword = $_POST["ConfirmPassword"];
    $filename = $_FILES["userImage"]["name"];
    $fileTempPath = $_FILES["userImage"]["tmp_name"];
    $ext = pathinfo($filename,PATHINFO_EXTENSION);
    $filesize = $_FILES["userImage"]["size"];
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
        $mainDirectory = "admin/userimages/".$NewFileName;
        $isMoved = move_uploaded_file($fileTempPath,$mainDirectory);
        if($isMoved){
            $hashpass = password_hash($userPassword,PASSWORD_DEFAULT);
            $response = mysqli_query($con,"INSERT INTO users (userName,userImage,userEmail,userPassword,role_id_fk) VALUES ('$userName','$NewFileName','$userEmail','$hashpass',3)");

            if($response){
                echo "Data Inserted";
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>

<div class="card-wrap">
  <div class="row g-0">

    <!-- ── Left Banner ── -->
    <div class="col-md-4 banner">
      <div class="banner-tag">Create Account</div>
      <h1>Join Us<br/>Today.</h1>
      <div class="divider-line"></div>
      <p>Fill in your details to create your account and get started with our platform.</p>
      <div class="banner-monogram">R</div>
    </div>

    <!-- ── Right Form ── -->
    <div class="col-md-8 form-side">
      <div class="form-section-title">Personal Info</div>

      <form method="post" enctype="multipart/form-data">
        <div class="row g-3">

          <!-- Full Name -->
          <div class="col-sm-6">
            <label class="form-label">Full Name</label>
            <input
              type="text"
              class="form-control"
              placeholder="e.g. Ali Hassan"
              name="userName"
              maxlength="100"
            />
          </div>

          <!-- Email -->
          <div class="col-sm-6">
            <label class="form-label">Email Address</label>
            <input
              type="email"
              class="form-control"
              placeholder="you@example.com"
              name="userEmail"
              maxlength="255"
            />
          </div>

          <!-- Password -->
          <div class="col-sm-6">
            <label class="form-label">Password</label>
            <div class="pw-wrap">
              <input
                type="password"
                class="form-control"
                placeholder="Min. 8 characters"
                name="userPassword"
                id="pwField"
                maxlength="255"
              />
              <button type="button" class="pw-toggle" onclick="togglePw('pwField','eyeIcon1')" title="Show/Hide">
                <span id="eyeIcon1">👁</span>
              </button>
            </div>
          </div>

          <!-- Confirm Password -->
          <div class="col-sm-6">
            <label class="form-label">Confirm Password</label>
            <div class="pw-wrap">
              <input
                type="password"
                class="form-control"
                placeholder="Repeat password"
                id="pwField2"
                maxlength="255",
                name="ConfirmPassword"
              />
              <button type="button" class="pw-toggle" onclick="togglePw('pwField2','eyeIcon2')" title="Show/Hide">
                <span id="eyeIcon2">👁</span>
              </button>
            </div>
          </div>

          <!-- Role -->
          
          <!-- Profile Image -->
          <div class="col-sm-6">
            <label class="form-label">Profile Image</label>
            <div class="file-upload-wrap">
              <input type="file" name="userImage" accept="image/*" onchange="showFileName(this)"/>
              <div class="file-upload-face" id="fileFace">
                <div class="icon">🖼️</div>
                <strong>Click to upload</strong>
                <span id="fileName">JPG, PNG, WEBP — max 2MB</span>
              </div>
            </div>
          </div>

          <!-- Submit -->
          <div class="col-12 mt-2">
            <input type="submit" class="btn-register" value="Create Account" name="btnRegister">
          </div>

        </div><!-- /row -->
      </form>

      <div class="login-link">
        Already have an account? <a href="#">Sign in</a>
      </div>
    </div><!-- /form-side -->

  </div><!-- /row -->
</div><!-- /card-wrap -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function togglePw(fieldId, iconId) {
    const f = document.getElementById(fieldId);
    const i = document.getElementById(iconId);
    if (f.type === 'password') { f.type = 'text';     i.textContent = '🙈'; }
    else                       { f.type = 'password'; i.textContent = '👁';  }
  }

  function showFileName(input) {
    const el = document.getElementById('fileName');
    el.textContent = input.files.length ? input.files[0].name : 'JPG, PNG, WEBP — max 2MB';
  }
</script>
</body>
</html>