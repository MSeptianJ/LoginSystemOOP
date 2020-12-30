<?php


class errLogIn {
    public function errFields() {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }

    public function errSql()   {
        header("Location: ../index.php?error=sqlerror");
        exit();
    }

    public function errPassword() {
        header("Location: ../index.php?error=wrongpwd");
        exit();
    }

    public function errUser() {
        header("Location: ../index.php?error=nouser");
        exit();
    }

    public function SuccessLogIn() {
        header("Location: ../index.php?login=success");
        exit();
    }
}