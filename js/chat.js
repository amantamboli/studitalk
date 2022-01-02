const form = document.querySelector(".typing-area"),
  receiver_id = form.querySelector(".receiver_id").value,
  inputField = form.querySelector(".input-field"),
  sendBtn = form.querySelector("button"),
  chatBox = document.querySelector(".chat-box");
let reportBtn = document.getElementById("report");
let blockBtn = document.getElementById("block");

form.onsubmit = (e) => {
  e.preventDefault();
};

inputField.focus();
inputField.onkeyup = () => {
  if (inputField.value != "") {
    sendBtn.classList.add("active");
  } else {
    sendBtn.classList.remove("active");
  }
};

sendBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "partials/insert.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        inputField.value = "";
        scrollToBottom();
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};
chatBox.onmouseenter = () => {
  chatBox.classList.add("active");
};

chatBox.onmouseleave = () => {
  chatBox.classList.remove("active");
};

setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "partials/fetch.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        chatBox.innerHTML = data;
        if (!chatBox.classList.contains("active")) {
          scrollToBottom();
        }
      }
    }
  };
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("receiver_id=" + receiver_id);
}, 500);

function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}

let togglebtn = document.getElementById("btn");
let closebtn = document.getElementById("close");
console.log(togglebtn);
let modal = document.querySelector(".modal");
togglebtn.addEventListener("click", function () {
  modal.classList.add("modal-active");
});
closebtn.addEventListener("click", function () {
  modal.classList.remove("modal-active");
});

// for reporting currunt user
reportBtn.onclick = () => {
  let confirm = window.confirm("Are You Really Want to Report This User?");
  if (confirm) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "partials/report.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          console.log(data);
          if (data) {
            alert(" This User Has Been Reported");
            modal.classList.remove("modal-active");
          }
        }
      }
    };
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("receiver_id=" + receiver_id);
  }
};
//for blocking the user

blockBtn.onclick = () => {
  let confirm = window.confirm("Are You Really Want to Report This User?");
  if (confirm) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "partials/block.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          if (data) {
            alert(" This User Has Been blocked");
            window.location.href = "main.php";
          }
        }
      }
    };
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("receiver_id=" + receiver_id);
  }
};
function dblclick1(event) {
  let msg_id = event.toElement.id;
  console.log(msg_id, receiver_id);
  var data = {
    receiver_id: receiver_id,
    msg_id: msg_id,
  };
  let confirm = window.confirm("Delete This Message?");
  if (confirm) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "partials/deletemessage.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
        }
      }
    };
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("receiver_id=" + receiver_id + "&msg_id=" + msg_id);
}

// let msg2 = document.querySelector(".outgoing");
