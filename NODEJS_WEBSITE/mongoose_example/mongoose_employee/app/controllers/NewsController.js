class NewsController {
  index(req, res) {
    res.render("news/home");
  }
}
module.exports = new NewsController();
