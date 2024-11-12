<?php
    include('includes/header.php');
    include('function/user-function.php');
        if (isset($_GET['product']))
        {
$product_slug= $_GET['product'];
$product=getSlugAcitve("products",$product_slug,$pdo);
if ($product) {
    ?>
    <div class="py-3 bg-primary">
        <div class="container">
            <h6 class="text-white">
                <a class="text-white" href="index.php"> Home /
                </a>
                <a class="text-white" href="index.php"> Collections /
                </a>
                <?= $product['name']; ?></h6>
</div>
</div>
<div class="py-4 bg-light">
    <div class="container mt-3 product_data">
        <div class="row">
            <div class="col-md-4">
                <div class="shadow">
                    <img src="uploads/<?= $product['image']; ?>" alt="Product Image" class="w-100">
                </div>
            </div>
            <div class="col-md-8">
                <h2 class="fw-bold"><?= $product['name']; ?>
                <span class="float-end text-danger"><?php if($product['trending']){echo "Trending";}?></span>
                </h2>
                <hr>
                <p><?= $product['small_description']; ?></p>
                <hr>
                <p><?= $product['description']; ?></p>
                <hr>
                <div class="row text-center">
                    <div class="col-md-6">
                        <h1> Last price = <s class="text-danger"> <?= $product['original_price']; ?> </s></h1>
                    </div>
                    <div class="col-md-6">
                        <h1> Price  = <span class="text-success fw-bold"><?= $product['selling_price']; ?> </span></h1>
                    </div>
                </div>
                <div class="row mt-4 px-4">
                    <div class="input-group mb-3">
                        <button class="input-group-text decrement-btn">-</button>
                        <input type="text" class="form-control text-center bg-white input-qty" value="0" disabled>
                        <button class="input-group-text increment-btn">+</button>
                    </div>
                </div>
                <div class="row mt-3 text-center">
                    <div class="col-md-6">
                        <button class="btn btn-primary px-4 AddToCart-btn" value="<?= $product['id']; ?>"><i class="fa-solid fa-cart-plus me-2"></i> Add to Cart</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-danger px-4"><i class="fa fa-heart me-2"></i> Add to Wishlist</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
   }
   else{
   echo "Something wet wrong";}
}
else
{
    echo "Something wet wrong";
}
include('includes/footer.php')?>