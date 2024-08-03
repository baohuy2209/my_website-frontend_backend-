const express = require("express");
const mongoose = require("mongoose");
const cors = require("cors");
const bodyParser = require("body-parser");

const app = express();
// define port for backend of website
const PORT = process.env.PORT || 5000;

app.use(cors()); // use cor
app.use(bodyParser.json());
// connect to database Stocke_Website
mongoose.connect("mongodb://127.0.0.1:27017/Stock_Website", {
  useNewUrlParser: true,
  useUnifiedTopology: true,
});
// define a StockSchema
const stockSchema = new mongoose.Schema({
  company: String,
  description: String,
  initial_price: Number,
  price_2002: Number,
  price_2007: Number,
  symbol: String,
});
// create new model of Stock
const Stock = mongoose.model("Stock", stockSchema);
// define router on backend
app.get("/api/stocks", async (req, res) => {
  try {
    const stocks = await Stock.find();
    res.json(stocks); // render data on url http://localhost:5000/api/stocks
  } catch (error) {
    // handle error
    console.error(error);
    res.status(500).json({ error: "Internal Server Error" });
  }
});
// [POST] post data
app.post("/api/watchlist", async (req, res) => {
  try {
    const {
      company,
      description,
      initial_price,
      price_2002,
      price_2007,
      symbol,
    } = req.body;
    const stock = new Stock({
      company,
      description,
      initial_price,
      price_2002,
      price_2007,
      symbol,
    });
    await stock.save(); // store in database
    res.json({ message: "Stock added to watchlist successfully" });
  } catch (error) {
    console.error(error);
    res.status(500).json({ error: "Internal Server Error" });
  }
});

app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
