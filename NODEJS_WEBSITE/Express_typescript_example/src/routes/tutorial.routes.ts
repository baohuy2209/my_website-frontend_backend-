import { Router } from "express";
import TutorialController from "../controllers/tutorial.controller";
class TutorialRoutes {
  router = Router();
  controller = new TutorialController();
  constructor() {
    this.initializeRoutes();
  }
  initializeRoutes() {
    this.router.get("/", this.controller.findAll);
    this.router.post("/", this.controller.create);
    this.router.get("/:id", this.controller.findOne);
    this.router.put("/:id", this.controller.update);
    this.router.delete("/:id", this.controller.delete);
  }
}

export default new TutorialRoutes().router;
