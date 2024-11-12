<?php 
    include('includes/header.php');
    include('function/user-function.php');
    if (isset($_GET['category']))
{
$category_slug= $_GET['category'];
$category=getSlugAcitve("categories",$category_slug,$pdo);
if ($category) {
      $category_id = $category['id'];
      $name = $category['name']; 
}}
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

<div class="banner_bg" style="background-image: url('assets/imgs/banner-bg.png');background-size: 100% 100%;">
    <div class="row">
        <div class="col">
            <form class="d-flex mt-5 justify-content-center m-5" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>    
    </div>  
</div> 
<br><br>
<div class="row">
   <h1 class="fashion_taital text-center"> <?= $name?></h1>
   <hr>
</div>
<div class="row p-3">
    <?php
    $products = getProdByCat($category_id,$pdo);
    if (count($products) > 0) {
            foreach ($products as $item) {
                ?>
                <div class="col-md-4 mb-2">
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
<?php include('includes/footer.php')?>