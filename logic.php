<?php
include "queries.php";

    //fetch all users
    function getAllUsers(){

        $result=fetchAllUsersRaw();
        $users=[];

        while($row=$result->fetch_assoc()){
            $users[]=$row;
        }
        return $users;
    }

    // adding user
    function addUserLogic($name, $email, $parent_id){

        if($name=="" || $email==""){
            die("Name and Email are required");
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            die("Invalid email");
        }

        if ($parent_id !="" && !is_numeric($parent_id)){
            die("Invalid parent");
        }

        insertUser($name, $email, $parent_id);
    }

    //sales commision function
    function makeSaleLogic($user_id, $amount){

        $user_id=$user_id;
        $amount=$amount;

        if($user_id<= 0 || $amount<= 0){
            die("Invalid input");
        }

        $sale_id=insertSale($user_id, $amount);

        $rates = [
            1 => 0.10,
            2 => 0.05,
            3 => 0.03,
            4 => 0.02,
            5 => 0.01
        ];

        $current=$user_id;
        $level=1;

        while($level<=5){
            $parent=getParentId($current);

            if(!$parent || $parent['parent_id']==NULL){
                break;
            }
            $pid=$parent['parent_id'];

            if($pid==$current){
                break;
            }
            insertCommission( $sale_id, $pid, $level, $amount * $rates[$level] );
            $current=$pid;
            $level++;
        }
    }




    