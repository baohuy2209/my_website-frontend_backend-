class CartController {
  show_cart(req, res) {
    res.render("cart");
  }
}

module.exports = new CartController();
