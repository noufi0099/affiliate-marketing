<?php
include "db.php";

//insert users to table
function insertUser($name, $email, $parent_id){
    global $conn;

    if ($parent_id==""){
        $sql="INSERT INTO users (name, email, parent_id) VALUES ('$name', '$email', NULL)";
    } else {
        $sql="INSERT INTO users (name, email, parent_id) VALUES ('$name', '$email', $parent_id)";
    }
    $conn->query($sql);
}

//fetching users
function fetchAllUsersRaw(){
    global $conn;
    return $conn->query("SELECT id, name FROM users");
}

function getParentId($user_id){
    global $conn;
    $result = $conn->query( "SELECT parent_id FROM users WHERE id = $user_id" );
    return $result->fetch_assoc();
}

//insert sales to table
function insertSale($user_id, $amount) {
    global $conn;

    $conn->query(
        "INSERT INTO sales (user_id, amount) VALUES ($user_id, $amount)");
        return $conn->insert_id;
}

//insert commission to table
function insertCommission($sale_id, $user_id, $level, $amount) {
    global $conn;
    $conn->query(
        "INSERT INTO commissions (sale_id, user_id, level, commission_amount) VALUES ($sale_id, $user_id, $level, $amount)"
    );
}
