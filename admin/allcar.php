<?php require('./header.php');?>
<?php 
include ('../db.php');
$cars = mysqli_query($con,"SELECT * FROM cars INNER JOIN category ON cars.category_id_fk = category.category_id");

?>
 <!-- Begin Page Content -->
                <div class="container-fluid">

                <div class="container my-3 d-flex justify-content-between align-items-center">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">All Cars</h1>
                    <a href="addcar.php" class="btn btn-primary">Add New Car</a>
                    
                </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                      
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Rent Per Day</th>
                                            <th>Category</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                         <tr>
                                             <th>Image</th>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Actions</th>

                                        </tr>
                                    </tfoot>
                                   <tbody>
                                    <?php foreach($cars as $car){?>
                                        <tr>
                                            <td>
                                                <img src="carimages/<?php echo $car["carImage"]?>" alt="" width="100">
                                            </td>
                                            <td><?php echo $car["carId"]?></td>
                                            <td><?php echo $car["carName"]?></td>
                                            <td><?php echo $car["carDescription"]?></td>
                                            <td><?php echo $car["rentPerDay"]?></td>
                                            <td><?php echo $car["category_name"]?></td>
                                            <td>
                                                <a href="" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                          
                                        </tr>
                                        <?php }?>
                                   </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<?php require('./footer.php');?>