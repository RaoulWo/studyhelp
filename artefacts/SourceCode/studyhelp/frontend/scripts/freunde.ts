$(function () {
  loadFriends("freunde");
  loadFriendRequests("ausstehend");
});

// Class Definition
class FriendRequest {
  public senderId: string;
  public receiverId: string;
  public sender: string;
  public timestamp: Date;
  public level: Number;
  public highscore: Number;

  constructor(
    senderId: string,
    receiverId: string,
    sender: string,
    timestamp: Date,
    level: Number,
    highscore: Number
  ) {
    this.senderId = senderId;
    this.receiverId = receiverId;
    this.sender = sender;
    this.timestamp = timestamp;
    this.level = level;
    this.highscore = highscore;
    if (this.highscore == null) {
      this.highscore = 0;
    }
  }

  Log(): void {
    console.log("-------------");
    console.log(this.senderId);
    console.log(this.receiverId);
    console.log(this.sender);
    console.log(this.timestamp);
  }
}

class FriendRequests {
  public requests: FriendRequest[];

  constructor() {
    this.requests = [];
  }

  Clear(): void {
    this.requests = [];
  }

  Add(requests: FriendRequest): void {
    this.requests.push(requests);
  }

  Log(): void {
    this.requests.forEach((item) => {
      item.Log();
    });
  }

  SortByDateAscending(): void {
    this.requests.sort((a, b) => {
      return a.timestamp.getTime() - b.timestamp.getTime();
    });
  }

  SortByDateDescending(): void {
    this.requests.sort((a, b) => {
      return b.timestamp.getTime() - a.timestamp.getTime();
    });
  }

  SortByLevelAscending(): void {
    this.requests.sort((a, b) => {
      return Number(a.level) - Number(b.level);
    });
  }

  SortByLevelDescending(): void {
    this.requests.sort((a, b) => {
      return Number(b.level) - Number(a.level);
    });
  }

  SortByHighscoreAscending(): void {
    this.requests.sort((a, b) => {
      return Number(a.highscore) - Number(b.highscore);
    });
  }

  SortByHighscoreDescending(): void {
    this.requests.sort((a, b) => {
      return Number(b.highscore) - Number(a.highscore);
    });
  }
}

class User {
  public id: string;
  public username: string;

  constructor(id: string, username: string) {
    this.id = id;
    this.username = username;
  }

  Log(): void {
    console.log("-------------");
    console.log(this.id);
    console.log(this.username);
  }
}

class Users {
  public users: User[];

  constructor() {
    this.users = [];
  }

  Clear(): void {
    this.users = [];
  }

  Add(user: User): void {
    this.users.push(user);
  }

  Log(): void {
    this.users.forEach((item) => {
      item.Log();
    });
  }

  SortAlphabetically(): void {
    this.users.sort((a, b) => a.username.localeCompare(b.username));
  }
}

// #### Global Variables ####
const users: Users = new Users();
const friends: FriendRequests = new FriendRequests();
const friendRequests: FriendRequests = new FriendRequests();
const FADING_TIME: number = 500;

// AJAX-Call to search for friends
function loadFriends(status: string): void {
  $.ajax({
    type: "GET",
    url: "../backend/serviceHandler.php",
    cache: false,
    data: { method: "queryFriendRequests", param: status },
    dataType: "json",
    success: function (response) {
      console.log("Success, AJAX call for 'queryFriendRequests' made");
      console.log(response);

      friends.Clear();

      response.forEach(function (item: FriendRequest) {
        friends.Add(ConvertItemToFriendRequest(item));
      });

      CreateFriendElements(friends);
    },
    error: function (response) {
      console.log("Error, AJAX call for 'queryFriendRequests' failed");
      console.log(response);
    },
  });
}

// AJAX-Call to search for friendRequests
function loadFriendRequests(status: string): void {
  $.ajax({
    type: "GET",
    url: "../backend/serviceHandler.php",
    cache: false,
    data: { method: "queryFriendRequests", param: status },
    dataType: "json",
    success: function (response) {
      console.log("Success, AJAX call for 'queryFriendRequests' made");
      console.log(response);

      friendRequests.Clear();

      response.forEach(function (item: FriendRequest) {
        friendRequests.Add(ConvertItemToFriendRequest(item));
      });

      users.SortAlphabetically();

      // friendRequests.Log();
      CreateFriendRequestElements(friendRequests);
    },
    error: function (response) {
      console.log("Error, AJAX call for 'queryFriendRequests' failed");
      console.log(response);
    },
  });
}

// AJAX-Call to accept friend request
function AcceptFriendRequest(senderId: string) {
  $.ajax({
    type: "GET",
    url: "../backend/serviceHandler.php",
    cache: false,
    data: { method: "updateFriendStatus", param: senderId },
    dataType: "json",
    success: function (response) {},
  });
}

// AJAX-Call to deny friend request
function DenyFriendRequest(senderId: string) {
  $.ajax({
    type: "GET",
    url: "../backend/serviceHandler.php",
    cache: false,
    data: { method: "deleteFriendEntries", param: senderId },
    dataType: "json",
    success: function (response) {},
  });
}

// AJAX-Call to search for Users
function loadUsers(username: string): void {
  $.ajax({
    type: "GET",
    url: "../backend/serviceHandler.php",
    cache: false,
    data: { method: "queryUsersByUsername", param: username },
    dataType: "json",
    success: function (response) {
      //console.log("Success, AJAX call for 'queryUsersByUsername' made");
      //console.log(response);

      response.forEach(function (item: User) {
        users.Add(ConvertItemToUser(item));
      });

      users.SortAlphabetically();

      response.forEach((item: User) => {
        CreateUserListElement(item);
      });
    },
    error: function (response) {
      // console.log("Error, AJAX call for 'queryUsersByUsername' failed");
      // console.log(response);
    },
  });
}

function ConvertItemToFriendRequest(item: any): FriendRequest {
  let senderId = item.senderId;
  let receiverId = item.receiverId;

  let sender = item.sender;

  // Split timestamp into [ Y, M, D, h, m, s ]
  let t = item.timestamp.split(/[- :]/);
  // Apply each element to the Date function
  let d = new Date(Date.UTC(t[0], t[1] - 1, t[2], t[3], t[4], t[5]));
  d.setHours(d.getHours() - 2);

  return new FriendRequest(
    senderId,
    receiverId,
    sender,
    d,
    item.level,
    item.highscore
  );
}

function ConvertItemToUser(item: any): User {
  return new User(item.id, item.username);
}

function CreateFriendElements(gs: FriendRequests): void {
  let count = 0;
  gs.requests.forEach((item: FriendRequest) => {
    // Create new div container for FriendRequest
    const container: HTMLDivElement = document.createElement("div");
    // Assign ID to container
    let containerId = "friend_" + count;
    container.id = containerId;
    // Assign classes to container
    container.className = "friend p-4 mb-3 border border-3 border-dark rounded";
    container.dataset.senderId = item.senderId;
    container.dataset.receiverId = item.receiverId;

    // Assigning dataset-attributes to the element
    // Append the new stat to the HTML element with id 'friendRequests'
    $("#friends").append(container);
    CreateFriendContent(
      containerId,
      item.sender,
      item.timestamp,
      item.level,
      item.highscore
    );

    // Increment count
    count++;
  });
}

function CreateFriendRequestElements(gs: FriendRequests): void {
  let count = 0;
  gs.requests.forEach((item: FriendRequest) => {
    // Create new div container for FriendRequest
    const container: HTMLDivElement = document.createElement("div");
    // Assign ID to container
    let containerId = "friendRequest_" + count;
    container.id = containerId;
    // Assign classes to container
    container.className =
      "friendrequest p-4 mb-3 border border-3 border-dark rounded";
    container.dataset.senderId = item.senderId;
    container.dataset.receiverId = item.receiverId;
    // Assigning dataset-attributes to the element
    // Append the new stat to the HTML element with id 'friendRequests'
    $("#friendRequests").append(container);
    CreateFriendRequestContent(containerId, item.sender, item.timestamp);

    // Increment count
    count++;
  });
}

function CreateUserListElement(user: User): void {
  const li = document.createElement("li");
  li.className = "list-group-item list-group-item-action";
  li.dataset.id = user.id;
  li.dataset.username = user.username;
  li.innerHTML = user.username;

  $("#userlist").append(li);
}

function CreateFriendContent(
  id: string,
  sender: string,
  ts: Date,
  level: Number,
  highscore: Number
): void {
  let requestId = "#" + id;

  // Create header for request-element
  const header = document.createElement("h2");
  header.className = "text-sm-start text-center";
  header.innerHTML = "<i class='fa-solid fa-user'></i> " + sender;
  $(requestId).append(header);

  // Add horizontal rule
  $(requestId).append(document.createElement("hr"));

  // Create div container in order to align content horizontally
  const con = document.createElement("div");
  con.className = "p-2";

  // Create paragraph for date

  let year = ts.getFullYear();
  let month = convertToMonth(ts.getMonth());
  let day = ts.getDate();
  let weekday = convertToWeekday(ts.getDay());
  let hours = ts.getHours();
  let minutes: number | string = ts.getMinutes();
  if (minutes >= 0 && minutes <= 9) {
    minutes = "0" + minutes;
  }

  let str =
    weekday +
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
  date.innerHTML = '<i class="fa-solid fa-calendar"></i> Freunde seit: ' + str;
  con.append(date);

  const lvl = document.createElement("p");
  lvl.className = "lead text-sm-start text-center";
  lvl.innerHTML = '<i class="fa-solid fa-calendar"></i> Level: ' + level;
  con.append(lvl);

  if (highscore == null) {
    highscore = 0;
  }

  const score = document.createElement("p");
  score.className = "lead text-sm-start text-center";
  score.innerHTML =
    '<i class="fa-solid fa-calendar"></i> Highscore: ' + highscore;
  con.append(score);

  $(requestId).append(con);
}

function CreateFriendRequestContent(
  id: string,
  sender: string,
  ts: Date
): void {
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
  let minutes: number | string = ts.getMinutes();
  if (minutes >= 0 && minutes <= 9) {
    minutes = "0" + minutes;
  }

  let str =
    weekday +
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
  btnAccept.onclick = () => {
    AcceptFriendRequest($(requestId).data("senderId"));
    fadeOutFriendRequests();
    setTimeout(() => {
      destroyFriendRequests();
      destroyFriends();
      loadFriends("freunde");
      loadFriendRequests("ausstehend");
      fadeInFriends();
      fadeInFriendRequests();
    }, FADING_TIME);
  };

  const btnDeny = document.createElement("button");
  btnDeny.setAttribute("type", "button");
  btnDeny.id = id + "_Deny";
  btnDeny.className = "btn btn-danger";
  btnDeny.innerHTML = '<i class="fa-solid fa-xmark"></i> Ablehnen';
  btnDeny.onclick = () => {
    DenyFriendRequest($(requestId).data("senderId"));
    fadeOutFriendRequests();
    fadeOutFriends();
    setTimeout(() => {
      destroyFriendRequests();
      loadFriendRequests("ausstehend");
      fadeInFriendRequests();
    }, FADING_TIME);
  };

  con2.append(btnAccept);
  con2.append(btnDeny);
  $(requestId).append(con2);
}

function convertToWeekday(day: number): string {
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

function convertToMonth(month: number): string {
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

function destroyFriends(): void {
  const myNode = document.getElementById("friends");
  while (myNode!.firstChild) {
    myNode!.removeChild(myNode!.lastChild!);
  }
}

function destroyFriendRequests(): void {
  const myNode = document.getElementById("friendRequests");
  while (myNode!.firstChild) {
    myNode!.removeChild(myNode!.lastChild!);
  }
}

function destroyUserListElements(): void {
  const myNode = document.getElementById("userlist");
  while (myNode!.firstChild) {
    myNode!.removeChild(myNode!.lastChild!);
  }
}

function fadeOutFriendRequests(): void {
  $("#friendRequests").fadeOut(FADING_TIME);
}

function fadeInFriendRequests(): void {
  $("#friendRequests").fadeIn(FADING_TIME);
}

function fadeOutFriends(): void {
  $("#friends").fadeOut(FADING_TIME);
}

function fadeInFriends(): void {
  $("#friends").fadeIn(FADING_TIME);
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
  loadUsers($("#friend").val()!.toString());
});

$("#datesAscFriends").on("click", () => {
  fadeOutFriends();
  setTimeout(() => {
    destroyFriends();
    friends.SortByDateAscending();
    CreateFriendElements(friends);
    fadeInFriends();
  }, FADING_TIME);
});
$("#datesDescFriends").on("click", () => {
  fadeOutFriends();
  setTimeout(() => {
    destroyFriends();
    friends.SortByDateDescending();
    CreateFriendElements(friends);
    fadeInFriends();
  }, FADING_TIME);
});

$("#levelAscFriends").on("click", () => {
  fadeOutFriends();
  setTimeout(() => {
    destroyFriends();
    friends.SortByLevelAscending();
    CreateFriendElements(friends);
    fadeInFriends();
  }, FADING_TIME);
});
$("#levelDescFriends").on("click", () => {
  fadeOutFriends();
  setTimeout(() => {
    destroyFriends();
    friends.SortByLevelDescending();
    CreateFriendElements(friends);
    fadeInFriends();
  }, FADING_TIME);
});

$("#highscoreAscFriends").on("click", () => {
  fadeOutFriends();
  setTimeout(() => {
    destroyFriends();
    friends.SortByHighscoreAscending();
    CreateFriendElements(friends);
    fadeInFriends();
  }, FADING_TIME);
});
$("#highscoreDescFriends").on("click", () => {
  fadeOutFriends();
  setTimeout(() => {
    destroyFriends();
    friends.SortByHighscoreDescending();
    CreateFriendElements(friends);
    fadeInFriends();
  }, FADING_TIME);
});
