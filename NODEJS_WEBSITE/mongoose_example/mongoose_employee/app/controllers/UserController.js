class UserController {
  // [GET] /api/user/all
  allAccess = (req, res) => {
    res.redirect("/api");
  };
  moderatorBoard = (req, res) => {
    res.redirect("/api/manage/stored/employee");
  };
  adminBoard = (req, res) => {
    res.redirect("/api/manage/stored/employee");
  };
  userBoard = (req, res) => {
    res.redirect("/api");
  };
}
module.exports = new UserController();
