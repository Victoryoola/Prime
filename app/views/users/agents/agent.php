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
          <h1 class="heading" data-aos="fade-up">Agent Signup</h1>

          <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
            <ol class="breadcrumb text-center justify-content-center">
              <li class="breadcrumb-item"><a href="index.php" style="text-decoration: none">Home</a></li>
              <li class="breadcrumb-item active text-white-50" aria-current="page">
                SignUp
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <div class="page-content">
    <div class="form-v9-content" style="background: #005555">
      <form class="form-detail" action="<?php echo URLROOT ?>/Estate/register/agent"
        method="POST" enctype="multipart/form-data">
        <h2>Agent Sign Up</h2>
        <p style="margin-left: 45%"><strong class="text-danger">*</strong>Required fields</p>
        <p style="margin-left: 25%"><strong class="text-danger">*</strong>Password must be at least 8 characters and
          must contain a letter</p>
        <div class="form-row-total">
          <div class="form-row">
            <label for="">Full Name <strong class="text-danger">*</strong></label>
            <input type="text" name="name" id="full-name" class="input-text" placeholder="Your Name" required />
          </div>
          <div class="form-row">
            <label for="">Email <strong class="text-danger">*</strong></label>
            <input type="email" name="email" id="your-email" class="input-text" placeholder="Your Email" required />
          </div>
        </div>
        <div class="form-row-total">
          <div class="form-row">
            <label for="">Phone Number <strong class="text-danger">*</strong></label>
            <input type="text" name="phone" id="phone" class="input-text" placeholder="Your Phone Number" required />
          </div>
          <div class="form-row">
            <label for="">Upload CV <strong class="text-danger">*</strong></label>
            <input type="file" name="upload_cv" id="upload" class="input-text" required />
          </div>
        </div>
        <div class="form-row-total">
          <div class="form-row">
            <input type="hidden" name="status" value="2" />
          </div>
          <div class="form-row">
            <input type="hidden" name="form_type" value="agent" />
          </div>
          <div class="form-row">
            <input type="hidden" name="role" value="agent" />
          </div>
        </div>
        <div class="form-row-total">
          <div class="form-row">
            <label for="">Select ID Type <strong class="text-danger">*</strong></label>
            <select name="id_type" id="select" class="form-select mt-3" required>
              <option style="color: #ccc">Select ID Type</option>
              <option class="input-text" value="birth certificate">Birth Certificate</option>
              <option class="input-text" value="driver license">Driver License</option>
              <option class="input-text" value="international passport">International Passport</option>
              <option class="input-text" value="nin">NIN</option>
              <option class="input-text" value="state of origin">State of Origin</option>
            </select>
          </div>
          <div class="form-row">
            <label for="">Upload ID <strong class="text-danger">*</strong></label>
            <input type="file" name="upload_id" id="upload" class="input-text" required />
          </div>
        </div>
        <div class="form-row-total">
          <div class="form-row">
            <label for="">Password</label>
            <input type="password" name="password" id="password" class="input-text" placeholder="Your Password"
              required />
          </div>
          <div class="form-row">
            <label for="">Confirm Password</label>
            <input type="password" name="confirmP" id="confirm-password" class="input-text"
              placeholder="Confirm Password" required />
          </div>
        </div>
        <div class="form-row-last">
          <input type="submit" name="register" class="register" value="Sign Up" />
        </div>
        <div class="form-row-last">
          <label for="button">Already have an account? click here to
            <a href="<?php echo URLROOT ?>/Estate/login"
              style="color: #f25d5d; text-decoration: none;">
              Login
            </a></label>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
require APPROOT . '/views/include/footer.php';
?>
<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
  <script>
    Swal.fire({
      title: 'User Created Successfully!',
      text: 'You can now log in.',
      icon: 'success',
      confirmButtonText: 'Login',
      showCancelButton: true,
      cancelButtonText: 'Stay',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = '<?php echo URLROOT ?>/Estate/login';
      }
    });
  </script>
<?php endif; ?>
<?php if (isset($_GET['error'])): ?>
  <script>
    Swal.fire({
      title: 'Error!',
      text: '<?php echo urldecode($_GET['error']); ?>',
      icon: 'error',
      confirmButtonText: 'Try Again',
      confirmButtonColor: '#d33'
    });
  </script>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>