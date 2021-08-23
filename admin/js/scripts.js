// ck editor code
// ClassicEditor.create(document.querySelector("#body")).catch((error) => {
//   console.error(error);
// });

$("#selectAllBoxes").click(function (event) {
  if (this.checked) {
    $(".checkBoxes").each(function () {
      this.checked = true;
    });
  } else {
    $(".checkBoxes").each(function () {
      this.checked = false;
    });
  }
});
// broken code . not working
// function onlineUsers() {
//   $.get("functions.php?usersonline=results", (data) => {
//     $(".onlineusers").text(`${data}`);
//   });
// }
// setInterval(() => {
//   onlineUsers();
// }, 500);
function onlineUsers() {
  $.get("functions.php?usersonline=results", function (data) {
    $(".onlineusers").text(`${data}`);
  });
}
setInterval(function () {
  onlineUsers();
}, 500);
