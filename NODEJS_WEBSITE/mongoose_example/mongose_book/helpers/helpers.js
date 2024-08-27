const { getShowNavbar } = require("../constants/showNavbar");
const { getShowFooter } = require("../constants/showFooter");
module.exports = {
  sum: (a, b) => a + b,
  showNavbar: getShowNavbar(),
  showFooter: getShowFooter(),
};
