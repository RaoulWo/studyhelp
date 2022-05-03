// jQuery DOM has finished loading
$(function() {
  hideTimer();
  hideGameCards();
  hideResults();
});

const STARTING_GAME_TIME_SECONDS = 30;
const FADING_TIME_MS = 500;

class Game {
  private _time: number  = STARTING_GAME_TIME_SECONDS;
  private _points: number = 0;
  private _correctAnswers: number = 0;
  private _incorrectAnswers: number = 0;

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

  public start(): void {
    this.hideStartingElements();
    if (!isLanguageSelected()) {
      this.throwErrorAndReturnToLanguageSelect();
      return;
    }
    this.changeToGameView();
    this.startTimer();
    this.loadNextQuestion();
  }

  private loadNextQuestion(): void {
    hideGameCards();
    this.changeColorToGrey();
    if (this.time > -1) {
      setTimeout(function() {
        loadVocabulary(getSelectedLanguage());
        $("#gameCards").fadeIn(100);
      }, 100);
    }
  }

  private changeColorToGrey(): void {
    for(let i = 1; i < 5; ++i) {
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
    setTimeout(function() {
      fadeInTimer();
      fadeInGameCards();
    }, FADING_TIME_MS);
  }

  private throwErrorAndReturnToLanguageSelect(): void {
    createErrorMessage("Wähle zuerst eine Sprache aus!");
    setTimeout(function() {
      fadeInGameError();
    }, FADING_TIME_MS);
    setTimeout(function() {
      fadeOutGameError();
    }, FADING_TIME_MS * 5);
    setTimeout(function() {
      fadeInGameStart();
      fadeInGameImg();
    }, FADING_TIME_MS * 6);
  }

  private stop(): void {
    this.hideGameElements();
    setTimeout(function(this: any) {
      this.updateGameResults();
      fadeInGameResults();
    }, FADING_TIME_MS);
  } 

  private hideGameElements(): void {
    fadeOutGameCards();
    fadeOutTimer();
  }

  private updateGameResults() {
    $("#pointsGathered").text(this.points);
    $("#correctAnswers").text(this.correctAnswers);
    $("#incorrectAnswers").text(this.incorrectAnswers);
  }

  private startTimer(): void {
    let timerReference = setInterval(function(this: any) {
      this.renderTime(this.time);
      this.time--;
      if (this.time <= 0) {
        this.stopTimer(timerReference);
        this.stop();
      }
    }, 1000);
  }

  private stopTimer(ref: NodeJS.Timer): void {
    clearInterval(ref);
  }

  private renderTime(time: number): void {
    $("#timer").text(time);
  }

  private isAnswerRight(id: string): boolean {
    return $("#question").text() == $(id).data("german");
  }

  private checkAnswer(id : string): void {
    if (this.isAnswerRight(id)) {
      this.correctAnswers++;
    }
    else {
      this.incorrectAnswers++;
    }
  }
  
  private renderPoints(num : number): void {
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
function startGame() : void {
  fadeOutGameStart();
  fadeOutGameImg();
  if (!isLanguageSelected()) { // Print error-message
    createErrorMessage("Wähle zuerst eine Sprache aus!");

    setTimeout(function() {
      fadeInGameError();
    }, FADING_TIME_MS);
    
    setTimeout(function() {
      fadeOutGameError();
    }, FADING_TIME_MS * 5);

    setTimeout(function() {
      fadeInGameStart();
      fadeInGameImg();
    }, FADING_TIME_MS * 6);
    return;
  }
  // FadeOut LanguageSelect, FadeIn Timer
  fadeOutGameShowcase();
  fadeOutLanguageSelect();
  setTimeout(function() {
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
function stopGame() : void {
  fadeOutGameCards();
  fadeOutTimer();
  setTimeout(function() {
    $("#pointsGathered").text($("#points").text());
    $("#correctAnswers").text(correctAnswers);
    $("#incorrectAnswers").text(incorrectAnswers);
    fadeInGameResults();
  }, FADING_TIME_MS);
}

function checkAnswer(id : string) : boolean { // checks the answer, returns true if answered correctly
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

function renderPoints(num : number) : void {
  $("#points").text(num);
}

function loadNextQuestion() : void {
  //$("#gameCards").fadeOut(200);
  hideGameCards();
  for(let i = 1; i < 5; ++i) {
    let id = "#answer" + i + "Body";
    $(id).removeClass("bg-success");    
    $(id).removeClass("bg-danger");
    $(id).addClass("bg-secondary");
  }
  if(gameTime > -1) {
    setTimeout(function() {
      loadVocabulary(getSelectedLanguage());
      $("#gameCards").fadeIn(100);
    }, 100);
  }
}

// **** AJAX-Calls ****
// Performs AJAX-Call for random Vocabulary Entries
function loadVocabulary(language : string) : void {
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
            
            for(let i = 0; i < 4; ++i) {
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
function startTimer() : void {
  let timerId = setInterval(function() {
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
function createErrorMessage(message : string) : void {
  let error = document.createElement("h2");
  error.id = "gameError";
  $("#gameContainer").append(error);

  $("#gameError").text(message);
  $("#gameError").attr("class", "text-danger text-center");
  $("#gameError").hide();
} 

// **** Checking the selected language ****
function isLanguageSelected() : boolean {
  return isEnglishSelected() || isSpanishSelected() || isFrenchSelected() || isRussianSelected();
}

function isEnglishSelected() : boolean {
  return $("#english").is(":checked");
}

function isSpanishSelected() : boolean {
  return $("#spanish").is(":checked");
}

function isFrenchSelected() : boolean {
  return $("#french").is(":checked");
}

function isRussianSelected() : boolean {
  return $("#russian").is(":checked");
}

function getSelectedLanguage() : string {
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

function fadeOutGameShowcase() : void {
  $("#gameShowcase").fadeOut(FADING_TIME_MS);
}

function fadeInGameShowcase() : void {
  $("#gameShowcase").fadeIn(FADING_TIME_MS);
}

function fadeOutLanguageSelect() : void {
  $("#languageContainer").fadeOut(FADING_TIME_MS);
}

function fadeInLanguageSelect() : void {
  $("#languageContainer").fadeIn(FADING_TIME_MS);
}

function hideTimer() : void {
  $("#timerContainer").hide();
}

function fadeOutTimer() : void {
  $("#timerContainer").fadeOut(FADING_TIME_MS);
}

function fadeInTimer() : void {
  $("#timerContainer").removeClass("d-none");
  $("#timerContainer").fadeIn(FADING_TIME_MS);
}

function fadeOutGameStart() : void {
  $("#gameStart").fadeOut(FADING_TIME_MS);
}

function fadeInGameStart() : void {
  $("#gameStart").fadeIn(FADING_TIME_MS);
}

function fadeOutGameError() : void {
  $("#gameError").fadeOut(FADING_TIME_MS);
}

function fadeInGameError() : void {
  $("#gameError").fadeIn(FADING_TIME_MS);
}

function hideGameCards() : void {
  $("#gameCards").hide();
}

function fadeInGameCards() : void {
  $("#gameCards").removeClass("d-none");
  $("#gameCards").fadeIn(FADING_TIME_MS);
}

function fadeOutGameCards() : void {
  $("#gameCards").fadeOut(FADING_TIME_MS);
}

function fadeOutGameImg() : void {
  $("#gameImg").removeClass("d-none");
  $("#gameImg").removeClass("d-sm-block");
  $("#gameImg").fadeOut(FADING_TIME_MS);
}

function fadeInGameImg() : void {
  $("#gameImg").addClass("d-none");
  $("#gameImg").addClass("d-sm-block");
  $("#gameImg").fadeIn(FADING_TIME_MS);
}

function hideResults() : void {
  $("#gameResults").hide();
}

function fadeInGameResults() : void {
  $("#gameResults").fadeIn(FADING_TIME_MS);
}

function fadeOutResults() : void {
  $("#gameResults").fadeOut(FADING_TIME_MS);
}

// **** Other Functions ****

function getRandomNum(min : number, max : number) : number {
  return Math.random() * (max - min) + min;
}

// **** Change Color ****
function changeColor(id : string, color : string) : void {
  let bg = "bg-" + color;
  $(id).removeClass("bg-secondary");
  $(id).addClass(bg);
}

// ######## Event Listeners ########

$("#gameStart").on("click", function() {
  startGame();
});

$("#answer1Container").on("click", function() {
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
  setTimeout(function() {
    loadNextQuestion();
  }, 300);
});

$("#answer2Container").on("click", function() {
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
  setTimeout(function() {
    loadNextQuestion();
  }, 300);
});

$("#answer3Container").on("click", function() {
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
  setTimeout(function() {
    loadNextQuestion();
  }, 300);
});

$("#answer4Container").on("click", function() {
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
  setTimeout(function() {
    loadNextQuestion();
  }, 300);
});

$("#gameResultsBtn").on("click", function() {
  fadeOutResults();
  setTimeout(function() {
    fadeInGameShowcase();
    fadeInLanguageSelect();
    fadeInGameImg();
    fadeInGameStart();
  }, FADING_TIME_MS);
  correctAnswers = 0;
  incorrectAnswers = 0;
});