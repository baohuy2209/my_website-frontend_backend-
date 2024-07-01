jQuery(document).ready(function ($) {
  $("h1").fadeIn(2000);
  $(".about").fadeIn(2000);
  $(".subtitle").fadeIn(2000);
  $("hr").fadeIn(2000);
  $("p").fadeIn(3000);
  $(".creds").fadeIn(3000);
  $.get(
    "https://raw.githubusercontent.com/dwyl/english-words/master/words_alpha.txt",
    function (data) {
      var quotes = data.split("\n");
      var idx = Math.floor(quotes.length * Math.random());
      $("dt").html(quotes[idx]).fadeIn(3000);
    }
  );
  $.get(
    "https://raw.githubusercontent.com/dwyl/english-words/master/words_alpha.txt",
    function (data) {
      var quotes = data.split("\n");
      var idx = Math.floor(quotes.length * Math.random());
      $("dd").html(quotes[idx]).fadeIn(3000);
    }
  );
});

$("p").click(function () {
  $("dt").fadeOut(500);
  $("dd").fadeOut(500);
  $("p").fadeOut(500);
  var delay = 500;
  setTimeout(function () {
    $.get(
      "https://raw.githubusercontent.com/dwyl/english-words/master/words_alpha.txt",
      function (data) {
        var quotes = data.split("\n");
        var idx = Math.floor(quotes.length * Math.random());
        $("dt").html(quotes[idx]).fadeIn(500);
      }
    );
    $.get(
      "https://raw.githubusercontent.com/dwyl/english-words/master/words_alpha.txt",
      function (data) {
        var quotes = data.split("\n");
        var idx = Math.floor(quotes.length * Math.random());
        $("dd").html(quotes[idx]).fadeIn(500);
        $("p").fadeIn(500);
      }
    );
  }, delay);
});
