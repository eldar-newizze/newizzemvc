<div class="reg-w3">
    <div class="w3layouts-main">
        <h2>Register Now</h2>
        <form action="/admin-auth/registrationStore" method="post">
            <input type="text" class="ggg" name="name" placeholder="Name" required="required">
            <input type="text" class="ggg" name="login" placeholder="Login" required="required">
            <input type="password" class="ggg" name="password" placeholder="Password" required="required">
            <div class="clearfix"></div>
            <?php if ($error = getFlash('error')):?>
                <div class="alert alert-danger" role="alert">
                    <strong><?php echo $error; ?></strong>
                </div>
            <?php endif; ?>
            <input type="submit" value="registration" name="register">
        </form>
        <p>Already Registered.<a href="/admin-auth/login">Login</a></p>
    </div>
</div>
