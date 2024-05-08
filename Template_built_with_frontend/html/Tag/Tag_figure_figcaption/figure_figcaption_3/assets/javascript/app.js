$(".container").hover(
  function () {
    $(".caption").css("opacity", 1);
    $(".heading").css("transform", "scale(1.2)");
  },
  function () {
    $(".caption").css("opacity", 0);
  }
);
