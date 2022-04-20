"use strict";
// #### jQuery DOM has finished loading ####
$(function () {
    hideTimer();
    hideGameCards();
});
// ######## Function Definitions ########
// Starts the game, used for onclick-event
function startGame() {
    fadeOutGameStart();
    if (!languageSelected()) { // Print error-message
        createErrorMessage("Wähle zuerst eine Sprache aus!");
        setTimeout(function () {
            fadeInGameError();
        }, FADING_TIME);
        setTimeout(function () {
            fadeOutGameError();
        }, FADING_TIME * 5);
        setTimeout(function () {
            fadeInGameStart();
        }, FADING_TIME * 6);
        return;
    }
    // FadeOut LanguageSelect, FadeIn Timer
    fadeOutGameShowcase();
    fadeOutLanguageSelect();
    setTimeout(function () {
        fadeInTimer();
        fadeInGameCards();
    }, FADING_TIME);
    let language = ""; // selected language for ajax-call parameter
    if (englishSelected()) {
        language = "english";
    }
    else if (spanishSelected()) {
        language = "spanish";
    }
    else if (frenchSelected()) {
        language = "french";
    }
    else if (russianSelected()) {
        language = "russian";
    }
    // Perform AJAX-call
    loadVocabulary(language);
}
// Performs AJAX-Call for random Vocabulary Entries
function loadVocabulary(language) {
    $.ajax({
        type: "GET",
        url: "../backend/serviceHandler.php",
        cache: false,
        data: { method: "queryRandomVocabByLanguage", param: language },
        dataType: "json",
        success: function (response) {
            console.log("Success, AJAX call for 'queryRandomVocabByLanguage' made");
            console.log(response);
        },
        error: function (response) {
            console.log("Error, AJAX call for 'queryRandomVocabByLanguage' failed");
            console.log(response);
        }
    });
}
// Creates an error message inside gameContainer
function createErrorMessage(message) {
    let error = document.createElement("h2");
    error.id = "gameError";
    $("#gameContainer").append(error);
    $("#gameError").text(message);
    $("#gameError").attr("class", "text-danger text-center");
    $("#gameError").hide();
}
// Checks if a language has been selected
function languageSelected() {
    if ($("#english").is(":checked")) { // is(":checked") ist Bootstrap-spezifisch, um zu checken, ob checkbox gewählt wurde
        return true;
    }
    if ($("#spanish").is(":checked")) {
        return true;
    }
    if ($("#french").is(":checked")) {
        return true;
    }
    if ($("#russian").is(":checked")) {
        return true;
    }
    return false;
}
function englishSelected() {
    return $("#english").is(":checked");
}
function spanishSelected() {
    return $("#spanish").is(":checked");
}
function frenchSelected() {
    return $("#french").is(":checked");
}
function russianSelected() {
    return $("#russian").is(":checked");
}
// **** FadeIn, FadeOut, Hide ****
const FADING_TIME = 500;
function fadeOutGameShowcase() {
    $("#gameShowcase").fadeOut(FADING_TIME);
}
function fadeInGameShowcase() {
    $("#gameShowcase").fadeIn(FADING_TIME);
}
function fadeOutLanguageSelect() {
    $("#languageContainer").fadeOut(FADING_TIME);
}
function fadeInLanguageSelect() {
    $("#languageContainer").fadeIn(FADING_TIME);
}
function hideTimer() {
    $("#timerContainer").hide();
}
function fadeOutTimer() {
    $("#timerContainer").fadeOut(FADING_TIME);
}
function fadeInTimer() {
    $("#timerContainer").removeClass("d-none");
    $("#timerContainer").fadeIn(FADING_TIME);
}
function fadeOutGameStart() {
    $("#gameStart").fadeOut(FADING_TIME);
}
function fadeInGameStart() {
    $("#gameStart").fadeIn(FADING_TIME);
}
function fadeOutGameError() {
    $("#gameError").fadeOut(FADING_TIME);
}
function fadeInGameError() {
    $("#gameError").fadeIn(FADING_TIME);
}
function hideGameCards() {
    $("#gameCards").hide();
}
function fadeInGameCards() {
    $("#gameCards").removeClass("d-none");
    $("#gameCards").fadeIn(FADING_TIME);
}
function fadeOutGameCards() {
    $("#gameCards").fadeOut(FADING_TIME);
}
// ######## Event Listeners ########
$("#gameStart").on("click", function () {
    startGame();
});
