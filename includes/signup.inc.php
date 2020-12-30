<?php
    if (isset($_POST['signup-submit'])) {
        require '../Class/dbConnect.php';
        require '../Class/ErrSignUp.php';

//        Instance dbConnect
        $db = new dbConnect(
            'localhost',
            'root',
            '',
            'loginsystem');
        $conn = $db->getConn();
        $db->connFailed();

//      variables from form
        $username = $_POST['uid'];
        $email = $_POST['mail'];
        $password = $_POST['pwd'];
        $passwordRepeat = $_POST['pwd-repeat'];

//        Instance ErrSignUp
        $errSignUp = new errSignUp($username, $email, $password, $passwordRepeat);

//        SignUP Algorithm
        if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
            $errSignUp->errFields();
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $errSignUp->errMailAndUser();
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errSignUp->errMail();
        }
        elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $errSignUp->errUser();
        }
        elseif ($password !== $passwordRepeat) {
           $errSignUp->errPass();
        }
        else {
            $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                $errSignUp->errSql();
            }
            else {
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck > 0) {
                    $errSignUp->userTaken();
                }
                else {
                    $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                       $errSignUp->errSql();
                    }
                    else {
                        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
                        mysqli_stmt_execute($stmt);

                        $errSignUp->successSignUp();
                    }
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    else {
        header("Location: ../signup.php");
        exit();
    }