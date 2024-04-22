$(function () {
  $("button").click(function () {
    var style = $(this).data("style");
    $("section").removeAttr("class");
    $("section").addClass(style);
    $("#style-name").html($(this).data("title"));
  });
});
