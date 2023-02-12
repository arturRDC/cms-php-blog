<?php
include 'includes/header.php';
?>
<?php
include 'includes/db.php';
?>

<!-- Navigation -->
<?php
include 'includes/navbar.php';
?>
<link rel="stylesheet" href="css/login.css">



<div class="div-container">
    <div class="content">
        <h2 class="text-center">Login</h2>
        <hr>
        <form>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary btn-lg" name="login">Login</button>

            <button type="button" class="btn btn-link btn-lg" onclick="location.href='signup.php'">Signup</button>
            <hr>

        </form>
    </div>
</div>