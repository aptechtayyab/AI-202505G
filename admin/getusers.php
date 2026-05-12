<?php 
include('./adminauth.php');
include ('../db.php');
$users = mysqli_query($con,"SELECT * FROM users INNER JOIN roles ON users.role_id_fk = roles.role_id");

?>
<?php require('./header.php')?>
 <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">All Users</h1>
                   

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
                                            <th>Email</th>
                                            <th>Role</th>
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
                                    <?php foreach($users as $user){?>
                                        <tr>
                                            <td>
                                                <img src="userimages/<?php echo $user["userImage"]?>" alt="" width="100">
                                            </td>
                                            <td><?php echo $user["userId"]?></td>
                                            <td><?php echo $user["userName"]?></td>
                                            <td><?php echo $user["userEmail"]?></td>
                                            <td><?php echo $user["role_name"]?></td>
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