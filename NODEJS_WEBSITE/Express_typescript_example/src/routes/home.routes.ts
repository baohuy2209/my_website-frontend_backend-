import { Router } from "express";
import Welcome from "../controllers/home.controller";
class HomeRoutes {
  router = Router();
  constructor() {
    this.initializeRoutes();
  }
  initializeRoutes() {
    this.router.get("/", Welcome);
  }
}
export default new HomeRoutes().router;
