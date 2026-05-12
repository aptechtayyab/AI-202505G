<?php
session_start();
require('./db.php');
if (isset($_POST["btnLogin"])) {
    $userEmail = $_POST["userEmail"];
    $userPassword = $_POST["userPassword"];
    $emailCheckQuery = mysqli_query($con, "SELECT * FROM users WHERE userEmail = '$userEmail'");

    if (mysqli_num_rows($emailCheckQuery) > 0) {
        $userData = mysqli_fetch_assoc($emailCheckQuery);
        $passverify = password_verify($userPassword, $userData["userPassword"]);
        if ($userEmail == $userData["userEmail"] && $passverify) {
            if ($userData["role_id_fk"] == 1) {
                echo "<script>window.location.href = 'admin/index.php'</script>";
                $_SESSION["image"] = $userData["userImage"];
                $_SESSION["name"] = $userData["userName"];
                $_SESSION["email"] = $userData["userEmail"];
                $_SESSION["roleid"] = $userData["role_id_fk"];
            } else if ($userData["role_id_fk"] == 2) {
                echo "<script>window.location.href = 'company/index.php'</script>";
                $_SESSION["image"] = $userData["userImage"];

                $_SESSION["name"] = $userData["userName"];
                $_SESSION["email"] = $userData["userEmail"];
                $_SESSION["roleid"] = $userData["role_id_fk"];
            } else if ($userData["role_id_fk"] == 3) {
                echo "<script>window.location.href = 'index.php'</script>";
                $_SESSION["image"] = $userData["userImage"];

                $_SESSION["name"] = $userData["userName"];
                $_SESSION["email"] = $userData["userEmail"];
                $_SESSION["roleid"] = $userData["role_id_fk"];
            }
        } else {
            echo "Invalid Credentials";
        }
    } else {
        echo "Account not exist!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/register.css">
</head>

<body>

    <div class="card-wrap">
        <div class="row g-0">

            <!-- ── Left Banner ── -->
            <div class="col-md-4 banner">
                <div class="banner-tag">Sign In Account</div>
                <h1>Welcome<br /> Back.</h1>
                <div class="divider-line"></div>
                <div class="banner-monogram">R</div>
            </div>

            <!-- ── Right Form ── -->
            <div class="col-md-8 form-side">
                <div class="form-section-title">Sign in to your account!</div>

                <form method="post" enctype="multipart/form-data">
                    <div class="row g-3">

                        <!-- Full Name -->

                        <!-- Email -->
                        <div class="col-sm-6">
                            <label class="form-label">Email Address</label>
                            <input
                                type="email"
                                class="form-control"
                                placeholder="you@example.com"
                                name="userEmail"
                                maxlength="255" />
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
                                    maxlength="255" />
                                <button type="button" class="pw-toggle" onclick="togglePw('pwField','eyeIcon1')" title="Show/Hide">
                                    <span id="eyeIcon1">👁</span>
                                </button>
                            </div>
                        </div>




                        <!-- Submit -->
                        <div class="col-12 mt-2">
                            <input type="submit" class="btn-register" value="Sign In" name="btnLogin">
                        </div>

                    </div><!-- /row -->
                </form>

                <div class="login-link">
                    Don't have an account? <a href="register.php">Sign Up</a>
                </div>
            </div><!-- /form-side -->

        </div><!-- /row -->
    </div><!-- /card-wrap -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePw(fieldId, iconId) {
            const f = document.getElementById(fieldId);
            const i = document.getElementById(iconId);
            if (f.type === 'password') {
                f.type = 'text';
                i.textContent = '🙈';
            } else {
                f.type = 'password';
                i.textContent = '👁';
            }
        }

        function showFileName(input) {
            const el = document.getElementById('fileName');
            el.textContent = input.files.length ? input.files[0].name : 'JPG, PNG, WEBP — max 2MB';
        }
    </script>
</body>

</html>