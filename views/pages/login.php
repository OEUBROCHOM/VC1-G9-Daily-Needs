<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daily Needs Login Form</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@200;300;400;500;600;700&display=swap");
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Open Sans", sans-serif;
    }
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      width: 100%;
      padding: 0 10px;
    }
    body::before {
      content: "";
      position: absolute;
      width: 100%;
      height: 100%;
      background: url("https://img.freepik.com/free-photo/3d-illustration-laptop-with-shopping-basket-paper-bags-online-shopping-e-commerce-concept_58466-14623.jpg?t=st=1741613632~exp=1741617232~hmac=d1db2c8a952fdf327c00d952a63c77ae034cfc3e71c4fd0098e28811885a492c&w=1480"), #000;
      background-position: center;
      background-size: cover;
    }
    .wrapper {
      width: 400px;
      border-radius: 8px;
      padding: 30px;
      text-align: center;
      background: rgba(54, 43, 43, 0.1);
      backdrop-filter: blur(8px);
      color: #fff;
      border: 2px solid rgba(255, 255, 255, 0.5);
      backdrop-filter: blur(8px);
      margin-right: 90px;
    }
    form {
      display: flex;
      flex-direction: column;
    }
    h2 {
      font-size: 2rem;
      margin-bottom: 20px;
      color: #fff;
    }
    .input-field {
      position: relative;
      border-bottom: 2px solid #ccc;
      margin: 15px 0;
      display: flex;
      align-items: center;
    }
    .input-field label {
      position: absolute;
      top: 50%;
      left: 0;
      transform: translateY(-50%);
      color: #fff;
      font-size: 16px;
      pointer-events: none;
      transition: 0.15s ease;
    }
    .input-field input {
      width: 100%;
      height: 40px;
      background: transparent;
      border: none;
      outline: none;
      font-size: 16px;
      color: #fff;
      padding-right: 30px; /* Add padding to the right to create space for the icon */
    }
    .input-field input:focus~label,
    .input-field input:valid~label {
      font-size: 0.8rem;
      top: 10px;
      transform: translateY(-120%);
    }
    .input-field i {
      color: #fff;
      font-size: 18px;
      margin-left: 10px; /* Space between input and icon */
    }
    .forget {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin: 25px 0 35px 0;
      color: #fff;
    }
    #remember {
      accent-color: #fff;
    }
    .forget label {
      display: flex;
      align-items: center;
    }
    .forget label p {
      margin-left: 8px;
    }
    .wrapper a {
      color: #efefef;
      text-decoration: none;
    }
    .wrapper a:hover {
      text-decoration: underline;
    }
    button {
      background: #fff;
      color: #000;
      font-weight: 600;
      border: none;
      padding: 12px 20px;
      cursor: pointer;
      border-radius: 3px;
      font-size: 16px;
      border: 2px solid transparent;
      transition: 0.3s ease;
    }
    button:hover {
      color: #fff;
      border-color: #fff;
      background: rgba(255, 255, 255, 0.15);
    }
    .register {
      text-align: center;
      margin-top: 30px;
      color: #fff;
    }
    .register a{
      color: blue;
    }
  </style>
</head>

<body>
  <section class="hero-section">   
    <h1>Hello Login!</h1>
  </section>

  <div class="wrapper">
    <form action="#">
      <h2>Login</h2>
      <div class="input-field">
        <input type="text" required>
        <label>Enter your email</label>
        <i class="fas fa-envelope"></i> <!-- Email icon at the right of input -->
      </div>
      <div class="input-field">
        <input type="password" required>
        <label>Enter your password</label>
        <i class="fas fa-lock"></i> <!-- Password icon at the right of input -->
      </div>
      <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember">
          <p>Remember me</p>
        </label>
        <a href="#">Forgot password?</a>
      </div>
      <button type="submit">Log In</button>
      <div class="register">
        <p>Don't have an account? <a href="/F_register">Register</a></p>
      </div>
    </form>
  </div>
</body>
</html>
