const { getShowNavbar, setShowNavbar } = require("../constants/showNavbar");
const { getShowFooter, setShowFooter } = require("../constants/showFooter");
function showHeaderFooter(flag) {
  console.log(getShowNavbar());
  console.log(getShowFooter());
  if (flag) {
    setShowNavbar(flag);
    setShowFooter(flag);
    console.log(getShowNavbar());
    console.log(getShowFooter());
  }
}
module.exports = showHeaderFooter;
