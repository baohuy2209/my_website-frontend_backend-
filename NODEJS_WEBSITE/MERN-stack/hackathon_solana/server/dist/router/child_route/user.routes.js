"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const router = express_1.default.Router();
const user_controller_1 = __importDefault(require("../../app/controller/user.controller"));
const verifyToken_1 = __importDefault(require("../../app/middleware/verifyToken"));
router.use(function (req, res, next) {
    res.header("Access-Control-Allow-Headers", "Origin, Content-Type, Accept");
    next();
});
router.get("/all", user_controller_1.default.allAccess);
router.get("/moderator", [verifyToken_1.default.verifyToken, verifyToken_1.default.isModerator], user_controller_1.default.moderatorBoard);
router.get("/admin", [verifyToken_1.default.verifyToken, verifyToken_1.default.isAdmin], user_controller_1.default.adminBoard);
router.get("/", [verifyToken_1.default.verifyToken], user_controller_1.default.userBoard);
exports.default = router;
