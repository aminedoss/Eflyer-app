<?php
require 'user-function.php';
include('../config/dbconn.php');

session_start(); // Assurez-vous que la session est démarrée

if (isset($_SESSION['auth'])) {
    if (isset($_POST['placeOrderBtn'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pincode = $_POST['pincode'];
        $address = $_POST['address'];
        $payment_mode = $_POST['payment_mode'];
        $payment_id = $_POST['payment_id'];
        
        if ($name == "" || $email == "" || $phone == "" || $pincode == "" || $address == "") {
            $_SESSION['message'] = "All fields mandatory";
            header('location: ../checkout.php');
            exit(0);
        }
        
        $items = getCartItems();
        $Total_price = 0;
        
        foreach ($items as $i) {
            $Total_price += ($i['selling_price'] * $i['prod_qty']);
        }
        
        echo $Total_price;
        
        $tracking_no = "Eflyer" . rand(1111, 9999) . substr($phone, 2);
        $user_id = $_SESSION['auth_user']['user_id'];
        

            $query = "INSERT INTO orders 
                      (tracking_no, user_id, name, email, phone, address, pincode, total_price, payment_mode, payment_id) 
                      VALUES 
                      (:tracking_no, :user_id, :name, :email, :phone, :address, :pincode, :total_price, :payment_mode, :payment_id)";
            
            $stmt = $pdo->prepare($query);

            // Liaison des paramètres
            $stmt->bindParam(':tracking_no', $tracking_no);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':pincode', $pincode);
            $stmt->bindParam(':total_price', $Total_price);
            $stmt->bindParam(':payment_mode', $payment_mode);
            $stmt->bindParam(':payment_id', $payment_id);

            if ($stmt->execute()) {
                $order_id = $pdo->lastInsertId();
                foreach ($items as $i) {
                    $prod_id = $i['prod_id'];
                    $prod_qty = $i['prod_qty'];
                    $price = $i['selling_price'];
                    $query_items = "INSERT INTO order_items (order_id, prod_id, qty, price) 
                                    VALUES(:order_id, :prod_id, :prod_qty, :price)";
                    $stmt_items = $pdo->prepare($query_items);
                    $stmt_items->bindParam(':order_id', $order_id);
                    $stmt_items->bindParam(':prod_id', $prod_id);
                    $stmt_items->bindParam(':prod_qty', $prod_qty);
                    $stmt_items->bindParam(':price', $price);
                    $stmt_items->execute();
                    $product_query = "SELECT * FROM products WHERE id = :prod_id LIMIT 1";
                    $product_query_stmt = $pdo->prepare($product_query);
                    $product_query_stmt->bindParam(':prod_id', $prod_id);
                    $product_query_stmt->execute();
                    $productData = $product_query_stmt->fetch(PDO::FETCH_ASSOC);

                    $current_qty = $productData['qty'];

                    $new_qty = $current_qty - $prod_qty;

                    // Update quantity query
                    $updateQty_query = "UPDATE products SET qty = :new_qty WHERE id = :prod_id";
                    $updateQty_query_stmt = $pdo->prepare($updateQty_query);
                    $updateQty_query_stmt->bindParam(':new_qty', $new_qty);
                    $updateQty_query_stmt->bindParam(':prod_id', $prod_id);
                    $updateQty_query_stmt->execute();
                }
            }
            $deleteCartQuery = "DELETE FROM carts WHERE user_id = :user_id";
            $stmt_delete = $pdo->prepare($deleteCartQuery);
            $stmt_delete->bindParam(':user_id', $user_id);
            if ($stmt_delete->execute()) {
             // Suppression réussie
                $_SESSION['message'] = "Order placed successfully";
                header('location: ../my_order.php');
                exit(0);
            } else {
                    echo "Erreur lors de la suppression du panier: ";
                    print_r($stmt_delete->errorInfo());
                }
            
    }
} else {
    header('location: ../index.php');
}
?>

