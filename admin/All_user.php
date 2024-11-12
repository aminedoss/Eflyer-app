<?php
    include('../middleware/AdminMiddleware.php');
    include('include/header.php');
?>  
    <div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card mt-3">
				<div class="card-header bg-primary">
					<h4 class="text-white text-center"> Users Manger</h4>
				</div>
				<div class="card-body">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>
                            <th>Phone</th>
							<th>Rôle</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						
                        <?php
						
                            $user = getAll("users");
                            if (count($user) > 0) {
                            	foreach ($user as $item) 
								{
                        ?>
                                <tr>
                                    <td><?= $item['id']; ?></td>
                                    <td><?= $item['name']; ?></td>
                                    <td>
                                        <?= $item['email']; ?>
                                    </td>
                                    <td>
                                        <?= $item['phone']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($item['role_as']==1)
                                        {
                                            echo "admin";
                                        }
                                        else
                                        {
                                            echo "client";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="d-grid gap-2 col-6 mx-auto">
                                            <a href="edit-users.php?id=<?= $item['id']; ?>" class="btn btn-primary">Edit</a>
                                        </div>
                                        
                                        <form action="code.php" method="POST">
                                            <div class="d-grid gap-2 col-6 mx-auto">
                                                <input type="hidden" name="user_id" value="<?= $item['id']; ?>">
                                                <button type="submit" class="btn btn-danger mt-2" name="delete_user_btn">Delete</button>
                                            </div>
                                        </form> 
                                            <!--<div class="d-grid gap-2 col-6 mx-auto mt-2">
                                                <button type="submit" class="btn btn-sm btn-danger" name="delete_user_btn" value="<?= $item['id']; ?>">Delete</button>
                                            </div>-->
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
