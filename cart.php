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
                Pannier
            </a>
        </h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    
                    <?php
                    $items = getCartItems();
                    if(Count($items)>0){
                        ?>
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <h6> Product </h6>
                            </div>
                            <div class="col-md-3">
                                <h6> Price </h6>
                            </div>
                            <div class="col-md-2">
                                <h6> Quantity </h6>
                            </div>
                            <div class="col-md-2">
                                <h6> Remove </h6>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="myCard">
                <?php
                    if (!empty($items)) {
                        foreach ($items as $citem) 
                        {
                            ?>
                                <div class="card shadow-sm mb-2 product_data">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <img src="uploads/<?= htmlspecialchars($citem['image']); ?>" class="card-img-top" alt="img" width="80px">
                                        </div>
                                        <div class="col-md-3">
                                            <h5><?= htmlspecialchars($citem['name']); ?></h5>
                                        </div>
                                        <div class="col-md-3">
                                            <h5> <?= htmlspecialchars($citem['selling_price']); ?> Dt</h5>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="hidden" class="prodId" value="<?= htmlspecialchars($citem['prod_id']); ?>">
                                            <div class="input-group mb-3" style="width: 130px;">
                                                <button class="input-group-text decrement-btn updateQty">-</button>
                                                <input type="text" class="form-control text-center bg-white input-qty" value="<?= htmlspecialchars($citem['prod_qty']); ?>" disabled>
                                                <button class="input-group-text increment-btn updateQty">+</button>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-danger btn-sm deleteItem" value="<?= htmlspecialchars($citem['cid']);?>">
                                                <i class="fa fa-trash me-2"></i>
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                ?>
            </div>
            <div class="text-center mt-3">
                <a href="checkout.php" class="btn btn-outline-primary">
                    <i class="fa-solid fa-money-bill m-2"></i>
                    Proceed to checkout
                </a>
            </div>
            <?php 
                    }
                    else{
                        ?>
                        <div class="card card-body shadow">
                            <h4 class="py-3 text-center"> You card is empty</h4>
                        </div>
                        <?php
                    }
            ?>
        </div>
    </div>
</div>
<?php include('includes/footer.php')?>
