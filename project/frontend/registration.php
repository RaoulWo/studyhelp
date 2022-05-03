<!DOCTYPE html>
<html lang="de">
<head>
  <title>Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CDN for Bootstrap5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- CDN for Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <!-- CDN for JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Link for own Stylesheet -->
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>

  <!-- Banner Registration -->
  <div class="container-fluid bg-dark p-5 text-light position-relative">
      <h1 class="display-1 text-center bannerHeading">Registrierung</h1>
  </div>

  <!-- Forms -->
  <div class="container-fluid text-dark p-5">
    <form class="was-validated">

      <div class="form-floating my-3">
        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
        <label for="username">Username</label>
        <div class="valid-feedback"></div>
        <div class="invalid-feedback"></div>
      </div>

      <div class="form-floating my-3">
        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
        <label for="email">Email</label>
        <div class="valid-feedback"></div>
        <div class="invalid-feedback"></div>
      </div>

      <div class="form-floating my-3">
        <input type="password" class="form-control" name="password" id="password" placeholder="Passwort" required>
        <label for="password">Passwort</label>
        <div class="valid-feedback"></div>
        <div class="invalid-feedback"></div>
      </div>

      <div class="form-floating my-3">
        <input type="password" class="form-control" name="repeatPassword" id="repeatPasswort" placeholder="Passwort wiederholen" required>
        <label for="repeatPassword">Passwort wiederholen</label>
        <div class="valid-feedback"></div>
        <div class="invalid-feedback"></div>
      </div>

      <button class="btn btn-primary mt-3" type="submit">Registrieren</button>

    </form>
  </div>

  <!-- Footer -->
  <footer class="p-5 bg-dark text-white text-center fixed-bottom">
    <div class="container">
      <p class="lead">Copyright &copy; 2022 Studyhelp</p>
      <a href="#" class="position-absolute bottom-0 end-0 p-5">
        <i class="bi bi-arrow-up-circle h1 text-warning"></i>
      </a>
    </div>
  </footer>

</body>
</html>