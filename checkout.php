<?php 
    include('includes/header.php');
    include('function/user-function.php');
?>
<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a href="index.php" class="text-white m-1">
                <i class="fa-solid fa-house m-1"></i>
                home\ 
            </a>
            <a href="cart.php" class="text-white">
                <i class="fa-solid fa-cart-shopping m-1"></i>
                Pannier\
            </a>
            <a href="checkout.php" class="text-white">
                <i class="fa-solid fa-money-bill m-1"></i>
                Checkout
            </a>
        </h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="card">
            <div class="card-body shadow">
                <form action="function/placeorder.php" method="POST">
                    <div class="row">
                        <div class="col-md-7">
                            <h5>Basic Details</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Name</label>
                                    <input type="text" name="name" placeholder="Enter your full name" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold" >E-mail</label>
                                    <input type="email" name="email" placeholder="Enter your email" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Phone</label>
                                    <input type="text" name="phone" placeholder="Enter your phone number" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Pin Code</label>
                                    <input type="text" name="pincode" placeholder="Enter your pin code" class="form-control" require>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold">Address</label>
                                    <textarea name="address" class="form-control" rows="5" require></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h5> Order Details </h5>
                            <hr>
                            <?php
                                $items = getCartItems();
                            if (!empty($items)) {
                                $Totalprice=0;
                                foreach ($items as $citem) 
                                {
                                ?>
                                    <div class="mb-1 border">
                                        <div class="row align-items-center">
                                            <div class="col-md-2">
                                                <img src="uploads/<?= htmlspecialchars($citem['image']); ?>" class="card-img-top" alt="img" width="60px">
                                            </div>
                                            <div class="col-md-5">
                                                <h5><?= htmlspecialchars($citem['name']); ?></h5>
                                            </div>
                                            <div class="col-md-3">
                                                <h5> <?= htmlspecialchars($citem['selling_price']); ?> Dt</h5>
                                            </div>
                                            <div class="col-md-2">
                                                <h5> x <?= htmlspecialchars($citem['prod_qty']); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                $Totalprice = $Totalprice + ($citem['selling_price'] * $citem['prod_qty']);
                                }
                                
                            }
                            ?>
                            <hr>
                            <h5 class="mt-3">Total Price: <span class="float-end fw-bold"><?= $Totalprice ?> Dt</span></h5>
                            <input type="hidden" name="payment_mode" value="CDO">
                            <button type="submit" name="placeOrderBtn" class="btn btn-primary w-100 mt-2"> Confirm and place order | COD </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php')?>
