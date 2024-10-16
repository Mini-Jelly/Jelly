document.addEventListener("DOMContentLoaded", function () {
  const container = document.querySelector(".container");
  const options = document.querySelectorAll(".jelly-option");
  let activeItem = document.querySelector(".config-item.active");

  // 初始化
  if (activeItem) {
    showOption(activeItem.getAttribute("data-target"));
  }

  // 点击事件委托
  container.addEventListener("click", function (event) {
    const target = event.target;
    if (target.classList.contains("config-item") && !target.classList.contains("active")) {
      activeItem.classList.remove("active");
      target.classList.add("active");
      activeItem = target;
      showOption(target.getAttribute("data-target"));
    }
  });

  // 显示对应选项
  function showOption(target) {
    options.forEach(function (option) {
      option.style.display = option.classList.contains(target) ? "block" : "none";
    });
  }
});
