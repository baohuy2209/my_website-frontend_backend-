const express = require("express");
const dotenv = require("dotenv");
const hdbs = require("express-handlebars");
dotenv.config();
const app = express();
const PORT = process.env.PORT || 3000;
const path = require("path");
const hbs = hdbs.create({
  helpers: require("./lib/helpers"),
  extname: ".hbs",
  partialsDir: ["shared/templates/", "views/partials/"],
});
// set engine for handlabars
app.engine("hbs", hbs.engine);
/**
 * ! set engine thì dùng với hbs
 */
// set view engine
app.set("view engine", "hbs");
/**
 * ! set view engine thì dùng với hbs
 */
// set path views
app.set("views", path.join(__dirname, "./views"));
app.use(express.static(path.join(__dirname, "./public")));
function exposeTemplates(req, res, next) {
  hbs
    .getTemplates("shared/templates/", {
      cache: app.enabled("view cache"),
      precompiled: true,
    })
    .then((templates) => {
      const extRegex = new RegExp(hbs.extname + "$");
      templates = Object.keys(templates).map((name) => {
        return {
          name: name.replace(extRegex, ""),
          template: templates[name],
        };
      });
      if (templates.length) {
        res.locals.templates = templates;
      }
      setImmediate(next);
    })
    .catch(next);
}
app.get("/", (req, res) => {
  res.render("home", {
    title: "Home",
  });
});
app.get("/yell", (req, res) => {
  res.render("yell", {
    title: "Yell",
    message: "hello world",
  });
});
app.get("/exclaim", (req, res) => {
  res.render("yell", {
    title: "Exclaim",
    message: "hello world",
    helpers: {
      yell(msg) {
        return msg + "!!!";
      },
    },
  });
});
app.get("/echo/:message?", exposeTemplates, (req, res) => {
  res.render("echo", {
    title: "Echo",
    message: req.params.message,
    layout: "shared-templates",
    partials: Promise.resolve({
      echo: hbs.handlebars.compile("<p>ECHO: {{message}}</p>"),
    }),
  });
});
app.listen(PORT, () => {
  console.log(`Listening on http://localhost:${PORT}`);
});
