const { getShowNavbar } = require("./showNavbar");
let isAuthenticated = false;
function setIsAuthenticated() {
  if (getShowNavbar) {
    isAuthenticated = true;
  }
}
function getAuthenticated() {
  setIsAuthenticated();
  return isAuthenticated;
}
module.exports = { getAuthenticated, setIsAuthenticated };
