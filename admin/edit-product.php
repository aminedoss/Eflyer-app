<?php
    include('../middleware/AdminMiddleware.php');
    include('include/header.php');
?>  
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id']))
            {
                $id= $_GET['id'];
                $products = getById ("products",$id);
                    if(!empty($products)) {
                        foreach ($products as $DATA) 
								{
                ?>
            <div class="card">
                <div class="card-header">
                    <h4>Edit Product
                        <a href="Products.php" class="btn btn-primary float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="mb-0">Select Category</label>
                                <select name="category_id" class="form-select mb-2" require>
                                    <option selected> Select Category</option>
                                    <?php
                                    
                                        $categories= getAll("categories");
                                        if(count($categories) > 0)
                                        {
                                            foreach ($categories as $item) {
                                        ?>
                                            <option value="<?= $item['id'] ?>"<?=$DATA['category_id'] == $item['id']?'selected':'' ?> ><?= $item['name'] ?></option>
                                        <?php
                                            }
                                        }
                                        else
                                        {
                                            echo "<option disabled>No category available</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" name="product_id" value="<?= $DATA['id']?>">
                                <label class="mb-0">Name</label>
                                <input type="text" require name="name" value="<?=$DATA['name']?>" placeholder="Enter Name Category" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Slug</label>
                                <input type="text" name="slug"  value="<?=$DATA['slug']?>" class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Small Description</label>
                                <textarea rows="3" require name="Small_description" placeholder="Enter Small description" class="form-control mb-2"> <?=$DATA['small_description'];?> </textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Description</label>
                                <textarea rows="3" require name="description" placeholder="Enter description" class="form-control mb-2"> <?=$DATA['description'];?> </textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">original price</label>
                                <input type="text" require name="original_price" value="<?=$DATA['original_price']?>" placeholder="Original price" class="form-control mb-2l">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Selling price</label>
                                <input type="text" require name="Selling_price" value="<?=$DATA['selling_price']?>" placeholder="Selling price" class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Upload Image</label>
                                <input type="file"  name="image" class="form-control mb-2">
                                <label class="mb-0">Current Image</label>
                                <input type="hidden" name="old_image" value="<?= $DATA['image'] ?>">
                                <img src="../uploads/<?= $DATA['image'] ?>" height="50px" wildth="50px" alt="Product image">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="mb-0">Quantity</label>
                                    <input type="number" require name="qty" value="<?=$DATA['qty']?>" placeholder="Quantity" class="form-control mb-2" require>
                                </div>
                                <div class="col-md-3">
                                    <label class="mb-0">Status</label><br>
                                    <input type="checkbox"  name="status" <?= $DATA['status'] ? "checked":""?>>
                                </div>
                                <div class="col-md-3">
                                    <label class="mb-0">Trending</label><br>
                                    <input type="checkbox" name="trending" <?= $DATA['trending'] ? "checked":""?>>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Meta Title</label>
                                <input type="text" require name="meta_title" value="<?=$DATA['meta_title']?>" placeholder="Enter meta title" class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Meta Description</label>
                                <textarea rows="3" require name="meta_description" placeholder="Enter meta description" class="form-control mb-2"> <?=$DATA['meta_description']?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Meta keywords</label>
                                <textarea rows="3" name="meta_keywords" placeholder="Enter meta description" class="form-control mb-2"> <?=$DATA['meta_keywords']?></textarea>
                            </div>
                            <div class="col-md-12 mt-3 text-center">
                                <button type="submit" class="btn btn-primary" name="update_product_btn"> update </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
                    }}
                    else{
                        echo "id not found ";
                    }
            }
            else
            {
                echo "id missing from URL";
            }
                ?>
        </div>
    </div>
</div>
<?php include('include/footer.php');?>