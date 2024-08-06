const express = require("express");
const app = express();
const port = 3000;
const cookieParser = require("cookie-parser");
// this method can help us to pass cookies to other url
app.use(cookieParser());
// handle information from form which send to server
app.use(express.urlencoded({ extended: true }));
app.set("view engine", "ejs");
const db = {
  users: [
    {
      id: 1,
      email: "huynguyen@gmail.com",
      password: "123456",
      name: "Nguyễn Bảo Huy",
    },
    {
      id: 2,
      email: "huynb23411@st.uel.edu.vn",
      password: "123456",
      name: "Nguyễn Bảo Huy",
    },
  ],
};
// Session
const sessions = {};
// [GET] /
app.get("/", (req, res) => {
  res.render("pages/index");
});
// [GET] /login
app.get("/login", (req, res) => {
  res.render("pages/login");
});
// [POST] /login
app.post("/login", (req, res) => {
  const { email, password } = req.body;
  const user = db.users.find(
    (user) => user.email === email && user.password === password
  );
  if (user) {
    const sessionId = Date.now().toString();
    sessions[sessionId] = {
      userId: user.id,
      // createAt
      // maxAge: 3600
      // or
      // expireAt
    };
    console.log(sessions);
    res
      .setHeader("Set-Cookie", `sessionId=${sessionId}; max-age=3600 ;httpOnly`)
      .redirect("/dashboard");
    return;
  }
  res.send("Invalid username or password");
});
// [GET] /dashboard
app.get("/dashboard", (req, res) => {
  const session = sessions[req.cookies.sessionId];
  // check condition time
  if (!session) {
    return res.redirect("/login");
  }
  const user = db.users.find((user) => user.id === session.userId);
  if (!user) {
    return res.redirect("/login");
  }
  res.render("pages/dashboard", { user });
});
// [GET] logout
app.get("/logout", (req, res) => {
  delete sessions[req.cookies.sessionId];
  res.setHeader("Set-Cookie", "sessionId=; max-age=0").redirect("/login");
});
app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
});
