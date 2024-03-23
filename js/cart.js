const btnSubstractGroup = document.querySelectorAll(".btn-substract-qty");
const btnAddGroup = document.querySelectorAll(".btn-add-qty");

btnSubstractGroup.forEach(btn =>
  btn.addEventListener("click", function (e) {
    const input = btn.nextElementSibling;
    if (input.value > 1) {
      --input.value;
      input.setAttribute("value", input.value);
    }
  })
);
btnAddGroup.forEach(btn =>
  btn.addEventListener("click", function (e) {
    const input = btn.previousElementSibling;
    ++input.value;
    input.setAttribute("value", input.value);
  })
);
