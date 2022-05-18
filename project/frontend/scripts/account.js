"use strict";
// Class Definition
class GameStat {
    constructor(points, timestamp) {
        this.points = points;
        this.timestamp = timestamp;
    }
    Log() {
        console.log("-------------");
        console.log(this.points);
        console.log(this.timestamp);
    }
}
class GameStats {
    constructor() {
        this.stats = [];
    }
    Add(stat) {
        this.stats.push(stat);
    }
    Log() {
        this.stats.forEach((item) => {
            item.Log();
        });
    }
    SortByPointsAscending() {
        this.stats.sort((a, b) => {
            return a.points - b.points;
        });
    }
    SortByPointsDescending() {
        this.stats.sort((a, b) => {
            return b.points - a.points;
        });
    }
    SortByDateAscending() {
        this.stats.sort((a, b) => {
            return a.timestamp.getTime() - b.timestamp.getTime();
        });
    }
    SortByDateDescending() {
        this.stats.sort((a, b) => {
            return b.timestamp.getTime() - a.timestamp.getTime();
        });
    }
}
// Global Variables
const gameStats = new GameStats();
const FADING_TIME = 500;
// DOM On-Ready function
$(function () {
    loadGameStatisticsByUser();
});
// AJAX-Call to get GameResults
function loadGameStatisticsByUser() {
    $.ajax({
        type: "GET",
        url: "../backend/serviceHandler.php",
        cache: false,
        data: { method: "queryGameStatisticsByUser", param: "placeholder" },
        dataType: "json",
        success: function (response) {
            console.log("Success, AJAX call for 'queryGameStatisticsByUser' made");
            console.log(response);
            // Convert Response-Items to GameStat objects and add them to GameStats
            response.forEach(function (item) {
                gameStats.Add(ConvertItemToGameStat(item));
            });
            CreateGameStatElements(gameStats);
            // #### Logging the Sorting Functions ####
            // gameStats.Log();
            // console.log("POINTS: SORTING ASCENDING");
            // gameStats.SortByPointsAscending();
            // gameStats.Log();
            // console.log("POINTS: SORTING DESCENDING");
            // gameStats.SortByPointsDescending();
            // gameStats.Log();
            // console.log("DATE: SORTING ASCENDING");
            // gameStats.SortByDateAscending();
            // gameStats.Log();
            // console.log("DATE: SORTING DESCENDING");
            // gameStats.SortByDateDescending();
            // gameStats.Log();
        },
        error: function (response) {
            console.log("Error, AJAX call for 'queryGameStatisticsByUser' failed");
            console.log(response);
        },
    });
}
function ConvertItemToGameStat(item) {
    let points = item.pointsGained;
    // Split timestamp into [ Y, M, D, h, m, s ]
    let t = item.timestamp.split(/[- :]/);
    // Apply each element to the Date function
    let d = new Date(Date.UTC(t[0], t[1] - 1, t[2], t[3], t[4], t[5]));
    d.setHours(d.getHours() - 2);
    return new GameStat(points, d);
}
function CreateGameStatElements(gs) {
    let count = 0;
    gs.stats.forEach((item) => {
        // Create new div container for GameStat
        const container = document.createElement("div");
        // Assign ID to container
        let containerId = "gamestat_" + count;
        container.id = containerId;
        // Assign classes to container
        container.className =
            "gamestat p-4 mb-3 border border-3 border-dark rounded";
        // Assigning dataset-attributes to the element
        // Append the new stat to the HTML element with id 'gamestats'
        $("#gamestats").append(container);
        CreateGameStatContent(containerId, item.points, item.timestamp);
        // Increment count
        count++;
    });
}
function CreateGameStatContent(id, points, ts) {
    let statId = "#" + id;
    // Create header for stat-element
    const header = document.createElement("h2");
    header.className = "text-sm-start text-center";
    header.innerHTML = "<i class='fa-solid fa-gamepad'></i> Ergebnis";
    $(statId).append(header);
    // Add horizontal rule
    $(statId).append(document.createElement("hr"));
    // Create div container in order to align content horizontally
    const con = document.createElement("div");
    con.className = "p-2";
    // Create paragraph for points
    const pts = document.createElement("p");
    pts.className = "lead text-sm-start text-center";
    pts.innerHTML = '<i class="fa-solid fa-coins"></i> Punkte: ' + points;
    con.append(pts);
    // Create paragraph for date
    let year = ts.getFullYear();
    let month = convertToMonth(ts.getMonth());
    let day = ts.getDate();
    let weekday = convertToWeekday(ts.getDay());
    let hours = ts.getHours();
    let minutes = ts.getMinutes();
    if (minutes >= 0 && minutes <= 9) {
        minutes = "0" + minutes;
    }
    let str = weekday +
        ". " +
        day +
        " " +
        month +
        " " +
        year +
        " " +
        hours +
        ":" +
        minutes;
    const date = document.createElement("p");
    date.className = "lead text-sm-start text-center";
    date.innerHTML = '<i class="fa-solid fa-calendar"></i> Datum: ' + str;
    con.append(date);
    $(statId).append(con);
}
function destroyGameStats() {
    const myNode = document.getElementById("gamestats");
    while (myNode.firstChild) {
        myNode.removeChild(myNode.lastChild);
    }
}
function convertToWeekday(day) {
    switch (day) {
        case 0:
            return "So";
        case 1:
            return "Mo";
        case 2:
            return "Di";
        case 3:
            return "Mi";
        case 4:
            return "Do";
        case 5:
            return "Fr";
        case 6:
            return "Sa";
        default:
            return "";
    }
}
function convertToMonth(month) {
    switch (month) {
        case 0:
            return "Jan";
        case 1:
            return "Feb";
        case 2:
            return "Mär";
        case 3:
            return "Apr";
        case 4:
            return "Mai";
        case 5:
            return "Jun";
        case 6:
            return "Jul";
        case 7:
            return "Aug";
        case 8:
            return "Sep";
        case 9:
            return "Okt";
        case 10:
            return "Nov";
        case 11:
            return "Dez";
        default:
            return "";
    }
}
function fadeOutGameStats() {
    $("#gamestats").fadeOut(FADING_TIME);
}
function fadeInGameStats() {
    $("#gamestats").fadeIn(FADING_TIME);
}
// #### OnClick Events ####
$("#pointsAsc").on("click", () => {
    fadeOutGameStats();
    setTimeout(() => {
        destroyGameStats();
        gameStats.SortByPointsAscending();
        CreateGameStatElements(gameStats);
        fadeInGameStats();
    }, FADING_TIME);
});
$("#pointsDesc").on("click", () => {
    fadeOutGameStats();
    setTimeout(() => {
        destroyGameStats();
        gameStats.SortByPointsDescending();
        CreateGameStatElements(gameStats);
        fadeInGameStats();
    }, FADING_TIME);
});
$("#datesAsc").on("click", () => {
    fadeOutGameStats();
    setTimeout(() => {
        destroyGameStats();
        gameStats.SortByDateAscending();
        CreateGameStatElements(gameStats);
        fadeInGameStats();
    }, FADING_TIME);
});
$("#datesDesc").on("click", () => {
    fadeOutGameStats();
    setTimeout(() => {
        destroyGameStats();
        gameStats.SortByDateDescending();
        CreateGameStatElements(gameStats);
        fadeInGameStats();
    }, FADING_TIME);
});
