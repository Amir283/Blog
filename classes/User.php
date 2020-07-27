<?php

class User
{
    public $id;

    public $username;

    public $password;

    
    // authenticate a user, return true if the credentials are correct, null if not

    public static function authenticate($conn, $username, $password)
    {
        $sql = "SELECT *
                FROM user
                WHERE username = :username";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User'); // $user object of class User will be fethched 

        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) { // if there is indeed '$user' object - then return true if the password is correct 
            if ($user->password == $password) {
                return true; 
            }
            else {
                return null; 
            }
        }
    }

}
