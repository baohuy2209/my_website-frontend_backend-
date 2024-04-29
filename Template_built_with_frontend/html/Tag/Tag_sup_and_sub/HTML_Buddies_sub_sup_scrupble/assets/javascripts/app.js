const word = document.querySelector(".word");
const pb = document.querySelector(".pb");

function pbToggle() {
  if (pb.getAttribute("data-text-swap") == pb.innerHTML) {
    pb.innerHTML = pb.getAttribute("data-text-original");
  } else {
    pb.setAttribute("data-text-original", pb.innerHTML);
    pb.innerHTML = pb.getAttribute("data-text-swap");
  }
}

pb.addEventListener("click", pbToggle);
