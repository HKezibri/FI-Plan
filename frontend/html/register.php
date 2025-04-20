<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FI-Plan Register</title>
  <link rel="stylesheet" href="../css/auth_style.css" />
  <link rel="stylesheet" href="../css/main_style.css" />
</head>

<body>
  <div class="ring">
    <i style="--clr: #00ff0a"></i>
    <i style="--clr: #ff0057"></i>
    <i style="--clr: #fffd44"></i>
  </div>
  <div class="container">
    <h2>Register</h2>
    <p>Create your account now</p>

    <?php if (isset($_SESSION['register_error'])): ?>
      <p style="color: red;"><?php echo $_SESSION['register_error'];
      unset($_SESSION['register_error']); ?></p>
    <?php endif; ?>

    <form action="../../backend/index.php?action=register" method="POST">
      <div class="input-group">
        <input type="text" name="full_name" placeholder="Full Name" required />
      </div>

      <div class="input-group">
        <input type="email" name="email" placeholder="Email" required />
      </div>

      <div class="input-group">
        <input type="password" name="password" placeholder="Password" required />
      </div>

      <div class="input-group">
        <input type="password" name="confirm_password" placeholder="Confirm Password" required />
      </div>

      <button type="submit" class="submit-btn">Register</button>

      <p class="signin-register-text">
        Already have an account? <a href="login.php">Sign in</a>
      </p>
    </form>
  </div>
</body>

</html>