<div class="log-w3">
    <div class="w3layouts-main">
        <h2>Sign In Now</h2>
        <form action="/admin-auth/loginStore" method="post">
            <input type="text" class="ggg" name="login" placeholder="Login" required="">
            <input type="password" class="ggg" name="password" placeholder="Password" required="">

            <div class="clearfix"></div>
            <?php if ($error = getFlash('error')):?>
                <div class="alert alert-danger" role="alert">
                    <strong><?php echo $error; ?></strong>
                </div>
            <?php endif; ?>
            <input type="submit" value="Sign In" name="login-btn">
        </form>
        <p>Don't Have an Account ?<a href="/admin-auth/registration">Create an account</a></p>
    </div>
</div>
