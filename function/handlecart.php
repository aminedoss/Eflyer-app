<?php
session_start();
include('../config/dbconn.php');

if (isset($_SESSION['auth'])) {
    if (isset($_POST['scope'])) {
        $scope = $_POST['scope'];
        $user_id = $_SESSION['auth_user']['user_id'];

        switch ($scope) {
            case "add":
                $prod_id = $_POST['prod_id'];
                $prod_qty = $_POST['prod_qty'];

                // Vérifier l'existence du produit dans le panier
                $chk_existing = "SELECT * FROM carts WHERE prod_id = :prod_id AND user_id = :user_id";
                $chk_existing_run = $pdo->prepare($chk_existing);
                $chk_existing_run->execute([
                    ':prod_id' => $prod_id,
                    ':user_id' => $user_id
                ]);

                if ($chk_existing_run->rowCount() > 0) {
                    echo "existing";
                } else {
                    // Insérer un nouvel article dans le panier
                    $insert_query = "INSERT INTO carts (user_id, prod_id, prod_qty) VALUES (:user_id, :prod_id, :prod_qty)";
                    $insert_stmt = $pdo->prepare($insert_query);
                    $insert_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $insert_stmt->bindParam(':prod_id', $prod_id, PDO::PARAM_INT);
                    $insert_stmt->bindParam(':prod_qty', $prod_qty, PDO::PARAM_INT);

                    if ($insert_stmt->execute()) {
                        echo 201;
                    } else {
                        echo 500;
                    }
                }
                break;

            case "update":
                $prod_id = $_POST['prod_id'];
                $prod_qty = $_POST['prod_qty'];

                // Vérifier l'existence du produit dans le panier
                $chk_existing_cart = "SELECT * FROM carts WHERE prod_id = :prod_id AND user_id = :user_id";
                $stmt = $pdo->prepare($chk_existing_cart);
                $stmt->bindParam(':prod_id', $prod_id, PDO::PARAM_INT);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    // Mettre à jour la quantité du produit dans le panier
                    $query_update = "UPDATE carts SET prod_qty = :prod_qty WHERE prod_id = :prod_id AND user_id = :user_id";
                    $stmt = $pdo->prepare($query_update);
                    $stmt->bindParam(':prod_qty', $prod_qty, PDO::PARAM_INT);
                    $stmt->bindParam(':prod_id', $prod_id, PDO::PARAM_INT);
                    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

                    if ($stmt->execute()) {
                        echo 200;
                    } else {
                        echo 500;
                    }
                } else {
                    echo "something went wrong";
                }
            break;

            case "delete":
                $cart_id = $_POST['cart_id'];

                // Vérifier l'existence de l'article dans le panier
                $chk_existing_cart = "SELECT * FROM carts WHERE id = :cart_id AND user_id = :user_id";
                $stmt = $pdo->prepare($chk_existing_cart);
                $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    // Supprimer l'article du panier
                    $delete_query = "DELETE FROM carts WHERE id = :cart_id";
                    $stmt = $pdo->prepare($delete_query);
                    $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);

                    if ($stmt->execute()) {
                        echo 200;
                    } else {
                        echo "something went wrong";
                    }
                } else {
                    echo "something went wrong";
                }
                break;

            default:
                echo 500;
        }
    }
} else {
    echo 401;
}
?>
