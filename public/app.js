var textarea = document.getElementById("ndc-message");

textarea.addEventListener("input", function () {
  var form = document.getElementById("ndc-form");

  //Disable the button when the value is empty
  if (textarea.value.trim().length === 0) {
    form.querySelector('button[type="submit"]').disabled = true;
  } else {
    form.querySelector('button[type="submit"]').disabled = false;
  }
});
