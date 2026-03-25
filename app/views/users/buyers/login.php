<?php
require APPROOT . '/views/include/header.php';
require APPROOT . '/views/include/navbar.php';
?>
<div class="form-v9">
    <div class="hero page-inner overlay"
        style="background-image: url('<?php echo URLROOT ?>/Estate/public/images/hero_bg_1.jpg')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading" data-aos="fade-up">Login Page</h1>

                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="<?php echo URLROOT ?>/Estate/" style="text-decoration: none">Home</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">Login</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="form-v9-content" style="background: #005555">
            <form class="form-detail" action="<?php echo URLROOT ?>/Estate/login"
                method="POST" enctype="multipart/form-data">
                <h2>Login Page</h2>
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']) ?></div>
                <?php endif; ?>
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success"><?php echo htmlspecialchars($_GET['success']) ?></div>
                <?php endif; ?>
                <input type="email" name="email" id="your-email" class="input-text" placeholder="Enter An Email"
                    style="text-align: center" required />
                <input type="password" name="password" id="password" class="input-text" placeholder="Enter A Password"
                    style="text-align: center" required />
                <div class="form-row-last">
                    <input type="submit" name="login" class="register" value="Login" />
                </div>
                <div class="form-row-last">
                    <label for="button">Don't have a user account? Click here to
                        <a href="<?php echo URLROOT ?>/Estate/register/buyer"
                            style="color: #f25d5d; text-decoration: none;">Signup</a></label>
                </div>
                <div class="form-row-last">
                    <label for="button">Do you want to be an agent? Click here to
                        <a href="<?php echo URLROOT ?>/Estate/register/agent"
                            style="color: #f25d5d; text-decoration: none;">Signup</a></label>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require APPROOT . '/views/include/footer.php';
?>