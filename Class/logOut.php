<?php


class logOut {

    public function endSession() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../index.php");
    }
}