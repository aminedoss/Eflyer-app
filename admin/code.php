<?php
include('../config/dbconn.php');
include('../function/myfunction.php');
if(isset($_POST['add_category_btn']))
    {
        $name = $_POST['name'];
        $slug = $_POST['slug'];
        $description = $_POST['description'];
        $meta_title = $_POST['meta_title'];
        $meta_description = $_POST['meta_description'];
        $meta_keywords = $_POST['meta_keywords'];
        $status = isset($_POST['status']) ? '1' : '0';
        $popular = isset($_POST['popular']) ? '1' : '0';
        $image = $_FILES['image']['name'];
        $path = "../uploads";
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . '.' . $image_ext;
        $cate_query = "INSERT INTO categories (name, slug, description, meta_title, meta_description, meta_keywords, status, popular, image) 
                        VALUES (:name, :slug, :description, :meta_title, :meta_description, :meta_keywords, :status, :popular, :filename)";
        $stmt = $pdo->prepare($cate_query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':slug', $slug);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':meta_title', $meta_title);
        $stmt->bindParam(':meta_description', $meta_description);
        $stmt->bindParam(':meta_keywords', $meta_keywords);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':popular', $popular);
        $stmt->bindParam(':filename', $filename);

        if ($stmt->execute()) {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/'. $filename);
            redirect("add-category.php", "Category Added Successfully");

        } else {
            redirect("add-category.php", "Something Went Wrong");
        }
    }
else if(isset($_POST['update_category_btn']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';
    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];
    if($new_image != "")
        {
            $update_filename=$new_image;
        }
        else
        {
            $update_filename=$old_image;
        }
    $path = "../uploads";
    $update_query = "UPDATE categories SET name=:name, slug=:slug, description=:description, 
    meta_title=:meta_title, meta_description=:meta_description, meta_keywords=:meta_keywords,
    status=:status, popular=:popular, image=:update_filename WHERE id=:category_id";
    $statement = $pdo->prepare($update_query);
    $statement->bindParam(':name', $name);
    $statement->bindParam(':slug', $slug);
    $statement->bindParam(':description', $description);
    $statement->bindParam(':meta_title', $meta_title);
    $statement->bindParam(':meta_description', $meta_description);
    $statement->bindParam(':meta_keywords', $meta_keywords);
    $statement->bindParam(':status', $status);
    $statement->bindParam(':popular', $popular);
    $statement->bindParam(':update_filename', $update_filename);
    $statement->bindParam(':category_id', $category_id);
    $update_query_run = $statement->execute();

    if($update_query_run)
    {
        if($new_image != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$new_image); 
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }
        }
            redirect("edit-category.php?id= $category_id", "Category Updated Successfully");
    }
}
else if(isset($_POST['delete_category_btn']))
{
    $category_id = $_POST['category_id'];
    $category_query = "SELECT * FROM categories WHERE id=:category_id";
    $statement = $pdo->prepare($category_query);
    $statement->bindParam(':category_id', $category_id);
    $statement->execute();
    $category_data = $statement->fetch(PDO::FETCH_ASSOC);
    $image = $category_data['image'];

    $delete_query = "DELETE FROM categories WHERE id=:category_id";
    $statement = $pdo->prepare($delete_query);
    $statement->bindParam(':category_id', $category_id);
    $delete_query_run = $statement->execute();

    if ($delete_query_run)
    {
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }
        //redirect("category.php", "Category deleted Successfully");
        echo 200;
    }
    else{
       // redirect("category.php", "Something went wrong");
         echo 500;
    }
}
elseif(isset($_POST['add_product_btn']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['Small_description'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['Selling_price'];
    $qty = $_POST['qty'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? 1 : 0;
    $trending = isset($_POST['trending']) ? 1 : 0;

    $image = $_FILES['image']['name'];
    $path = "../uploads/";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;



    if($name != "" && $slug !="" && $description != "")
    {
        $product_query = "INSERT INTO products (category_id, name, slug, small_description, description, original_price, selling_price, qty, meta_title, meta_description, meta_keywords, status, trending, image) 
                          VALUES (:category_id, :name, :slug, :small_description, :description, :original_price, :selling_price, :qty, :meta_title, :meta_description, :meta_keywords, :status, :trending, :filename)";
        $stmt = $pdo->prepare($product_query);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':slug', $slug);
        $stmt->bindParam(':small_description', $small_description);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':original_price', $original_price);
        $stmt->bindParam(':selling_price', $selling_price);
        $stmt->bindParam(':qty', $qty);
        $stmt->bindParam(':meta_title', $meta_title);
        $stmt->bindParam(':meta_description', $meta_description);
        $stmt->bindParam(':meta_keywords', $meta_keywords);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':trending', $trending);
        $stmt->bindParam(':filename', $filename);

    if ($stmt->execute()) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . $filename);
        redirect("add-product.php", "Product Added Successfully");
    } else {
        redirect("add-product.php", "Something went wrong");
    }

    }
    
    else
    {
        redirect("add-product.php", "All fields are mandatory");
    }
}

elseif(isset($_POST['update_product_btn']))
{
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['Small_description'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['Selling_price'];
    $qty = $_POST['qty'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? 1 : 0;
    $trending = isset($_POST['trending']) ? 1 : 0;
    $path = "../uploads/";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;
    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];
    if($new_image != "")
        {
            $update_filename=$new_image;
        }
        else
        {
            $update_filename=$old_image;
        }
        
        $update_product_query = "UPDATE products SET category_id=?, name=?, slug=?, small_description=?, description=?, meta_description=?, meta_keywords=?, status=?, trending=?, image=? WHERE id=?";
    $stmt = $pdo->prepare($update_product_query);
    $stmt->execute([$category_id, $name, $slug, $small_description, $description, $meta_description, $meta_keywords, $status, $trending, $update_filename, $product_id]);
        if($stmt)
        {
            if($new_image != "")
            {
                move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$new_image); 
                if(file_exists("../uploads/".$old_image))
                {
                    unlink("../uploads/".$old_image);
                }
            }
            redirect("edit-product.php?id=$product_id", "Product Updated Successfully");
        }
        else{
            redirect("../.php?id=$product_id", "Product Updated Successfully");
        }
}
elseif(isset($_POST['delete_product_btn']))
{
    $product_id = $_POST['product_id'];
    $product_query = "SELECT * FROM products WHERE id=:product_id";
    $statement = $pdo->prepare($product_query);
    $statement->bindParam(':product_id', $product_id);
    $statement->execute();
    $product_data = $statement->fetch(PDO::FETCH_ASSOC);
    $image = $product_data['image'];

    $delete_query = "DELETE FROM products WHERE id=:product_id";
    $statement = $pdo->prepare($delete_query);
    $statement->bindParam(':product_id', $product_id);
    $delete_query_run = $statement->execute();

    if ($delete_query_run)
    {
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }
       // redirect("Products.php", "Category deleted Successfully"); 
       echo 200;
    }
    else{
       // redirect("Products.php", "Something went wrong");
       echo 500;
    }
}
elseif(isset($_POST['Update_Order_btn']))
{
    $track_no=$_POST['tracking_no'];
    $order_status=$_POST['order_status'];
    $query_update_order="UPDATE orders SET status =:order_status WHERE tracking_no=:tracking_no";
    $stmt = $pdo->prepare($query_update_order);
    $stmt->bindParam(':order_status', $order_status, PDO::PARAM_STR);
    $stmt->bindParam(':tracking_no', $track_no, PDO::PARAM_STR);
    $stmt->execute();
    redirect("view-order.php?t=$track_no", "Order status Updated Successfully");
}
elseif(isset($_POST['update_user_btn']))
{
    $Role = $_POST['Role'];
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone_no = $_POST['phone_no'];
    if($Role == "Admin")
        {
            $update_Role= 1;
        }
        else
        {
            $update_Role=0;
        }
        
        $update_user_query = "UPDATE users SET name=?, 	email=?, phone=?, password=?, role_as=? WHERE id=?";
    $stmt = $pdo->prepare($update_user_query);
    $stmt->execute([$name, $email, $phone_no, $password, $update_Role, $user_id]);
        if($stmt)
        {
            redirect("edit-users.php?id=$user_id", "Product Updated Successfully");
        }
        else{
            redirect("../edit-users.php?id=$user_id", "Something went wrong");
        }
}
elseif(isset($_POST['delete_user_btn']))
{
    $user_id = $_POST['user_id'];
    $delete_user_query = "DELETE FROM users WHERE id=:user_id";
    $statement = $pdo->prepare($delete_user_query);
    $statement->bindParam(':user_id', $user_id);
    $delete_user_query_run = $statement->execute();

    if ($delete_user_query_run)
    {
        redirect("All_user.php", "Users deleted Successfully"); 
    }
    else{
        redirect("All_user.php", "Something went wrong");
    }
}
else
{
    header('location : index.php');
}
?>