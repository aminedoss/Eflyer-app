<?php
include('config/dbconn.php');
 function getAllActive($table)
{
    global $pdo;
    $query = "SELECT * FROM $table WHERE status='0'";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
 function getProdTrending()
{
    global $pdo;
    $query = "SELECT * FROM products WHERE trending='1'";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
function getIDAcitve($table, $id) {
    global $pdo;
    $query = "SELECT * FROM $table WHERE id = :id AND status='0'";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
function getSlugAcitve($table, $slug,$pdo) {
    $query = "SELECT * FROM $table WHERE slug = :slug AND status='0' limit 1";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':slug', $slug);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}
function getProdByCat($category_id,$pdo)
{
    $query = "SELECT * FROM products WHERE category_id = :category_id AND status='0' ";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':category_id', $category_id);
    $statement->execute();
    return $statement->fetchALL(PDO::FETCH_ASSOC);

}
function getCartItems()
{
    global $pdo;
    $userId = $_SESSION['auth_user']['user_id'];  
    $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price 
              FROM carts c 
              JOIN products p ON c.prod_id = p.id 
              WHERE c.user_id = :user_id 
              ORDER BY c.id DESC";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getOrders() {
    global $pdo; 
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM orders WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function checkTrackingNoValid($trackingNo)
{
    global $pdo;
    $userId = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM orders WHERE tracking_no = :tracking_no AND user_id = :user_id";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':tracking_no', $trackingNo, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>