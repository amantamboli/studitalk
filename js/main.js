let usersList = document.querySelector(".users-list");
setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "partials/main.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        console.log(data);
        if (data) {
          usersList.innerHTML = data;
        }
      }
    }
  };
  xhr.send();
}, 500);

let btn = document.getElementById("btnm");
window.addEventListener("mouseup", function (event) {
  let modal = document.querySelector(".modal");
  let more = document.querySelector(".more");
  if (event.target != modal && event.target.parentNode != modal) {
    console.log("clicked2");
    modal.style.display = "none";
    more.style.display = "block";
  }
});
btn.addEventListener("click", function () {
  console.log("clicked");
  let modal = document.querySelector(".modal");
  let more = document.querySelector(".more");
  modal.style.display = "block";
  more.style.display = "none";
});
