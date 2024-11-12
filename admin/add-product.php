<?php
    include('../middleware/AdminMiddleware.php');
    include('include/header.php');
?>    
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Product</h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="mb-0">Select Category</label>
                                <select name="category_id" class="form-select" required>
                                    <option selected disabled>Select Category</option>
                                    <?php
                                    $categories = getAll("categories");
                                    if (count($categories) > 0) {
                                        foreach ($categories as $item) {
                                    ?>
                                            <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
                                    <?php
                                        }
                                    } else {
                                        echo "<option disabled>No category available</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-0">Name</label>
                                <input type="text" name="name" placeholder="Enter Product Name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-0">Slug</label>
                                <input type="text" name="slug" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="mb-0">Small Description</label>
                                <textarea rows="3" name="Small_description" placeholder="Enter Small Description" class="form-control" required></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="mb-0">Description</label>
                                <textarea rows="3" name="description" placeholder="Enter Description" class="form-control" required></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-0">Original Price</label>
                                <input type="text" name="original_price" placeholder="Original Price" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-0">Selling Price</label>
                                <input type="text" name="Selling_price" placeholder="Selling Price" class="form-control" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="mb-0">Image</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-0">Quantity</label>
                                <input type="number" name="qty" placeholder="Quantity" class="form-control" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="mb-0">Status</label><br>
                                <input type="checkbox" name="status">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="mb-0">Trending</label><br>
                                <input type="checkbox" name="trending">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="mb-0">Meta Title</label>
                                <input type="text" name="meta_title" placeholder="Enter Meta Title" class="form-control" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="mb-0">Meta Description</label>
                                <textarea rows="3" name="meta_description" placeholder="Enter Meta Description" class="form-control" required></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="mb-0">Meta Keywords</label>
                                <textarea rows="3" name="meta_keywords" placeholder="Enter Meta Keywords" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 mt-3 text-center">
                                <button type="submit" class="btn btn-primary" name="add_product_btn"> Save </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>
