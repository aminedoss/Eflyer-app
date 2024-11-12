<?php 
    include('includes/header.php');
    include('function/user-function.php');
    if(isset($_GET['no']))
    {
        $tracking_no=$_GET['no'];
        $OrderDT = checkTrackingNoValid($tracking_no);
        if(!$OrderDT) 
        {
            ?>
                <h4> Something went wrong </h4>
            <?php
            die();
        }
    }
    else
    {
        ?>
        <h4> Something went wrong </h4>
        <?php
        die();
    }
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
            <a href="my_order.php" class="text-white">
                <i class="fa-solid fa-border-all m-1"></i>
                My Order\
            </a>
            <a href="#" class="text-white">
                <i class="fa-solid fa-circle-info m-1"></i>
                View Order
            </a>
        </h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <span class="fw-bold text-white fs-4">View Order</span>
                            <a href="my_order.php" class="btn btn-warning float-end">
                                <i class="fa fa-reply m-1"></i>
                                Back
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Delivery Details</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Tracking No. : </label>
                                            <div class="border p-1">
                                                <?=htmlspecialchars($OrderDT['tracking_no']);?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Name : </label>
                                            <div class="border p-1">
                                                <?=htmlspecialchars($OrderDT['name']);?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Email : </label>
                                            <div class="border p-1">
                                                <?=htmlspecialchars($OrderDT['email']);?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Phone : </label>
                                            <div class="border p-1">
                                                <?=htmlspecialchars($OrderDT['phone']);?>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Address : </label>
                                            <div class="border p-1">
                                                <?=htmlspecialchars($OrderDT['address']);?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Zip Code : </label>
                                            <div class="border p-1">
                                                <?=htmlspecialchars($OrderDT['pincode']);?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3>Order Details</h3>
                                    <hr>
                                    <table class="table">
                                        <thead>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                        </thead>
                                        <tbody>                                        
                                            <?php 
                                                $userId = $_SESSION['auth_user']['user_id'];
                                                $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*,oi.qty as order_qty, p.* 
                                                                FROM orders o, order_items oi, products p 
                                                                WHERE o.user_id = :userId AND oi.order_id = o.id 
                                                                AND p.id = oi.prod_id AND o.tracking_no = :tracking_no";

                                                $order_query_stmt = $pdo->prepare($order_query);
                                                $order_query_stmt->execute([':userId' => $userId, ':tracking_no' => $tracking_no]);
                                                $order_items = $order_query_stmt->fetchAll(PDO::FETCH_ASSOC);

                                                if (count($order_items) > 0) {
                                                    foreach ($order_items as $item) {
                                                        ?>
                                                        <tr>
                                                            <td class="align-middle">
                                                                <img src="uploads/<?= htmlspecialchars($item['image']);?>" width="50px" height="50px" alt="<?= htmlspecialchars($item['name']);?>">
                                                                <?= htmlspecialchars($item['name']);?>
                                                            </td>
                                                            <td class="align-middle">
                                                                <?= htmlspecialchars($item['price']);?>
                                                            </td>
                                                            <td class="align-middle">
                                                                <?= htmlspecialchars($item['order_qty']);?>
                                                            </td>
                                                        </tr>
                                                        
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <h5> Total Price: <span class="float-end"> <?=$OrderDT['total_price']?> </span></h5>
                                    <hr>
                                    <label class="fw-bold">Payment Mode : </label>
                                    <div class="border p-1 mb-3">
                                        
                                        <?=htmlspecialchars($OrderDT['payment_mode']);?>
                                    </div>
                                    <label class="fw-bold">Status :</label>
                                    <div class="border p-1 mb-3">
                                        
                                        <?php
                                        htmlspecialchars($OrderDT['payment_mode']);
                                        if($OrderDT['status']==0)
                                        {
                                            echo "Your Order under process";
                                        }else if($OrderDT['status']==1)
                                        {
                                            echo "Complete";
                                        }
                                        else if($OrderDT['status']==2)
                                        {
                                            echo "Canceled";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php')?>
