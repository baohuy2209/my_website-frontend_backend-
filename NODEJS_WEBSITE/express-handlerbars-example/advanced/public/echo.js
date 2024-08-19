"use strict";
(function () {
  const button = document.getElementById("say");
  button.addEventListener(
    "click",
    () => {
      const message = prompt("Say something: ", "Yo yo");
      const echo = document.createElement("div");
      echo.innerHTML = Handlebars.templates.echo({ message });
      document.body.appendChild(echo);
    },
    false
  );
})();
