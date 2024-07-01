function type($target) {
  //stop typing when hover is off//
  if ($target.Stop) {
    return;
  }
  if ($target.index < $target.caption.length) {
    $target.text($target.text() + $target.caption.charAt($target.index));

    $target.index++;

    setTimeout(function () {
      type($target);
    }, 100);
  }
}
$(document).ready(function () {
  var $figures = $(".wiggly");
  $figures.each(function () {
    let $figure = $(this);

    let $caption = $figure.find("figcaption");

    $caption.caption = $caption.text();
    $caption.index = 0;
    $caption.text("");
    $caption.Stop = false;
    let $img = $figure.find("img");
    $figure.hover(
      function (e) {
        $caption.Stop = false;
        type($caption);
      },
      function () {
        $caption.Stop = true;
        $caption.text("");
        $caption.index = 0;
      }
    );
  });
});
