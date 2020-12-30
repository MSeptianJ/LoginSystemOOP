<?php


class errSignUp {
    var $username;
    var $email;
    var $password;
    var $passwordRepeat;

    public function __construct($username, $email, $password, $passwordRepeat) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;
    }

    public function errFields() {
        header("Location: ../signup.php?error=emptyfields&uid=".$this->username."&mail=".$this->email);
        exit();
    }

    public function errMailAndUser() {
        header("Location: ../signup.php?error=invalidmailuid");
        exit();
    }

    public function errMail() {
        header("Location: ../signup.php?error=invalidmail&uid=".$this->username);
        exit();
    }

    public function errUser() {
        header("Location: ../signup.php?error=invaliduid&mail=".$this->email);
        exit();
    }
    public function errPass() {
        header("Location: ../signup.php?error=passwordcheck&uid=".$this->username."&mail=".$this->email);
        exit();
    }

    public function errSql() {
        header("Location: ../signup.php?error=sqlerror");
        exit();
    }

    public function userTaken() {
        header("Location: ../signup.php?error=usertaken&mail=".$this->email);
        exit();
    }

    public function successSignUp() {
        header("Location: ../signup.php?signup=success");
        exit();
    }
}