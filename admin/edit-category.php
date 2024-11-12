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
                $categorie = getById ("categories",$id);
                    if(!empty($categorie)) {
                        foreach ($categorie as $DATA) 
								{
            ?>
                                    <div class="card">
                                        <div class="card-header">
                                            <h4> Edit Category
                                                <a href="category.php" class="btn btn-primary float-end">Back</a>
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="hidden" name="category_id" value="<?= $DATA['id']?>">
                                                        <label for="">Name</label>
                                                        <input type="text" name="name" value="<?= $DATA['name']?>" placeholder="Enter Name Category" class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">Slug</label>
                                                        <input type="text" name="slug" value="<?= $DATA['slug']  ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">Description</label>
                                                        <textarea rows="3" name="description"  placeholder="Enter description" class="form-control"> <?= $DATA['description']  ?></textarea>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">Image</label>
                                                        <input type="file" name="image" class="form-control">
                                                        <label for="">Current Image</label>
                                                        <input type="hidden" name="old_image" value="<?= $DATA['image'] ?>">
                                                        <img src="../uploads/<?= $DATA['image'] ?>" height="50px" wildth="50px" alt="">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">Meta Title</label>
                                                        <input type="text" name="meta_title" value="<?= $DATA['meta_title']  ?>" placeholder="Enter meta title" class="form-control">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">Meta Description</label>
                                                        <textarea rows="3" name="meta_description" placeholder="Enter meta description" class="form-control"> <?= $DATA['meta_description']  ?></textarea>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">Meta keywords</label>
                                                        <textarea rows="3" name="meta_keywords" placeholder="Enter meta description" class="form-control">  <?= $DATA['meta_keywords']  ?></textarea>
                                                    </div>
                                                    <div class="col-md-6 mt-3 text-center">
                                                        <label for="">Status</label>
                                                        <input type="checkbox" <?= $DATA['status'] ? "checked":""?> name="status">
                                                    </div>
                                                    <div class="col-md-6 mt-3 text-center">
                                                        <label for="">Popular</label>
                                                        <input type="checkbox"  <?= $DATA['popular'] ? "checked":""?> name="popular">
                                                    </div>
                                                    <div class="col-md-12 mt-3 text-center">
                                                        <button type="submit" class="btn btn-primary" name="update_category_btn">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                <?php
                            }
                        }
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
