<?php
    if (isset($_POST['login-submit'])) {
        require '../Class/dbConnect.php';
        require '../Class/ErrLogIn.php';

//        Instance dbConnect
        $db = new dbConnect(
            'localhost',
            'root',
            '',
            'loginsystem');
        $conn = $db->getConn();
        $db->connFailed();

//        Instance ErrLogIn
        $errLogIn = new errLogIn();

//        Variables form form
        $mailuid = $_POST['mailuid'];
        $password = $_POST['pwd'];

//        Log In Algorithm
        if (empty($mailuid) || empty($password)) {
            $errLogIn->errFields();
        } else {
            $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                $errLogIn->errSql();
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if ($row = mysqli_fetch_assoc($result)) {
                    $pwdCheck = password_verify($password, $row['pwdUsers']);
                    if ($pwdCheck == false) {
                        $errLogIn->errPassword();
                    } elseif ($pwdCheck == true) {
                        session_start();
                        $_SESSION['userId'] = $row['idUsers'];
                        $_SESSION['userUid'] = $row['uidUsers'];

                        $errLogIn->SuccessLogIn();
                    } else {
                        $errLogIn->errPassword();
                    }
                } else {
                    $errLogIn->errUser();
                }
            }
        }
    } else {
        header("Location: ../index.php");
        exit();
    }