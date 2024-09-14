class UserController {
  // [GET] /api/test/all
  getPublicContent = (req, res) => {
    res.status(200).send("Public content");
  };
  // [GET] /api/test/user
  getUserBoard = (req, res) => {
    res.status(200).send("User content");
  };
  // [GET] /api/test/mod
  getModeratorBoard = (req, res) => {
    res.status(200).send("Admin content");
  };
  // [GET] /api/test/admin
  getAdminBoard = (req, res) => {
    res.status(200).send("Moderator content");
  };
}
module.exports = new UserController();
