// jQuery DOM has finished loading
$(function () {
  hideTimer();
  hideGameCards();
  hideResults();
});

const STARTING_GAME_TIME_SECONDS: number = 60;
const FADING_TIME_MS: number = 500;

class Game {
  public _time: number = STARTING_GAME_TIME_SECONDS;
  private _points: number = 0;
  private _correctAnswers: number = 0;
  private _incorrectAnswers: number = 0;

  get time() {
    return this._time;
  }
  set time(time) {
    this._time = time;
    if (this._time < -1) this._time = -1;
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
    if (this._correctAnswers < 0) this._correctAnswers = 0;
  }

  get incorrectAnswers() {
    return this._incorrectAnswers;
  }
  set incorrectAnswers(num) {
    this._incorrectAnswers = num;
    if (this._incorrectAnswers < 0) this._incorrectAnswers = 0;
  }

  public getPoints(): number {
    return this._points;
  }

  public start(): void {
    this.hideStartingElements();
    if (!isLanguageSelected()) {
      this.throwErrorAndReturnToLanguageSelect();
      return;
    }
    this.changeToGameView();
    startTimer();
    this.loadNextQuestion();
  }

  public loadNextQuestion(): void {
    hideGameCards();
    this.changeColorToGrey();
    if (this.time >= 0) {
      setTimeout(function () {
        loadVocabulary(getSelectedLanguage());
        $("#gameCards").fadeIn(100);
      }, 100);
    }
  }

  public checkAnswerAndUpdatePoints(id: string): void {
    if (this.isAnswerRight(id)) {
      this.correctAnswers++;
      this.points = this.points + 100;
      changeColor(id + "Body", "success");
    } else {
      this.incorrectAnswers++;
      console.log(this.correctAnswers);
      console.log(this.incorrectAnswers);
      this.points = this.points - 50;
      changeColor(id + "Body", "danger");
    }
    this.renderPoints();
  }

  private renderPoints(): void {
    $("#points").text(this.points);
  }

  private changeColorToGrey(): void {
    for (let i = 1; i < 5; ++i) {
      let id = "#answer" + i + "Body";
      $(id).removeClass("bg-success");
      $(id).removeClass("bg-danger");
      $(id).addClass("bg-secondary");
    }
  }

  private hideStartingElements(): void {
    fadeOutGameStart();
    fadeOutGameImg();
  }

  private changeToGameView(): void {
    fadeOutGameShowcase();
    fadeOutLanguageSelect();
    setTimeout(function () {
      fadeInTimer();
      fadeInGameCards();
    }, FADING_TIME_MS);
  }

  private throwErrorAndReturnToLanguageSelect(): void {
    createErrorMessage("W??hle zuerst eine Sprache aus!");
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

  public stop(): void {
    let correct: number = this.correctAnswers;
    let incorrect: number = this.incorrectAnswers;
    this.hideGameElements();
    setTimeout(function (this: any) {
      $("#pointsGathered").text($("#points").text());
      $("#correctAnswers").text(correct); // Wenn ich die Attribute direkt reinschreibe steht [HTMLSpanElement] ?
      $("#incorrectAnswers").text(incorrect);
      fadeInGameResults();
      sendResultsToBackend(Number($("#points").text()));
    }, FADING_TIME_MS);
  }

  private hideGameElements(): void {
    fadeOutGameCards();
    fadeOutTimer();
  }

  private isAnswerRight(id: string): boolean {
    return $("#question").text() == $(id).data("german");
  }
}

// ######## Event Listeners ########

let game = null;

$("#gameStart").on("click", function () {
  game = new Game();
  game.start();
});

for (let i = 1; i <= 4; ++i) {
  $("#answer" + i + "Container").on("click", function () {
    game.checkAnswerAndUpdatePoints("#answer" + i);
    setTimeout(function () {
      game.loadNextQuestion();
    }, 300);
  });
}

$("#gameResultsBtn").on("click", function () {
  returnToStartAfterResults();
});

// ######## Function Definitions ########

// Aus irgendeinem Grund geht es nicht, wenn diese Funktion Methode der Klasse ist
function startTimer(): void {
  let timerId = setInterval(function () {
    $("#timer").text(game.time);
    game.time--;
    if (game.time < 0) {
      clearInterval(timerId);
      game.stop();
    }
  }, 1000);
}

function loadVocabulary(language: string): void {
  $.ajax({
    type: "GET",
    url: "../backend/serviceHandler.php",
    cache: false,
    data: { method: "queryRandomVocabByLanguage", param: language },
    dataType: "json",
    success: function (response) {
      console.log(
        "Success, AJAX call for 'queryRandomVocabByLanguage' Language: " +
          language +
          " made"
      );
      console.log(response);
      setUpGameCards(response);
    },
    error: function (response) {
      console.log("Error, AJAX call for 'queryRandomVocabByLanguage' failed");
      console.log(response);
    },
  });
}

function sendResultsToBackend(points: number): void {
  $.ajax({
    type: "GET",
    url: "../backend/serviceHandler.php",
    cache: false,
    data: { method: "insertGameResultsIntoDatabase", param: points },
    dataType: "json",
    success: function (response) {
      console.log(
        "Success, AJAX call for 'insertGameResultsIntoDatabase' made"
      );
      console.log(response);
      $("#gameUser").text(response["username"]);
      $("#gameLevel").text(response["level"]);
      $("#gamePunkte").text(1000 - response["points"]);
    },
    error: function (response) {
      console.log(
        "Error, AJAX call for 'insertGameResultsIntoDatabase' failed"
      );
      console.log(response);
    },
  });
}

function setUpGameCards(response: any): void {
  let num = Math.floor(getRandomNum(0, 4)); // 4 exclusive
  $("#question").text(response[num]["german"]);
  for (let i = 0; i < 4; ++i) {
    let id = "#answer" + Number(i + 1);
    $(id).data("german", response[i]["german"]);
    $(id).data("other", response[i]["other"]);
    $(id).text(response[i]["other"]);
  }
}

// Creates an error message inside gameContainer
function createErrorMessage(message: string): void {
  let error = document.createElement("h2");
  error.id = "gameError";
  $("#gameContainer").append(error);
  $("#gameError").text(message);
  $("#gameError").attr("class", "text-danger text-center");
  $("#gameError").hide();
}

function isLanguageSelected(): boolean {
  return (
    isEnglishSelected() ||
    isSpanishSelected() ||
    isFrenchSelected() ||
    isRussianSelected()
  );
}

function isEnglishSelected(): boolean {
  return $("#english").is(":checked");
}

function isSpanishSelected(): boolean {
  return $("#spanish").is(":checked");
}

function isFrenchSelected(): boolean {
  return $("#french").is(":checked");
}

function isRussianSelected(): boolean {
  return $("#russian").is(":checked");
}

function getSelectedLanguage(): string {
  if (isEnglishSelected()) return "english";
  else if (isSpanishSelected()) return "spanish";
  else if (isFrenchSelected()) return "french";
  else if (isRussianSelected()) return "russian";
  else return "";
}

function fadeOutGameShowcase(): void {
  $("#gameShowcase").fadeOut(FADING_TIME_MS);
}

function fadeInGameShowcase(): void {
  $("#gameShowcase").fadeIn(FADING_TIME_MS);
}

function fadeOutLanguageSelect(): void {
  $("#languageContainer").fadeOut(FADING_TIME_MS);
}

function fadeInLanguageSelect(): void {
  $("#languageContainer").fadeIn(FADING_TIME_MS);
}

function hideTimer(): void {
  $("#timerContainer").hide();
}

function fadeOutTimer(): void {
  $("#timerContainer").fadeOut(FADING_TIME_MS);
}

function fadeInTimer(): void {
  $("#timerContainer").removeClass("d-none");
  $("#timerContainer").fadeIn(FADING_TIME_MS);
}

function fadeOutGameStart(): void {
  $("#gameStart").fadeOut(FADING_TIME_MS);
}

function fadeInGameStart(): void {
  $("#gameStart").fadeIn(FADING_TIME_MS);
}

function fadeOutGameError(): void {
  $("#gameError").fadeOut(FADING_TIME_MS);
}

function fadeInGameError(): void {
  $("#gameError").fadeIn(FADING_TIME_MS);
}

function hideGameCards(): void {
  $("#gameCards").hide();
}

function fadeInGameCards(): void {
  $("#gameCards").removeClass("d-none");
  $("#gameCards").fadeIn(FADING_TIME_MS);
}

function fadeOutGameCards(): void {
  $("#gameCards").fadeOut(FADING_TIME_MS);
}

function fadeOutGameImg(): void {
  $("#gameImg").removeClass("d-none");
  $("#gameImg").removeClass("d-sm-block");
  $("#gameImg").fadeOut(FADING_TIME_MS);
}

function fadeInGameImg(): void {
  $("#gameImg").addClass("d-none");
  $("#gameImg").addClass("d-sm-block");
  $("#gameImg").fadeIn(FADING_TIME_MS);
}

function hideResults(): void {
  $("#gameResults").hide();
}

function fadeInGameResults(): void {
  $("#gameResults").fadeIn(FADING_TIME_MS);
}

function fadeOutResults(): void {
  $("#gameResults").fadeOut(FADING_TIME_MS);
}

function getRandomNum(min: number, max: number): number {
  return Math.random() * (max - min) + min;
}

function changeColor(id: string, color: string): void {
  let bg = "bg-" + color;
  $(id).removeClass("bg-secondary");
  $(id).addClass(bg);
}

function returnToStartAfterResults(): void {
  fadeOutResults();
  setTimeout(function () {
    fadeInGameShowcase();
    fadeInLanguageSelect();
    fadeInGameImg();
    fadeInGameStart();
  }, FADING_TIME_MS);
}
