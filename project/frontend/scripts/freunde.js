"use strict";
$(function () {
    loadFriendRequests();
});
// Class Definition
class FriendRequest {
    constructor(sender, timestamp) {
        this.sender = sender;
        this.timestamp = timestamp;
    }
    Log() {
        console.log("-------------");
        console.log(this.sender);
        console.log(this.timestamp);
    }
}
class FriendRequests {
    constructor() {
        this.requests = [];
    }
    Add(requests) {
        this.requests.push(requests);
    }
    Log() {
        this.requests.forEach((item) => {
            item.Log();
        });
    }
    SortByDateAscending() {
        this.requests.sort((a, b) => {
            return a.timestamp.getTime() - b.timestamp.getTime();
        });
    }
    SortByDateDescending() {
        this.requests.sort((a, b) => {
            return b.timestamp.getTime() - a.timestamp.getTime();
        });
    }
}
class User {
    constructor(id, username) {
        this.id = id;
        this.username = username;
    }
    Log() {
        console.log("-------------");
        console.log(this.id);
        console.log(this.username);
    }
}
class Users {
    constructor() {
        this.users = [];
    }
    Clear() {
        this.users = [];
    }
    Add(user) {
        this.users.push(user);
    }
    Log() {
        this.users.forEach((item) => {
            item.Log();
        });
    }
    SortAlphabetically() {
        this.users.sort((a, b) => a.username.localeCompare(b.username));
    }
}
// #### Global Variables ####
const users = new Users();
const friendRequests = new FriendRequests();
const FADING_TIME = 500;
// AJAX-Call to search for friends
function loadFriendRequests() {
    $.ajax({
        type: "GET",
        url: "../backend/serviceHandler.php",
        cache: false,
        data: { method: "queryFriendRequests", param: "placeholder" },
        dataType: "json",
        success: function (response) {
            console.log("Success, AJAX call for 'queryFriendRequests' made");
            console.log(response);
            response.forEach(function (item) {
                friendRequests.Add(ConvertItemToFriendRequest(item));
            });
            // friendRequests.Log();
            CreateFriendRequestElements(friendRequests);
        },
        error: function (response) {
            console.log("Error, AJAX call for 'queryFriendRequests' failed");
            console.log(response);
        },
    });
}
// AJAX-Call to search for Users
function loadUsers(username) {
    $.ajax({
        type: "GET",
        url: "../backend/serviceHandler.php",
        cache: false,
        data: { method: "queryUsersByUsername", param: username },
        dataType: "json",
        success: function (response) {
            //console.log("Success, AJAX call for 'queryUsersByUsername' made");
            //console.log(response);
            response.forEach(function (item) {
                users.Add(ConvertItemToUser(item));
            });
            users.SortAlphabetically();
            response.forEach((item) => {
                CreateUserListElement(item);
            });
        },
        error: function (response) {
            console.log("Error, AJAX call for 'queryUsersByUsername' failed");
            console.log(response);
        },
    });
}
function ConvertItemToFriendRequest(item) {
    let sender = item.sender;
    // Split timestamp into [ Y, M, D, h, m, s ]
    let t = item.timestamp.split(/[- :]/);
    // Apply each element to the Date function
    let d = new Date(Date.UTC(t[0], t[1] - 1, t[2], t[3], t[4], t[5]));
    d.setHours(d.getHours() - 2);
    return new FriendRequest(sender, d);
}
function ConvertItemToUser(item) {
    return new User(item.id, item.username);
}
function CreateFriendRequestElements(gs) {
    let count = 0;
    gs.requests.forEach((item) => {
        // Create new div container for FriendRequest
        const container = document.createElement("div");
        // Assign ID to container
        let containerId = "friendRequest_" + count;
        container.id = containerId;
        // Assign classes to container
        container.className =
            "friendrequest p-4 mb-3 border border-3 border-dark rounded";
        // Assigning dataset-attributes to the element
        // Append the new stat to the HTML element with id 'friendRequests'
        $("#friendRequests").append(container);
        CreateFriendRequestContent(containerId, item.sender, item.timestamp);
        // Increment count
        count++;
    });
}
function CreateUserListElement(user) {
    const li = document.createElement("li");
    li.className = "list-group-item list-group-item-action";
    li.dataset.id = user.id;
    li.dataset.username = user.username;
    li.innerHTML = user.username;
    $("#userlist").append(li);
}
function CreateFriendRequestContent(id, sender, ts) {
    let requestId = "#" + id;
    // Create header for request-element
    const header = document.createElement("h2");
    header.className = "text-sm-start text-center";
    header.innerHTML = "<i class='fa-solid fa-gamepad'></i> Anfrage";
    $(requestId).append(header);
    // Add horizontal rule
    $(requestId).append(document.createElement("hr"));
    // Create div container in order to align content horizontally
    const con = document.createElement("div");
    con.className = "p-2";
    // Create paragraph for points
    const s = document.createElement("p");
    s.className = "lead text-sm-start text-center";
    s.innerHTML = '<i class="fa-solid fa-coins"></i> Gesendet von: ' + sender;
    con.append(s);
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
    date.innerHTML = '<i class="fa-solid fa-calendar"></i> Gesendet am: ' + str;
    con.append(date);
    $(requestId).append(con);
    $(requestId).append(document.createElement("hr"));
    const con2 = document.createElement("div");
    con2.className = "text-sm-start text-center";
    const btnAccept = document.createElement("button");
    btnAccept.setAttribute("type", "button");
    btnAccept.id = id + "_Accept";
    btnAccept.className = "btn btn-success me-2";
    btnAccept.innerHTML = '<i class="fa-solid fa-check"></i> Annehmen';
    const btnDeny = document.createElement("button");
    btnDeny.setAttribute("type", "button");
    btnDeny.id = id + "_Deny";
    btnDeny.className = "btn btn-danger";
    btnDeny.innerHTML = '<i class="fa-solid fa-xmark"></i> Ablehnen';
    con2.append(btnAccept);
    con2.append(btnDeny);
    $(requestId).append(con2);
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
function destroyFriendRequests() {
    const myNode = document.getElementById("friendRequests");
    while (myNode.firstChild) {
        myNode.removeChild(myNode.lastChild);
    }
}
function destroyUserListElements() {
    const myNode = document.getElementById("userlist");
    while (myNode.firstChild) {
        myNode.removeChild(myNode.lastChild);
    }
}
function fadeOutFriendRequests() {
    $("#friendRequests").fadeOut(FADING_TIME);
}
function fadeInFriendRequests() {
    $("#friendRequests").fadeIn(FADING_TIME);
}
$("#datesAsc").on("click", () => {
    fadeOutFriendRequests();
    setTimeout(() => {
        destroyFriendRequests();
        friendRequests.SortByDateAscending();
        CreateFriendRequestElements(friendRequests);
        fadeInFriendRequests();
    }, FADING_TIME);
});
$("#datesDesc").on("click", () => {
    fadeOutFriendRequests();
    setTimeout(() => {
        destroyFriendRequests();
        friendRequests.SortByDateDescending();
        CreateFriendRequestElements(friendRequests);
        fadeInFriendRequests();
    }, FADING_TIME);
});
$("#friend").on("input", () => {
    users.Clear();
    destroyUserListElements();
    loadUsers($("#friend").val().toString());
});
