<?php
    require "header.php";
?>

    <main>
        <div class="wrapper-main">
            <section class="section-default">
                <h1>Signup</h1>
                <?php if (isset($_GET["error"])):?>
                    <?php if ($_GET["error"] == "emptyfields"): ?>
                        <p class="signuperror">Fill in all fields!</p>
                    <?php elseif ($_GET["error"] == "invaliduidmail"): ?>
                        <p class="signuperror">Invalid username and e-mail!</p>
                    <?php elseif ($_GET["error"] == "invaliduid"): ?>
                        <p class="signuperror">Invalid username!</p>
                    <?php elseif ($_GET["error"] == "invalidmail"): ?>
                        <p class="signuperror">Invalid e-mail!</p>
                    <?php elseif ($_GET["error"] == "passwordcheck"): ?>
                        <p class="signuperror">Your password do not match!</p>
                    <?php elseif ($_GET["error"] == "usertaken"): ?>
                        <p class="signuperror">Username is already taken!</p>
                    <?php endif ?>
                <?php elseif (isset($_GET["signup"])): ?>
                    <?php if ($_GET["signup"] == "success"): ?>
                        <p class="signupsuccess">Signup successful!</p>
                    <?php endif ?>
                <?php endif ?>
                <form class="form-signup" action="includes/signup.inc.php" method="post">
                    <input type="text" name="uid" placeholder="Username">
                    <input type="text" name="mail" placeholder="E-mail">
                    <input type="password" name="pwd" placeholder="Password">
                    <input type="password" name="pwd-repeat" placeholder="Repeat Password">
                    <button type="submit" name="signup-submit">Signup</button>
                </form>
            </section>
        </div>
    </main>

<?php
    require "footer.php";
?>
