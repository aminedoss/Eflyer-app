<?php include('includes/header.php');
  if(isset($_SESSION['auth']))
        {
            $_SESSION['message'] = "you are already Logged In"; 
            header('Location: index.php');
            exit();
        }
?>
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <?php 
                      
                        if(isset($_SESSION['message']))
                        {   
                    ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Hey !</strong> <?= $_SESSION['message'];?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php 
                            unset($_SESSION['message']);
                        }
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <h1> Register </h1>
                        </div>
                        <div class="card-body">
                            <form action="function/code.php" method="post">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter your name ">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="number" name="phone" class="form-control" placeholder="Enter your Phone Number">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="Email" class="form-control" placeholder="Enter your email ">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter your password ">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                                    <input type="password" name="cpassword" class="form-control" placeholder="Confirm your password ">
                                </div>
                                <button type="submit" name="bt_register" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
    
<?php include('includes/footer.php')?>