const Stock = require("../model/Stock.model");
class AppController {
  async getOneElement(req, res) {
    try {
      const stocks = await Stock.find();
      res.json(stocks);
    } catch (error) {
      console.error(error);
      res.status(500).json({ error: "Internal Server Err" });
    }
  }
  async postOneElement(req, res) {
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
      await stock.save();
      res.json({ message: "Stock added to watchlist successfully." });
    } catch (error) {
      console.log(error);
      res.status(500).json({ error: "Internal Server Error" });
    }
  }
}
module.exports = new AppController();
