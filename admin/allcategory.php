<?php 
include ('../db.php');
$categories = mysqli_query($con,"SELECT * FROM category");

?>
<?php require('./header.php')?>
 <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">All Category</h1>
                   

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                      
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                         <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Actions</th>

                                        </tr>
                                    </tfoot>
                                   <tbody>
                                    <?php foreach($categories as $category){?>
                                        <tr>
                                            <td><?php echo $category["category_id"]?></td>
                                            <td><?php echo $category["category_name"]?></td>
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

<?php require('./footer.php')?>