import axios from "axios";
import authHeader from "./auth-header";
const API_URL = "http://localhost:8080/test/";
const getPublicContent = () => {
  return axios.get(API_URL + "all");
};

const getUserBoard = () => {
  return axios.get(API_URL + "user", { header: authHeader() });
};
const getModerateBoard = () => {
  return axios.get(API_URL + "mod", { header: authHeader() });
};
const getAdminBoard = () => {
  return axios.get(API_URL + "admin", { header: authHeader() });
};
const UserService = {
  getPublicContent,
  getUserBoard,
  getModerateBoard,
  getAdminBoard,
};
export default UserService;
