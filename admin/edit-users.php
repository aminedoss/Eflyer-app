<?php
    include('../middleware/AdminMiddleware.php');
    include('include/header.php');
?>  
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id']))
            {
                $id= $_GET['id'];
                $Data_users = getById ("users",$id);
                    if(!empty($Data_users)) {
                        foreach ($Data_users as $users) 
								{
                ?>
            <div class="card">
                <div class="card-header">
                    <h4>Edit Product
                        <a href="All_user.php" class="btn btn-primary float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="mb-0">Select Role</label>
                                <select name="Role" class="form-select mb-2" require>
                                    <option selected> Select Role</option>
                                    <option> Admin </option>
                                    <option> client </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" name="user_id" value="<?= $users['id']?>">
                                <label class="mb-0">Name</label>
                                <input type="text" require name="name" value="<?=$users['name']?>" placeholder="Enter Name Category" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Email</label>
                                <input type="text" name="email"  value="<?=$users['email']?>" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">password</label>
                                <input type="text" require name="password" value="<?=$users['password']?>" placeholder="Original price" class="form-control mb-2l">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Phone Number </label>
                                <input type="number" require name="phone_no" value="<?=$users['phone']?>" placeholder="Selling price" class="form-control mb-2">
                            </div>
                            <div class="col-md-12 mt-3 text-center">
                                <button type="submit" class="btn btn-primary" name="update_user_btn"> update </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
                    }}
                    else{
                        echo "id not found ";
                    }
            }
            else
            {
                echo "id missing from URL";
            }
                ?>
        </div>
    </div>
</div>
<?php include('include/footer.php');?>