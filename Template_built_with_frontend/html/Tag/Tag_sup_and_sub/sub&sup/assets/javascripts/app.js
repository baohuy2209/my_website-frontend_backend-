const container = document.getElementById("container");
let style = getComputedStyle(container);

const rule = style.getPropertyValue("--rule") || "xy";
const times = style.getPropertyValue("--times") || 1;

function pick(tag, n) {
  return `<${tag}>${n}</${tag}>`;
}

function generate(input) {
  return input.replace(/[xy]/g, (n) =>
    n == "x" ? pick("sub", "y") : pick("sup", "x")
  );
}

function clean(input) {
  return input.replace(/[xy]/g, "");
}

let result = rule.repeat(times);
for (let i = 0; i < times; ++i) {
  result = generate(result);
}

container.innerHTML = clean(result);
container.style.setProperty("--count", container.childElementCount);

[].forEach.call(container.querySelectorAll("#container > *"), (el, i) => {
  el.style.setProperty("--n", i);
});
