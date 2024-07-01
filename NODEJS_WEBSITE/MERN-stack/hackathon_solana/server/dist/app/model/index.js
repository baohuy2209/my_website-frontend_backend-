"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const user_model_1 = __importDefault(require("./user.model"));
const role_model_1 = __importDefault(require("./role.model"));
const student_model_1 = __importDefault(require("./student.model"));
const db = {
    role: role_model_1.default,
    user: user_model_1.default,
    student: student_model_1.default,
    ROLES: ["user", "admin", "moderator"],
};
exports.default = db;
