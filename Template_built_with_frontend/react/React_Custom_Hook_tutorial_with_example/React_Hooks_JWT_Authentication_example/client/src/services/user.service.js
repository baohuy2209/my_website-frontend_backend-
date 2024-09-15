import axios from "axios";
import authHeader from "./auth-header";
const baseURL = "http://localhost:8080/api/test";
const getPublicContent = () => {
  return axios.get(baseURL + "/all");
};
const getUserBoard = () => {
  return axios.get(baseURL + "/user", { headers: authHeader() });
};
const getModeratorBoard = () => {
  return axios.get(baseURL + "/mod", { headers: authHeader() });
};
const getAdminBoard = () => {
  return axios.get(baseURL + "/admin", { headers: authHeader() });
};
const UserService = {
  getPublicContent,
  getUserBoard,
  getModeratorBoard,
  getAdminBoard,
};
export default UserService;
