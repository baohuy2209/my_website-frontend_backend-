// Print alt tag to caption
$(function () {
  $("a > img[style]").each(function () {
    $el = $(this);
    var style = $el.attr("style");
    $el.attr("style", "");
    $el.parent().attr("style", style);
  }); //Moves the inline styles

  $("img").each(function () {
    var title = this.alt;
    $(this).after('<figcaption class="caption">' + title + "</figcaption>");
  }); //Adds the dynamic captions.
});

// Credit CodeJoust
// https://stackoverflow.com/questions/1864401/creating-image-caption-from-alt-script

// Fade in
$(".centerDiv").delay(900).fadeIn("slow");
