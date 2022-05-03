<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div>
        <h5 class="modal-title p-2 me-2" id="loginMode">Login</h5>
        </div>
        <div><h5 class="modal-title p-2" id="registrationMode">Registrierung</h5></div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      



      <!-- loginForm -->
      <form method="POST" action="dbacess.php" id="loginForm">
        <div class="p-3">
          <div class="form-floating my-3">
            <input type="text" class="form-control" name="user" id="usernameEmailLogin" placeholder="Username oder Email" required>
            <label for="usernameEmailLogin">Username oder Email</label>
          </div>

          <div class="form-floating my-3">
            <input type="password" class="form-control" name="password" id="passwordLogin" placeholder="Passwort" required>
            <label for="passwordLogin">Passwort</label>
          </div>

          <button id="submitLogin" class="btn btn-primary mt-3" type="submit">Einloggen</button>
        </div>
      </form>


      <!-- registrationForm -->
      <form method="POST" action="" class="was-validated">
        <div class="p-3" id="registrationForm">
          <div class="form-floating my-3">
            <input type="text" class="form-control" name="user" id="usernameRegister" placeholder="Username" required>
            <label for="usernameRegister">Username</label>

            <div class="valid-feedback"></div>
            <div class="invalid-feedback"></div>
          </div>

          <div class="form-floating my-3">
            <input type="email" class="form-control" name="email" id="emailRegister" placeholder="Email" required>
            <label for="emailRegister">Email</label>

            <div class="valid-feedback"></div>
            <div class="invalid-feedback"></div>
          </div>

          <div class="form-floating my-3">
            <input type="password" class="form-control" name="password" id="passwordRegister" placeholder="Passwort" required>
            <label for="passwordRegister">Passwort</label>

            <div class="valid-feedback"></div>
            <div class="invalid-feedback"></div>
          </div>

          <div class="form-floating my-3">
            <input type="password" class="form-control" name="repeatPassword" id="repeatPasswortRegister" placeholder="Passwort wiederholen" required>
            <label for="repeatPasswordRegister">Passwort wiederholen</label>

            <div class="valid-feedback"></div>
            <div class="invalid-feedback"></div>
          </div>

          <button id="submitRegister" class="btn btn-primary mt-3" type="submit">Registrieren</button>



        </div>
      </form>

       
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




