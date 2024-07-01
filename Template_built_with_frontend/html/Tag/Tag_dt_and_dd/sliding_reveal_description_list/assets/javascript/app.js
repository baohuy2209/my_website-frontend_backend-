window.addEventListener("DOMContentLoaded", () => {
  const descItems = document.querySelectorAll(".desc-item");

  descItems.forEach((item) =>
    item.addEventListener("click", () => item.classList.toggle("open"))
  );
});
