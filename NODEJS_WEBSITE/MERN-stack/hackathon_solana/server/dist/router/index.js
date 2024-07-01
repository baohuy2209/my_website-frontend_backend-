"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const auth_routes_1 = __importDefault(require("./child_route/auth.routes"));
const user_routes_1 = __importDefault(require("./child_route/user.routes"));
function route(app) {
    app.use("/api/v1/auth", auth_routes_1.default);
    app.use("/api/v1/user", user_routes_1.default);
}
exports.default = route;
