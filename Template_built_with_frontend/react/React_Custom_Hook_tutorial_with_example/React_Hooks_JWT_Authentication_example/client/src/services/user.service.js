import http from "../http-common";
import authHeader from "./auth-header";
const getPublicContent = () => {
  return http.get("/test/all");
};
const getUserBoard = () => {
  return http.get("test/user", { headers: authHeader() });
};
const getModeratorBoard = () => {
  return http.get("test/mod", { headers: authHeader() });
};
const getAdminBoard = () => {
  return http.get("test/admin", { headers: authHeader() });
};
const UserService = {
  getPublicContent,
  getUserBoard,
  getModeratorBoard,
  getAdminBoard,
};
export default UserService;
