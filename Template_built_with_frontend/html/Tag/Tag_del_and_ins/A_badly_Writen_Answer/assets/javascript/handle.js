setTimeout(function () {
  for (var i = 0; i < document.getElementsByTagName("ins").length; i++) {
    document.getElementsByTagName("ins")[i].style.margin =
      "0 " +
      (10 - 0.5 * document.getElementsByTagName("ins")[i].offsetWidth) +
      "px 0";
  }
}, 50);
