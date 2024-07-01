"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const router = express_1.default.Router();
const verifyToken_1 = __importDefault(require("../../app/middleware/verifyToken"));
const auth_controller_1 = __importDefault(require("../../app/controller/auth.controller"));
router.post("/register", auth_controller_1.default.register);
router.post("/login", auth_controller_1.default.login);
router.post("/logout", auth_controller_1.default.logout);
router.get("fetchProfile", auth_controller_1.default.fetchProfile);
router.post("/refresh", auth_controller_1.default.refresh);
router.get("/test", verifyToken_1.default.verifyToken, auth_controller_1.default.test);
exports.default = router;
