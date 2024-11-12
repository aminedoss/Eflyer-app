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
                Checkout\
            </a>
            <a href="#" class="text-white">
                <i class="fa-solid fa-border-all m-1"></i>
                My Order
            </a>
        </h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanking No</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $orders = getOrders();
                                if(count($orders) > 0)
                                {
                                    foreach ($orders as $item) {
                                    ?>
                                        <tr>
                                            <td><?=$item['id']?></td>
                                            <td><?=$item['tracking_no']?></td>
                                            <td><?=$item['total_price']?></td>
                                            <td><?=$item['created_at']?></td>
                                            <td>
                                                <a href="view-order.php?no=<?=$item['tracking_no']?>" class="btn btn-primary"> View details</a>
                                            </td>
                                        </tr>
                                    <?php    
                                    }
                                }else{
                                    ?>
                                    <tr>
                                        <td colspan="5">No Order yet</td>
                                    </tr>
                                    <?php
                                }
                            ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php')?>
