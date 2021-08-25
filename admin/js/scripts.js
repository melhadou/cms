// ck editor code
function ckeditor() {
  ClassicEditor.create(document.querySelector("#editor"), {
    toolbar: [
      "heading",
      "|",
      "bold",
      "italic",
      "link",
      "bulletedList",
      "numberedList",
      "blockQuote",
    ],
    heading: {
      options: [
        {
          model: "paragraph",
          title: "Paragraph",
          class: "ck-heading_paragraph",
        },
        {
          model: "heading1",
          view: "h1",
          title: "Heading 1",
          class: "ck-heading_heading1",
        },
        {
          model: "heading2",
          view: "h2",
          title: "Heading 2",
          class: "ck-heading_heading2",
        },
      ],
    },
  }).catch((error) => {
    console.log(error);
  });
}

ckeditor();

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
//   $.get("functions.php?usersonline=results", (req) => {
//     $(".onlineusers").text(`${req}`);
//   });
// }
// setInterval(() => {
//   onlineUsers();
// }, 500);
