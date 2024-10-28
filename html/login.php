<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Amcor - Login</title>
  <link rel="stylesheet" href="../css/login.css">
</head>
<body>
  <div class="login-container">
    <div class="login-box">
      <div class="logo-container">
        <img src="https://images.ctfassets.net/f7tuyt85vtoa/2wI0s7u2C84sqqSGcq8Iky/bfb518e439a774a48f506d473215cf18/logo-transparent-small-opt.png" alt="Amcor Logo" class="amcor-logo">
      </div>
      <h2>Sign in to your account</h2>
      <form id="loginForm" action="javascript:void(0);">
        <div class="input-group">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required>
        </div>
        <div class="input-group">
          <button type="submit" class="login-btn">Sign In</button>
        </div>
      </form>
      <div class="footer">
        <p>Need help? <a href="#">Contact support</a></p>
      </div>
    </div>
  </div>

  <script>
    document.getElementById("loginForm").addEventListener("submit", function(event) {
      event.preventDefault();

      // Obtener valores de los campos
      const email = document.getElementById("email").value;
      const password = document.getElementById("password").value;

      // Enviar datos usando fetch
      fetch("../php/login_conection.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Redirigir al dashboard si el login es exitoso
          window.location.href = "index.php";
        } else {
          // Mostrar alerta si el login falla
          alert("Correo electrónico o contraseña incorrectos");
        }
      })
      .catch(error => console.error("Error:", error));
    });
  </script>
</body>
</html>
