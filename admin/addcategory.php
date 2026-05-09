<?php
require('../db.php');
if (isset($_POST['btncat'])) {
    $categoryname = $_POST["categoryname"];
    $res = mysqli_query($con, "INSERT INTO category (category_name) VALUES ('$categoryname')");
    if ($res) {
        echo "<script>window.location.href = 'allcategory.php'</script>";
    }
    else{
        echo "Error";
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
                <form method="post">
                    <div class="form-group">
                        <label for="" class="form-label">Category Name</label>
                        <input type="text" placeholder="Enter Category Name" name="categoryname" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Add Category" name="btncat" class="btn btn-primary mt-2">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require('./footer.php') ?>