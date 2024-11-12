<?php
session_start();
include('../config/dbconn.php');

function getAll($table)
{
    global $pdo;
    $query = "SELECT * FROM $table";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getByID($table, $id) {
    global $pdo;
    $query = "SELECT * FROM $table WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getAllOrders()
{
    global $pdo;
    $query = "SELECT * FROM orders WHERE status='0'";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
function getOrderHistory()
{
    global $pdo;
    $query = "SELECT * FROM orders WHERE status!='0'";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
function redirect($url, $message)
{
    $_SESSION['message'] = $message; 
    header('Location: '.$url);
    exit();
}
function checkTrackingNoValid($trackingNo)
{
    global $pdo;
    $query = "SELECT * FROM orders WHERE tracking_no = :tracking_no";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':tracking_no', $trackingNo, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>