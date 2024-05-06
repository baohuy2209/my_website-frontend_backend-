heart = undefined
$ ->
  docHeight = undefined
  final = undefined
  lastScroll = undefined
  windowHeight = undefined
  $("hr").attr "txt", "§"
  lastScroll = undefined
  docHeight = undefined
  windowHeight = undefined
  final = undefined
  $(window).scroll ->
    lastScroll = window.scrollY
    windowHeight = $(window).height()
    docHeight = $(document).height()
    final = ((lastScroll + (windowHeight * Math.pow((lastScroll + windowHeight) / docHeight, 10))) / docHeight) * 100
    $("span").css width: final + "%"
    return

  return

heart = ->
  $("hr").addClass "heart"
  $("hr").attr "txt", "♥"
  return

$("hr").hoverIntent
  over: heart,
  interval: 1450,
  out: heart