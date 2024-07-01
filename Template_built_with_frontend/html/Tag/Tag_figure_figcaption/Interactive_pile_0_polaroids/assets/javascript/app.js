console.clear();

getPhotos();

function getPhotos() {
  var photos = [];
  $.getJSON("https://picsum.photos/list", function (data) {
    while (photos.length < 12) {
      var rand = data[getRandomInt(0, data.length)];
      if ($.inArray(rand, photos) == -1) {
        photos.push(rand);
      }
    }
    $(".photos").html("");
    $.each(photos, function (i) {
      $(
        '<div class="drag" data-i="' +
          i +
          '"><figure class="spin"><img src="https://picsum.photos/400?image=' +
          this.id +
          '" alt="Photo by ' +
          this.author +
          '" onerror="this.parentElement.parentElement.style.display = \'none\';" /><figcaption>' +
          this.author +
          "</figcaption></figure></div>"
      ).appendTo(".photos");
    });
    scatterPhotos();
  });
}

function scatterPhotos() {
  var board = $(".photos");
  var drag = $(".drag");
  var spin = $(".spin");

  $(drag.get().reverse()).each(function (index) {
    TweenLite.to(this, 0.5, {
      delay: index * 0.1,
      x: getRandomInt((board.width() / 3) * -1, board.width() / 3),
      y: getRandomInt((board.height() / 3) * -1, board.height() / 3),
    });
    TweenLite.to($(this).find(".spin"), 0.5, {
      delay: index * 0.1,
      rotation: getRandomInt(-30, 30),
    });
  });

  Draggable.create(drag, {
    bounds: board,
    throwProps: true,
    edgeResistance: 0,
    type: "x,y",
    zIndexBoost: false,
    onClick: function () {
      var $this = $(this.target);
      if ($this.hasClass("active")) {
        TweenLite.to($this, 0.2, {
          scaleX: 1,
          scaleY: 1,
          x: $this.attr("data-x"),
          y: $this.attr("data-y"),
        });
        TweenLite.to($this.find(".spin"), 0.2, {
          rotation: $this.attr("data-r"),
        });
        $this.removeClass("active");
        $("body").removeClass("full");
      } else {
        $this
          .attr("data-x", $this[0]._gsTransform.x)
          .attr("data-y", $this[0]._gsTransform.y)
          .attr("data-r", $this.find(".spin")[0]._gsTransform.rotation);
        TweenLite.to($this, 0.2, {
          scaleX: 2,
          scaleY: 2,
          x: 0,
          y: 0,
        });
        TweenLite.to($this.find(".spin"), 0.2, {
          rotation: 0,
        });
        TweenLite.to($(".active"), 0.2, {
          scaleX: 1,
          scaleY: 1,
          x: $(".active").attr("data-x"),
          y: $(".active").attr("data-y"),
        });
        TweenLite.to($(".active .spin"), 0.2, {
          rotation: $this.attr("data-r"),
        });
        $(".drag.active").removeClass("active");
        $("body").removeClass("full");
        $this.addClass("active").appendTo(".photos");
        $("body").addClass("full");
      }
    },
    onDrag: function () {
      var $this = $(this.target);
      TweenLite.to($this, 0.2, {
        scaleX: 1,
        scaleY: 1,
      });
      $this.removeClass("active");
      $("body").removeClass("full");
    },
    onThrowComplete: function () {
      var $this = $(this.target);
      var r = $this.find(".spin")[0]._gsTransform.rotation;
      if (r > 360 || r < -360) {
        r = r % 360;
        TweenLite.to($this.find(".spin"), 0, {
          rotation: r,
        });
      }
    },
  });
  Draggable.create(spin, {
    type: "rotation",
    throwProps: true,
    throwResistance: 25000,
    minDuration: 0,
  });
}

function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}
