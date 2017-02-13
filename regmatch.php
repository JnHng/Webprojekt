<?php

if(isset($_POST["submit"])) {
    $username = $_POST["username"];
    $passwort1 = $_POST["passwort1"];
    $passwort2 = $_POST["passwort2"];
    $email = $_POST["email"];
    $hash = md5($passwort1);



    if (!empty($username) && !empty($passwort1) && !empty($passwort2) && !empty($email) && ($passwort1 == $passwort2)) {



        $register = $db->prepare("SELECT * FROM nutzer WHERE username = :username");
        $register->bindParam(':username', $username, PDO::PARAM_STR);
        $register->execute();
        $new = $register->fetch(PDO::FETCH_ASSOC);

        if($new == true) {
            header('Location: reg-namevergeben.php');
        }

        $sender = $db->prepare("SELECT * FROM nutzer WHERE email = :email");
        $sender->bindParam(':email', $email, PDO::PARAM_STR);
        $sender->execute();
        $neu = $sender->fetch(PDO::FETCH_ASSOC);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: reg-emailfehler');

        if($neu == true) {
            header('Location: reg-emailfehler');
        }

        //new user


        /*$passwort_hash = password_hash($passwort1, PASSWORD_DEFAULT);*/

        try {

            $register = $db->prepare("INSERT INTO nutzer (username, passwort, email)
VALUES(:username,:hash, :email)");
            $register->bindParam(':username', $username, PDO::PARAM_STR);
            $register->bindParam(':hash', $hash, PDO::PARAM_STR);
            $register->bindParam(':email', $email, PDO::PARAM_STR);
            $register->execute();
            // unset($register);

        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }


        if ($register !== false) {
            header('Location: reg-erfolg.php');
        } else {
            echo "Ein Fehler ist aufgetreten!";
        }



    }
    else {
        header('Location: reg-felder.php');
    }
}

?>