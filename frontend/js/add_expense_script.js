document.addEventListener("DOMContentLoaded", function () {
  const addBtn = document.getElementById("addCategoryBtn");
  const input = document.getElementById("newCategoryInput");
  const list = document.getElementById("categoryList");

  addBtn.addEventListener("click", function () {
    const value = input.value.trim();
    if (value) {
      const label = document.createElement("label");
      const radio = document.createElement("input");
      radio.type = "radio";
      radio.name = "category_name";
      radio.value = value;
      radio.required = true;

      label.appendChild(radio);
      label.append(" " + value);
      list.appendChild(label);

      input.value = "";
    }
  });
});
