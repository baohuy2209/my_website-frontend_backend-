const express = require("express");
const app = express();
const port = 3000;
const cors = require("cors");
const cookieParser = require("cookie-parser");
const corsOptions = {
  origin: "http://localhost:5173",
  credentials: true,
};
app.use(express.urlencoded({ extended: true }));
app.use(express.json());
app.use(cookieParser());
app.use(cors(corsOptions));
const db = {
  users: [
    {
      id: 1,
      email: "huynguyen002311@gmail.com",
      password: "123456",
      name: "Nguyen Bao Huy",
    },
  ],
  posts: [
    {
      id: 1,
      title: "title 1",
      description: "description 1",
    },
    {
      id: 2,
      title: "title 2",
      description: "description 2",
    },
    {
      id: 3,
      title: "title 3",
      description: "description 3",
    },
  ],
};
//sessions
const sessions = {};
// [GET] /api/posts
app.get("/api/posts", (req, res) => {
  res.json(db.posts);
});
// [POST] /api/auth/login
app.post("/api/auth/login", (req, res) => {
  const { email, password } = req.body;
  const user = db.users.find(
    (user) => user.email === email && user.password === password
  );
  if (!user) {
    res.status(401).json({ message: "Unauthorized" });
  }
  const sessionId = Date.now().toString();
  sessions[sessionId] = { sub: user.id };

  res
    .setHeader(
      "Set-Cookie",
      `sessionId=${sessionId}; httpOnly; max-age=3600; sameSite=None; secure`
    )
    .json(user);
});
// [GET] /api/auth/me
app.get("/api/auth/me", (req, res) => {
  const session = sessions[req.cookies.sessionId];
  if (!session) {
    return res.status(401).json({
      message: "Unauthorized",
    });
  }
  const user = db.user.find((user) => user.id === session.sub);
  res.json({ user });
});
app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}/api/posts`);
});
