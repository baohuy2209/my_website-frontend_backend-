const utils = require("../utils/utils");
const current_user = (req, res, next) => {
  const userId = req.cookies ? req.cookies.userId : undefined;
  if (!userId) {
    res.cookie("user_id", utils.uid(32));
  }
};
module.exports = current_user;
