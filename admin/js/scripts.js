ClassicEditor.create(document.querySelector("#body")).catch((error) => {
  console.error(error);
});

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
