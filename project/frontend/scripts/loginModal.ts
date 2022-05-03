const FADING_TIME_MS_2: number = 500;

function activateLoginMode(): void {
  $("#loginMode").addClass("activeModeForLoginModal");
  $("#loginMode").removeClass("inactiveModeForLoginModal");
  $("#registrationMode").addClass("inactiveModeForLoginModal");
  $("#registrationMode").removeClass("activeModeForLoginModal");
  fadeOutRegisterForm();
  setTimeout(function() {
    fadeInLoginForm()
  }, FADING_TIME_MS_2);
}

function activateRegistrationMode(): void {
  $("#loginMode").removeClass("activeModeForLoginModal");
  $("#loginMode").addClass("inactiveModeForLoginModal");
  $("#registrationMode").removeClass("inactiveModeForLoginModal");
  $("#registrationMode").addClass("activeModeForLoginModal");
  fadeOutLoginForm();
  setTimeout(function() { 
    fadeInRegisterForm();
  }, FADING_TIME_MS_2);
  
}

function hideRegisterForm(): void {
  $("#registrationForm").hide();
}

function fadeOutRegisterForm(): void {
  $("#registrationForm").fadeOut(FADING_TIME_MS_2);
}

function fadeInRegisterForm(): void {
  $("#registrationForm").fadeIn(FADING_TIME_MS_2);
}

function hideLoginForm(): void {
  $("#loginForm").hide();
}

function fadeOutLoginForm(): void {
  $("#loginForm").fadeOut(FADING_TIME_MS_2);
}

function fadeInLoginForm(): void {
  $("#loginForm").fadeIn(FADING_TIME_MS_2);
}

function showLoginForm(): void {
  $("#loginForm").show();
}

$("#loginModalToggler").on("click", function() {
  showLoginForm();
  hideRegisterForm();
  activateLoginMode();
});

$("#loginMode").on("click", function() {
  activateLoginMode();
});

$("#registrationMode").on("click", function() {
  activateRegistrationMode();
});

