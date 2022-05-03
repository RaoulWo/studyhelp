"use strict";
// jQuery DOM has finished loading
$(function () {
    hideTimer();
    hideGameCards();
    hideResults();
});
const STARTING_GAME_TIME_SECONDS = 30;
const FADING_TIME_MS = 500;
class Game {
    constructor() {
        this._time = STARTING_GAME_TIME_SECONDS;
        this._points = 0;
        this._correctAnswers = 0;
        this._incorrectAnswers = 0;
    }
    get time() {
        return this._time;
    }
    set time(time) {
        this._time = time;
        if (this._time < 0)
            this._time = 0;
    }
    get points() {
        return this._points;
    }
    set points(points) {
        this._points = points;
        if (this._points < 0) {
            this._points = 0;
        }
    }
    get correctAnswers() {
        return this._correctAnswers;
    }
    set correctAnswers(num) {
        this._correctAnswers = num;
        if (this._correctAnswers < 0)
            this._correctAnswers = 0;
    }
    get incorrectAnswers() {
        return this._incorrectAnswers;
    }
    set incorrectAnswers(num) {
        this._incorrectAnswers = num;
        if (this._incorrectAnswers < 0)
            this._incorrectAnswers = 0;
    }
    start() {
        this.hideStartingElements();
        if (!isLanguageSelected()) {
            this.throwErrorAndReturnToLanguageSelect();
            return;
        }
        this.changeToGameView();
        this.startTimer();
        this.loadNextQuestion();
    }
    loadNextQuestion() {
        hideGameCards();
        this.changeColorToGrey();
        if (this.time > -1) {
            setTimeout(function () {
                loadVocabulary(getSelectedLanguage());
                $("#gameCards").fadeIn(100);
            }, 100);
        }
    }
    changeColorToGrey() {
        for (let i = 1; i < 5; ++i) {
            let id = "#answer" + i + "Body";
            $(id).removeClass("bg-success");
            $(id).removeClass("bg-danger");
            $(id).addClass("bg-secondary");
        }
    }
    hideStartingElements() {
        fadeOutGameStart();
        fadeOutGameImg();
    }
    changeToGameView() {
        fadeOutGameShowcase();
        fadeOutLanguageSelect();
        setTimeout(function () {
            fadeInTimer();
            fadeInGameCards();
        }, FADING_TIME_MS);
    }
    throwErrorAndReturnToLanguageSelect() {
        createErrorMessage("Wähle zuerst eine Sprache aus!");
        setTimeout(function () {
            fadeInGameError();
        }, FADING_TIME_MS);
        setTimeout(function () {
            fadeOutGameError();
        }, FADING_TIME_MS * 5);
        setTimeout(function () {
            fadeInGameStart();
            fadeInGameImg();
        }, FADING_TIME_MS * 6);
    }
    stop() {
        this.hideGameElements();
        setTimeout(function () {
            this.updateGameResults();
            fadeInGameResults();
        }, FADING_TIME_MS);
    }
    hideGameElements() {
        fadeOutGameCards();
        fadeOutTimer();
    }
    updateGameResults() {
        $("#pointsGathered").text(this.points);
        $("#correctAnswers").text(this.correctAnswers);
        $("#incorrectAnswers").text(this.incorrectAnswers);
    }
    startTimer() {
        let timerReference = setInterval(function () {
            this.renderTime(this.time);
            this.time--;
            if (this.time <= 0) {
                this.stopTimer(timerReference);
                this.stop();
            }
        }, 1000);
    }
    stopTimer(ref) {
        clearInterval(ref);
    }
    renderTime(time) {
        $("#timer").text(time);
    }
    isAnswerRight(id) {
        return $("#question").text() == $(id).data("german");
    }
    checkAnswer(id) {
        if (this.isAnswerRight(id)) {
            this.correctAnswers++;
        }
        else {
            this.incorrectAnswers++;
        }
    }
    renderPoints(num) {
        $("#points").text(num);
    }
}
// ######## Global Variables #########
let correctAnswers = 0;
let incorrectAnswers = 0;
let gameTime = 0; // zeile 46 um zeit einzustellen
// ######## Function Definitions ########
// **** Game Loop ****
// Starts the game, used for onclick-event
function startGame() {
    fadeOutGameStart();
    fadeOutGameImg();
    if (!isLanguageSelected()) { // Print error-message
        createErrorMessage("Wähle zuerst eine Sprache aus!");
        setTimeout(function () {
            fadeInGameError();
        }, FADING_TIME_MS);
        setTimeout(function () {
            fadeOutGameError();
        }, FADING_TIME_MS * 5);
        setTimeout(function () {
            fadeInGameStart();
            fadeInGameImg();
        }, FADING_TIME_MS * 6);
        return;
    }
    // FadeOut LanguageSelect, FadeIn Timer
    fadeOutGameShowcase();
    fadeOutLanguageSelect();
    setTimeout(function () {
        fadeInTimer();
        fadeInGameCards();
    }, FADING_TIME_MS);
    // Start Timer
    gameTime = 30;
    startTimer();
    // Perform AJAX-call
    loadNextQuestion();
}
// Stops the game when timer reaches 0
function stopGame() {
    fadeOutGameCards();
    fadeOutTimer();
    setTimeout(function () {
        $("#pointsGathered").text($("#points").text());
        $("#correctAnswers").text(correctAnswers);
        $("#incorrectAnswers").text(incorrectAnswers);
        fadeInGameResults();
    }, FADING_TIME_MS);
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
function renderPoints(num) {
    $("#points").text(num);
}
function loadNextQuestion() {
    //$("#gameCards").fadeOut(200);
    hideGameCards();
    for (let i = 1; i < 5; ++i) {
        let id = "#answer" + i + "Body";
        $(id).removeClass("bg-success");
        $(id).removeClass("bg-danger");
        $(id).addClass("bg-secondary");
    }
    if (gameTime > -1) {
        setTimeout(function () {
            loadVocabulary(getSelectedLanguage());
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
function startTimer() {
    let timerId = setInterval(function () {
        $("#timer").text(gameTime);
        gameTime--;
        if (gameTime < 0) {
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
function isLanguageSelected() {
    return isEnglishSelected() || isSpanishSelected() || isFrenchSelected() || isRussianSelected();
}
function isEnglishSelected() {
    return $("#english").is(":checked");
}
function isSpanishSelected() {
    return $("#spanish").is(":checked");
}
function isFrenchSelected() {
    return $("#french").is(":checked");
}
function isRussianSelected() {
    return $("#russian").is(":checked");
}
function getSelectedLanguage() {
    if (isEnglishSelected())
        return "english";
    else if (isSpanishSelected())
        return "spanish";
    else if (isFrenchSelected())
        return "french";
    else if (isRussianSelected())
        return "russian";
    else
        return "";
}
// **** FadeIn, FadeOut, Hide ****
function fadeOutGameShowcase() {
    $("#gameShowcase").fadeOut(FADING_TIME_MS);
}
function fadeInGameShowcase() {
    $("#gameShowcase").fadeIn(FADING_TIME_MS);
}
function fadeOutLanguageSelect() {
    $("#languageContainer").fadeOut(FADING_TIME_MS);
}
function fadeInLanguageSelect() {
    $("#languageContainer").fadeIn(FADING_TIME_MS);
}
function hideTimer() {
    $("#timerContainer").hide();
}
function fadeOutTimer() {
    $("#timerContainer").fadeOut(FADING_TIME_MS);
}
function fadeInTimer() {
    $("#timerContainer").removeClass("d-none");
    $("#timerContainer").fadeIn(FADING_TIME_MS);
}
function fadeOutGameStart() {
    $("#gameStart").fadeOut(FADING_TIME_MS);
}
function fadeInGameStart() {
    $("#gameStart").fadeIn(FADING_TIME_MS);
}
function fadeOutGameError() {
    $("#gameError").fadeOut(FADING_TIME_MS);
}
function fadeInGameError() {
    $("#gameError").fadeIn(FADING_TIME_MS);
}
function hideGameCards() {
    $("#gameCards").hide();
}
function fadeInGameCards() {
    $("#gameCards").removeClass("d-none");
    $("#gameCards").fadeIn(FADING_TIME_MS);
}
function fadeOutGameCards() {
    $("#gameCards").fadeOut(FADING_TIME_MS);
}
function fadeOutGameImg() {
    $("#gameImg").removeClass("d-none");
    $("#gameImg").removeClass("d-sm-block");
    $("#gameImg").fadeOut(FADING_TIME_MS);
}
function fadeInGameImg() {
    $("#gameImg").addClass("d-none");
    $("#gameImg").addClass("d-sm-block");
    $("#gameImg").fadeIn(FADING_TIME_MS);
}
function hideResults() {
    $("#gameResults").hide();
}
function fadeInGameResults() {
    $("#gameResults").fadeIn(FADING_TIME_MS);
}
function fadeOutResults() {
    $("#gameResults").fadeOut(FADING_TIME_MS);
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
    renderPoints(pts);
    setTimeout(function () {
        loadNextQuestion();
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
    renderPoints(pts);
    setTimeout(function () {
        loadNextQuestion();
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
    renderPoints(pts);
    setTimeout(function () {
        loadNextQuestion();
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
    renderPoints(pts);
    setTimeout(function () {
        loadNextQuestion();
    }, 300);
});
$("#gameResultsBtn").on("click", function () {
    fadeOutResults();
    setTimeout(function () {
        fadeInGameShowcase();
        fadeInLanguageSelect();
        fadeInGameImg();
        fadeInGameStart();
    }, FADING_TIME_MS);
    correctAnswers = 0;
    incorrectAnswers = 0;
});
