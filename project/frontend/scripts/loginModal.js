"use strict";
const FADING_TIME_MS_2 = 500;
function activateLoginMode() {
    $("#loginMode").addClass("activeModeForLoginModal");
    $("#loginMode").removeClass("inactiveModeForLoginModal");
    $("#registrationMode").addClass("inactiveModeForLoginModal");
    $("#registrationMode").removeClass("activeModeForLoginModal");
    fadeOutRegisterForm();
    setTimeout(function () {
        fadeInLoginForm();
    }, FADING_TIME_MS_2);
}
function activateRegistrationMode() {
    $("#loginMode").removeClass("activeModeForLoginModal");
    $("#loginMode").addClass("inactiveModeForLoginModal");
    $("#registrationMode").removeClass("inactiveModeForLoginModal");
    $("#registrationMode").addClass("activeModeForLoginModal");
    fadeOutLoginForm();
    setTimeout(function () {
        fadeInRegisterForm();
    }, FADING_TIME_MS_2);
}
function hideRegisterForm() {
    $("#registrationForm").hide();
}
function fadeOutRegisterForm() {
    $("#registrationForm").fadeOut(FADING_TIME_MS_2);
}
function fadeInRegisterForm() {
    $("#registrationForm").fadeIn(FADING_TIME_MS_2);
}
function hideLoginForm() {
    $("#loginForm").hide();
}
function fadeOutLoginForm() {
    $("#loginForm").fadeOut(FADING_TIME_MS_2);
}
function fadeInLoginForm() {
    $("#loginForm").fadeIn(FADING_TIME_MS_2);
}
function showLoginForm() {
    $("#loginForm").show();
}
$("#loginModalToggler").on("click", function () {
    showLoginForm();
    hideRegisterForm();
    activateLoginMode();
});
$("#loginMode").on("click", function () {
    activateLoginMode();
});
$("#registrationMode").on("click", function () {
    activateRegistrationMode();
});
