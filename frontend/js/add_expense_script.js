document.addEventListener("DOMContentLoaded", function () {
    const addBtn = document.getElementById("addCategoryBtn");
    const input = document.getElementById("newCategoryInput");
    const list = document.getElementById("categoryList");
  
    addBtn.addEventListener("click", function () {
      const value = input.value.trim();
      if (value) {
        const label = document.createElement("label");
        const checkbox = document.createElement("input");
        checkbox.type = "checkbox";
        checkbox.name = "categories[]";
        checkbox.value = value;
  
        label.appendChild(checkbox);
        label.append(" " + value);
        list.appendChild(label);
  
        input.value = "";
      }
    });
  });
  