const times = document.getElementById("times");
const iconContainer = document.getElementById("info-container");
// let infoP = document.getElementById('info');
times.onclick = function () {
  click();
};
function click() {
  iconContainer.style.display = "none";
}
