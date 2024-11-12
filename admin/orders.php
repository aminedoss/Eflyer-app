<?php
    include('../middleware/AdminMiddleware.php');
    include('include/header.php');
    
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary">
					<span class="fw-bold text-white fs-4">Orders</span>
                    <a href="order_history.php" class="btn btn-warning float-end">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        Order history
                    </a>
				</div>
				<div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Tanking No</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $orders = getAllOrders();
                                if(count($orders) > 0)
                                {
                                    foreach ($orders as $item) {
                                    ?>
                                        <tr>
                                            <td><?=$item['id']?></td>
                                            <td><?=$item['name']?></td>
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
<?php include('include/footer.php')?>
