import express from "express";
import dotenv from "dotenv";
import cors from "cors";
import connectDb from "./config/db.Config";
import route from "./router/index";
dotenv.config();
connectDb();
const port = process.env.PORT || 5001;
const app = express();
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(
  cors({
    origin: "http://localhost:3000",
    credentials: true,
  })
);
route(app);
app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
});
