<?php
    require "header.php";
?>

    <main>
        <div class="wrapper-main">
            <section class="section-default">
                <div class="clock">
                    <span class="clock-time"></span>
                    <span class="clock-ampm"></span>
                </div>
            </section>

            <section class="section-default">
                <?php if (isset($_SESSION['userId'])): ?>
                    <p class="login-status">You are logged in!</p>
                <?php else: ?>
                    <p class="login-status">You are logged out!</p>
                <?php endif ?>
            </section>
        </div>
    </main>
    <script src="Class/DigitalClock.js"></script>

<?php
    require "footer.php";
?>
