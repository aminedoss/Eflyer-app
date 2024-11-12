<?php 
    include('includes/header.php');
    include('includes/Slider.php');
    include('function/user-function.php');
?>
<?php 
    if(isset($_SESSION['message']))
        {   
?>
            <div class="alert alert-warning alert-dismissible fade show mt-3 justify-content-center m-3" role="alert">
                <strong>Hey !</strong> <?= $_SESSION['message'];?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
<?php 
            unset($_SESSION['message']);
        }
?>
<div class="py-5">
    <div class="container">
        <div class="row">
            <h4 class="fw_bold text-center"> Search Here</h4>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form class="d-flex mt-5 justify-content-center m-5" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
    </div>           
</div>
<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="fw-bold text-center"> 
                        <i class="fa-solid fa-table-cells-large"></i>
                            Trending Product
                    </h4>
                    <hr>
                        <div class="owl-carousel">
                            <?php
                                
                                $Trending_Product = getProdTrending();
                                    if (count($Trending_Product) > 0) 
                                    {
                                            foreach ($Trending_Product as $item) {
                                        ?>
                                            <div class="item">
                                                <a href="product-view.php?product=<?= $item['slug']; ?>" class="">
                                                    <div class="card shadow">
                                                        <div class="card-body">
                                                            <img src="uploads/<?= $item['image']; ?>" alt="Products image" class="w-100"> 
                                                            <h4 class="text-center"><?= $item['name']; ?></h4>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        echo "No data available";
                                        }
                            ?>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    $category=getAllActive("categories");
    if (count($category) > 0) 
    {
        foreach ($category as $items){
            $category_id=$items['id'];
?>
    <div class="py-5 mt-1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <h4 class="fw-bold text-center mt-2"> 
                            <i class="fa-solid fa-table-cells-large"></i>
                                <?= $items['name']; ?>
                        </h4>
                    </div>
                    <div class="owl-carousel mt-2">
                    <?php
                        $products = getProdByCat($category_id,$pdo);
                            if (count($products) > 0) 
                            {
                                foreach ($products as $item) 
                                {
                    ?>
                                    <div class="item">
                                        <a href="product-view.php?product=<?= $item['slug']; ?>" class="">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <img src="uploads/<?= $item['image']; ?>" alt="Products image" class="w-100"> 
                                                        <h4 class="text-center"><?= $item['name']; ?></h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                    <?php
                                }
                            } else {
                                    echo "No data available";
                                    }
                    ?>
                    </div>   
                </div>
            </div>
        </div>
    </div>
<?php
    }
}else {
        echo "No data available";
    }
?>
<div class="py-5 bg-f2">
    <div class="container">
        <div class="card shadow">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="m-3"> About Us: </h4>
                    <div class="underline1 m-3"></div>
                    <p class="m-3"> notre site developer par Med Amine Doss represente un sysème de commerce on ligne .  </p>
                    <p class="m-3"> il regroupe plusieurs produit à plusieurs catégories </p>
                </div>
                <div class="col-md-6">
                    <img src="assets/imgs/shop.jpg" height="500px" width="600px" alt="about">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="py-5 bg-dark">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-3">
                    <img src="assets/imgs/footer-logo.png" alt="footer-logo"><br><br>
                        <a href="index.php" class="text-white mt-2"><i class="fa fa-angle-right"></i>Home</a><br>
                        <a href="categories.php" class="text-white mt-2"><i class="fa fa-angle-right"></i>Our Collection</a><br>
                        <a href="categories.php" class="text-white mt-2"><i class="fa fa-angle-right"></i>My Card</a><br>
                </div>
                <div class="col-md-3">
                    <h4 class="text-white"> Address : </h4>
                    <p class="text-white">
                        Monastir, KsarHellal,  
                    </p>
                    <p class="text-white">
                        Rue arroussi metwi Cité Riath 2 
                    </p>
                    <p class="text-white">
                                5016 
                    </p>
                    <a href="tel:+216 92759771" class="text-white mb-3"><i class="fa fa-phone m-2"></i>+216 92759771</a><br>
                    <a href="Email:d.amine15796@gmail.com" class="text-white mb-3"><i class="fa fa-envelope m-2"></i>Email: d.amine15796@gmail.com</a><br>
                </div>
                <div class="col-md-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d6483.575472563485!2d10.85992999999999!3d35.657601!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2stn!4v1719680019903!5m2!1sfr!2stn" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center mt-5">
                    <a href="https://www.facebook.com/doss.amin/"> <i class="fa-brands fa-facebook fa-2xl m-3"></i> </a>
                    <a href="https://github.com/aminedoss"> <i class="fa-brands fa-github fa-2xl m-3"></i> </a>
                    <a href="https://www.instagram.com/amine_doss15796/"> <i class="fa-brands fa-instagram fa-2xl m-3"></i></a>
                </div>
            </div>
            <div class="row mt-5">
                <hr style="color: white;">
                <div class="w">
                <p class="text-white text-center">© 2024 Company,  All Rights Reserved.</p>
                </div>
            </div>
            
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
?>
<script>
    $(document).ready(function () {
        $('.owl-carousel').owlCarousel({
                loop:true,
                margin:10,
                nav:true,
                responsive:{
                0:{
                items:1
                },
                600:{
                items:3
                },
                1000:{
                items:5
                }
            }
        })
    });
</script>
