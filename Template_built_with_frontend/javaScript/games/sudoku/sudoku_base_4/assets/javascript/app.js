const possibleValues = [
  "1",
  "2",
  "3",
  "4",
  "5",
  "6",
  "7",
  "8",
  "9",
  "10",
  "11",
  "12",
  "13",
  "14",
  "15",
  "16",
];

var currentlyEditing;
var currentlyEditingTimeout;
var wrap = document.getElementById("wrapper");
restart();

function update() {
  var counter = document.getElementById("solvedCount");
  var count = 0;
  for (var x = 0; x < 16; ++x) {
    for (var y = 0; y < 16; ++y) {
      if (cellIsFull(XYID(x, y))) {
        count++;
      }
    }
  }
  counter.innerHTML = `${count}/256`;
}

function restart() {
  wrap.innerHTML = "";
  for (var i = 0; i < 16; i++) {
    var row = document.createElement("div");
    for (var j = 0; j < 16; j++) {
      var newb = document.createElement("button");
      newb.innerHTML = '<span style="color: #ccc;">0</span>';
      newb.id = "c" + String(i).padStart(2, "0") + String(j).padStart(2, "0");
      newb.title =
        String(i).padStart(2, "0") + ", " + String(j).padStart(2, "0");
      newb.setAttribute("onmousedown", "showOptions(" + newb.id + ")");
      row.appendChild(newb);
    }
    wrap.appendChild(row);
  }
  update();
}

// convert x, y coordinate -> element ID
function XYID(x, y) {
  return "c" + String(x).padStart(2, "0") + String(y).padStart(2, "0");
}

// convert element ID -> x, y coordinate
function IDXY(cell) {
  var nums = cell.split("c")[1];
  return [parseInt(nums.substring(0, 2)), parseInt(nums.substring(2))];
}

function checkHBar(cell) {
  var c = document.getElementById(cell);
  var value = c.innerHTML;
  var rc = IDXY(cell);
  for (var x = 0; x < 16; x++) {
    if (x !== rc[0]) {
      if (document.getElementById(XYID(x, rc[1])).innerHTML == value) {
        return false;
      }
    }
  }
  return true;
}

function checkVBar(cell) {
  var c = document.getElementById(cell);
  var value = c.innerHTML;
  var rc = IDXY(cell);
  for (var y = 0; y < 16; y++) {
    if (y !== rc[1]) {
      if (document.getElementById(XYID(rc[0], y)).innerHTML == value) {
        return false;
      }
    }
  }
  return true;
}

function checkBox(cell) {
  var c = document.getElementById(cell);
  var value = c.innerHTML;
  var rc = IDXY(cell);

  var xmult = parseInt(rc[0] / 4);
  var ymult = parseInt(rc[1] / 4);
  var xstart = 4 * xmult;
  var ystart = 4 * ymult;
  var xend = 4 * xmult + 4;
  var yend = 4 * ymult + 4;

  for (var x = xstart; x < xend; x++) {
    for (var y = ystart; y < yend; y++) {
      if (x !== rc[0] && y !== rc[1]) {
        if (document.getElementById(XYID(x, y)).innerHTML === value) {
          return false;
        }
      }
    }
  }
  return true;
}

function isThisValid(cell, value) {
  document.getElementById(cell).innerHTML = value;
  return checkBox(cell) && checkVBar(cell) && checkHBar(cell);
}

function cellIsFull(cell) {
  var v = document.getElementById(cell).innerHTML;
  return possibleValues.includes(v);
}

function check() {
  for (var x = 0; x < 16; ++x) {
    for (var y = 0; y < 16; ++y) {
      if (cellIsFull(XYID(x, y))) {
        if (
          checkBox(XYID(x, y)) &&
          checkVBar(XYID(x, y)) &&
          checkHBar(XYID(x, y))
        ) {
          document.getElementById(XYID(x, y)).classList.remove("wrong");
        } else {
          document.getElementById(XYID(x, y)).classList.add("wrong");
        }
      }
    }
  }
}

function random(level = 0) {
  let cellsPerLevel = [195, 167, 139, 110, 81, 53]; // see footnote

  var attempts = cellsPerLevel[level];
  var listCompletedCells = [];
  while (attempts > 0) {
    var nn = Math.floor(Math.random() * 16);
    if (nn === 0) nn = 16;
    var xx = Math.floor(Math.random() * 16);
    var yy = Math.floor(Math.random() * 16);
    if (!cellIsFull(XYID(xx, yy))) {
      if (!listCompletedCells.includes(XYID(xx, yy))) {
        if (!isThisValid(XYID(xx, yy), nn)) {
          document.getElementById(XYID(xx, yy)).innerHTML =
            '<span style="color: #ccc;">0</span>';
        } else {
          listCompletedCells.push(XYID(xx, yy));
          attempts--;
        }
      }
    }
  }
  update();
}

// TODO: implement real solver
// This isn't a true solve
function solve() {
  for (var x = 0; x < 16; ++x) {
    for (var y = 0; y < 16; ++y) {
      if (!cellIsFull(XYID(x, y))) {
        for (var n = 1; n <= 16; ++n) {
          if (isThisValid(XYID(x, y), n)) break;
          else document.getElementById(XYID(x, y)).innerHTML = "_";
        }
      }
    }
  }
  // initialize recursive mumbo jumbo
  // window.requestAnimationFrame(solveHelp);
  update();
}

function solveHelp() {
  // recursive solver
  // http://www.rosettacode.org/wiki/Sudoku
  update();
  window.requestAnimationFrame(solveHelp);
}

function showOptions(newb) {
  clearTimeout(currentlyEditingTimeout);
  currentlyEditing = newb;
  var mousepos = [event.clientX, event.clientY];
  var selector = document.getElementById("selection");
  selector.style.top = +mousepos[1] + "px";
  selector.style.left = +mousepos[0] + "px";
  selector.style.display = "block";
  currentlyEditingTimeout = setTimeout(function () {
    selector.style.display = "none";
  }, 3000);
}

function chooseSelection(sel) {
  var selector = document.getElementById("selection");
  selector.style.display = "none";
  currentlyEditing.innerHTML = sel.innerHTML;
  currentlyEditing = null;
  update();
  check();
}

/*
according to https://github.com/robatron/sudoku.js/
a normal puzzle has these difficulties:
0 "easy":         62/81 => 0.765
1 "medium":       53/81 => 0.654
2 "hard":         44/81 => 0.543
3 "very-hard":    35/81 => 0.432
4 "insane":       26/81 => 0.320
5 "inhuman":      17/81 => 0.209
meaning x/81 squares revealed at the start...

we have 256 squares so we should have:
0 "easy":         0.765 => 195
1 "medium":       0.654 => 167
2 "hard":         0.543 => 139
3 "very-hard":    0.432 => 110
4 "insane":       0.320 => 81
5 "inhuman":      0.209 => 53
squares revealed at the start
*/

// VERSION 2.0
// redo without messing with the DOM so much
let grid = [];

function gridInit() {
  for (let x = 0; x < 16; x++) {
    grid[x] = [];
    for (let y = 0; y < 16; y++) {
      grid[x][y] = { set: false, val: 0 };
    }
  }
}

// display prettily
function debugShowGrid(success = "true") {
  let out = document.querySelector("#output");
  out.innerHTML = success + "\n";
  out.innerHTML += JSON.stringify(grid)
    .replace(/],/g, "],\n\t")
    .replace(/\[\[/g, "[\n\t[")
    .replace(/]]/g, "]\n]");
}

function checkLeftRight(x, y, value) {
  for (let i = 0; i < 16; i++) {
    if (i === y) {
      continue;
    }
    if (parseInt(grid[x][i].val) === parseInt(value)) {
      return false;
    }
  }
  return true;
}

function checkUpDown(x, y, value) {
  for (let i = 0; i < 16; i++) {
    if (i === x) {
      continue;
    }
    if (parseInt(grid[i][y].val) === parseInt(value)) {
      return false;
    }
  }
  return true;
}

function checkBlock(x, y, value) {
  var xmult = parseInt(x / 4);
  var ymult = parseInt(y / 4);
  for (let i = xmult * 4; i < xmult * 4 + 4; i++) {
    for (let j = ymult * 4; j < ymult * 4 + 4; j++) {
      if (i === x && j === y) {
        continue;
      }
      if (parseInt(grid[i][j].val) === parseInt(value)) {
        return false;
      }
    }
    return true;
  }
}

function random2(level = 5) {
  let cellsPerLevel = [195, 167, 139, 110, 81, 53]; // see footnote
  let countDone = 0;
  gridInit();

  while (countDone < cellsPerLevel[level]) {
    let n = Math.floor(Math.random() * 16);
    if (n === 0) n = 16;
    let x = Math.floor(Math.random() * 16);
    let y = Math.floor(Math.random() * 16);

    if (
      !grid[x][y].set &&
      grid[x][y].val === 0 &&
      checkLeftRight(x, y, n) &&
      checkUpDown(x, y, n) &&
      checkBlock(x, y, n)
    ) {
      grid[x][y].val = n;
      grid[x][y].set = true;

      countDone++;
    }
  }
  grid2dom();
  check();
}

function solve2() {
  for (let x = 0; x < 16; x++) {
    for (let y = 0; y < 16; y++) {
      if (!grid[x][y].set && grid[x][y].val === 0) {
        for (let p = 1; p <= 16; p++) {
          console.log(
            "x:" + x + "y:" + y + JSON.stringify(grid[x][y]) + " " + p
          );
          if (
            checkLeftRight(x, y, p) &&
            checkUpDown(x, y, p) &&
            checkBlock(x, y, p)
          ) {
            grid.val = p;
            break;
          }
        }
      }
    }
  }
  grid2dom();
  check();
}

function grid2dom() {
  for (let x = 0; x < 16; x++) {
    for (let y = 0; y < 16; y++) {
      if (grid[x][y].set) {
        document.getElementById(XYID(x, y)).innerHTML =
          '<span style="color: blue;">' + grid[x][y].val + "</span>";
      } else {
        document.getElementById(XYID(x, y)).innerHTML = "" + grid[x][y].val;
      }
    }
  }
}
