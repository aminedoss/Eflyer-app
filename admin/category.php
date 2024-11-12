<?php
    include('../middleware/AdminMiddleware.php');
    include('include/header.php');
?>  
    <div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4> Categories</h4>
				</div>
				<div class="card-body">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Image</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						
                        <?php
						
                            $categories = getAll("categories");
                            if (count($categories) > 0) {
                            	foreach ($categories as $item) 
								{
                        ?>
                                <tr>
                                    <td><?= $item['id']; ?></td>
                                    <td><?= $item['name']; ?></td>
                                    <td>
                                        <img src="../uploads/<?= $item['image']; ?>" width="50px" alt="<?= $item['name']; ?>">
                                    </td>
                                    <td>
                                        <?= $item['status'] == '0' ? "Visible" : "Hidden"; ?>
                                    </td>
                                    <td>
                                        <div class="d-grid gap-2 col-6 mx-auto">
                                            <a href="edit-category.php?id=<?= $item['id']; ?>" class="btn btn-primary">Edit</a>
                                        </div>
                                        
                                            <!--<form action="code.php" method="POST">
                                                <div class="d-grid gap-2 col-6 mx-auto">
                                                    <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
                                                    <button type="submit" class="btn btn-danger mt-2" name="delete_category_btn">Delete</button>
                                                </div>
                                            </form> -->
                                            <div class="d-grid gap-2 col-6 mx-auto mt-2">
                                                <button type="button" class="btn btn-sm btn-danger delete_category_btn" value="<?= $item['id']; ?>">Delete</button>
                                            </div>
                                    </td>
                                </tr>
                        <?php
                            	}
                        } else {
                            echo "No records found";
                        }
                        ?>						
					</tbody>
				</table>
			</div>
		</div>
		</div>
	</div>
</div>
<?php include('include/footer.php');?>
