import express from "express";
const app = express();
const PORT = process.env.PORT || 5001;

express.use(express.json());
app.listen(PORT, () => {
  console.log(`Listening on http://localhost:8080:${PORT}`);
});
