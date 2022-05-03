"use strict";
// #### jQuery DOM has finished loading ####
$(function () {
    hideTimer();
    hideGameCards();
    hideResults();
});
// ######## Global Variables #########
let correctAnswers = 0;
let incorrectAnswers = 0;
let time = 0; // zeile 46 um zeit einzustellen
// ######## Function Definitions ########
// **** Game Loop ****
// Starts the game, used for onclick-event
function startGame() {
    fadeOutGameStart();
    fadeOutGameImg();
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
            fadeInGameImg();
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
    // Start Timer
    time = 30;
    startGameTime();
    // Perform AJAX-call
    nextQuestion();
}
// Stops the game when timer reaches 0
function stopGame() {
    fadeOutGameCards();
    fadeOutTimer();
    setTimeout(function () {
        $("#pointsGathered").text($("#points").text());
        $("#correctAnswers").text(correctAnswers);
        $("#incorrectAnswers").text(incorrectAnswers);
        fadeInResults();
    }, FADING_TIME);
}
function checkAnswer(id) {
    // console.log($("#question").text());
    // console.log($(id).data("german"));
    if ($("#question").text() == $(id).data("german")) {
        correctAnswers += 1;
    }
    else {
        incorrectAnswers += 1;
    }
    return $("#question").text() == $(id).data("german");
}
function updatePoints(num) {
    $("#points").text(num);
}
function nextQuestion() {
    //$("#gameCards").fadeOut(200);
    hideGameCards();
    for (let i = 1; i < 5; ++i) {
        let id = "#answer" + i + "Body";
        $(id).removeClass("bg-success");
        $(id).removeClass("bg-danger");
        $(id).addClass("bg-secondary");
    }
    if (time > -1) {
        setTimeout(function () {
            loadVocabulary(getLanguage());
            $("#gameCards").fadeIn(100);
        }, 100);
    }
}
// **** AJAX-Calls ****
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
            // Random number from 0 ... 3
            let num = Math.floor(getRandomNum(0, 4)); // 4 exclusive
            $("#question").text(response[num]["german"]);
            for (let i = 0; i < 4; ++i) {
                let id = "#answer" + Number(i + 1);
                // console.log(id);
                // console.log(response[i]["german"]);
                // console.log(response[i]["other"]);
                $(id).data("german", response[i]["german"]);
                $(id).data("other", response[i]["other"]);
                $(id).text(response[i]["other"]);
            }
        },
        error: function (response) {
            console.log("Error, AJAX call for 'queryRandomVocabByLanguage' failed");
            console.log(response);
        }
    });
}
// **** Timer **** 
function startGameTime() {
    let timerId = setInterval(function () {
        $("#timer").text(time);
        time--;
        if (time < 0) {
            clearInterval(timerId);
            stopGame();
        }
    }, 1000);
}
// **** Error messages ****
// Creates an error message inside gameContainer
function createErrorMessage(message) {
    let error = document.createElement("h2");
    error.id = "gameError";
    $("#gameContainer").append(error);
    $("#gameError").text(message);
    $("#gameError").attr("class", "text-danger text-center");
    $("#gameError").hide();
}
// **** Checking the selected language ****
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
function getLanguage() {
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
    return language;
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
function fadeOutGameImg() {
    $("#gameImg").removeClass("d-none");
    $("#gameImg").removeClass("d-sm-block");
    $("#gameImg").fadeOut(FADING_TIME);
}
function fadeInGameImg() {
    $("#gameImg").addClass("d-none");
    $("#gameImg").addClass("d-sm-block");
    $("#gameImg").fadeIn(FADING_TIME);
}
function hideResults() {
    $("#gameResults").hide();
}
function fadeInResults() {
    $("#gameResults").fadeIn(FADING_TIME);
}
function fadeOutResults() {
    $("#gameResults").fadeOut(FADING_TIME);
}
// **** Other Functions ****
function getRandomNum(min, max) {
    return Math.random() * (max - min) + min;
}
// **** Change Color ****
function changeColor(id, color) {
    let bg = "bg-" + color;
    $(id).removeClass("bg-secondary");
    $(id).addClass(bg);
}
// ######## Event Listeners ########
$("#gameStart").on("click", function () {
    startGame();
});
$("#answer1Container").on("click", function () {
    let pts = Number($("#points").text());
    let answer = checkAnswer("#answer1");
    if (answer) {
        changeColor("#answer1Body", "success");
        pts += 100;
    }
    else {
        changeColor("#answer1Body", "danger");
        pts -= 50;
        if (pts < 0) {
            pts = 0;
        }
    }
    updatePoints(pts);
    setTimeout(function () {
        nextQuestion();
    }, 300);
});
$("#answer2Container").on("click", function () {
    let pts = Number($("#points").text());
    let answer = checkAnswer("#answer2");
    if (answer) {
        changeColor("#answer2Body", "success");
        pts += 100;
    }
    else {
        changeColor("#answer2Body", "danger");
        pts -= 50;
        if (pts < 0) {
            pts = 0;
        }
    }
    updatePoints(pts);
    setTimeout(function () {
        nextQuestion();
    }, 300);
});
$("#answer3Container").on("click", function () {
    let pts = Number($("#points").text());
    let answer = checkAnswer("#answer3");
    if (answer) {
        changeColor("#answer3Body", "success");
        pts += 100;
    }
    else {
        changeColor("#answer3Body", "danger");
        pts -= 50;
        if (pts < 0) {
            pts = 0;
        }
    }
    updatePoints(pts);
    setTimeout(function () {
        nextQuestion();
    }, 300);
});
$("#answer4Container").on("click", function () {
    let pts = Number($("#points").text());
    let answer = checkAnswer("#answer4");
    if (answer) {
        changeColor("#answer4Body", "success");
        pts += 100;
    }
    else {
        changeColor("#answer4Body", "danger");
        pts -= 50;
        if (pts < 0) {
            pts = 0;
        }
    }
    updatePoints(pts);
    setTimeout(function () {
        nextQuestion();
    }, 300);
});
$("#gameResultsBtn").on("click", function () {
    fadeOutResults();
    setTimeout(function () {
        fadeInGameShowcase();
        fadeInLanguageSelect();
        fadeInGameImg();
        fadeInGameStart();
    }, FADING_TIME);
    correctAnswers = 0;
    incorrectAnswers = 0;
});
