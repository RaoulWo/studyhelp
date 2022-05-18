"use strict";
// Global Variables
const gameStatisticsArray = [];
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
            // Do something ...
            response.forEach(function (item) {
                gameStatisticsArray.push(item);
                console.log(item);
            });
        },
        error: function (response) {
            console.log("Error, AJAX call for 'queryGameStatisticsByUser' failed");
            console.log(response);
        }
    });
}
