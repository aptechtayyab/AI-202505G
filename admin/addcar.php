<?php
require('./adminauth.php');
require('../db.php');


$categories = mysqli_query($con, "SELECT * FROM category");

?>

<?php

if (isset($_POST["btncar"])) {
    $carName = $_POST["carName"];
    $cardesc = $_POST["cardesc"];
    $carrent = $_POST["carrent"];
    $carcategoryid = $_POST["carcategoryid"];
    $carimageName = $_FILES["carImage"]["name"];
    $carimageTempPath = $_FILES["carImage"]["tmp_name"];
    $ext = pathinfo($carimageName,PATHINFO_EXTENSION);
    $carImageNewName = uniqid("car_").".".$ext;
    $mainDirectory = "carimages/".$carImageNewName;

    $isMoved = move_uploaded_file($carimageTempPath,$mainDirectory);
    if($isMoved){
        $res = mysqli_query($con,"INSERT INTO `cars`(`carImage`, `carName`, `carDescription`, `rentPerDay`, `category_id_fk`) VALUES ('$carImageNewName','$carName',' $cardesc',$carrent,'$carcategoryid')");
        if($res){
        echo "<script>window.location.href = 'allcar.php'</script>";

        }
        else{
        echo "Error";

        }
    }
    
}

?>
<?php require('./header.php') ?>
<div class="container">
    <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
            role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h1 class="m-0 font-weight-bold text-primary">Create New Category</h1>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardExample">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" class="form-label">Car Image:</label>
                        <input type="file" name="carImage" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Car Name:</label>
                        <input type="text" name="carName" placeholder="Enter Car Name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Car Description</label>
                        <textarea name="cardesc" placeholder="Enter Description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Car Rent Per Day</label>
                        <input type="number" placeholder="Enter Rent" name="carrent" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Car Category</label>
                        <select name="carcategoryid" class="form-select">
                            <option disabled selected>-- Select Category --</option>
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category["category_id"] ?>"><?php echo $category["category_name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Add Car" name="btncar" class="btn btn-primary mt-2">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require('./footer.php') ?>