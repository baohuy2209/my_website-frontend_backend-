"use strict";
var __createBinding = (this && this.__createBinding) || (Object.create ? (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    var desc = Object.getOwnPropertyDescriptor(m, k);
    if (!desc || ("get" in desc ? !m.__esModule : desc.writable || desc.configurable)) {
      desc = { enumerable: true, get: function() { return m[k]; } };
    }
    Object.defineProperty(o, k2, desc);
}) : (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    o[k2] = m[k];
}));
var __setModuleDefault = (this && this.__setModuleDefault) || (Object.create ? (function(o, v) {
    Object.defineProperty(o, "default", { enumerable: true, value: v });
}) : function(o, v) {
    o["default"] = v;
});
var __importStar = (this && this.__importStar) || function (mod) {
    if (mod && mod.__esModule) return mod;
    var result = {};
    if (mod != null) for (var k in mod) if (k !== "default" && Object.prototype.hasOwnProperty.call(mod, k)) __createBinding(result, mod, k);
    __setModuleDefault(result, mod);
    return result;
};
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const jsonwebtoken_1 = __importDefault(require("jsonwebtoken"));
const bcrypt_1 = __importStar(require("bcrypt"));
const index_1 = __importDefault(require("../app/model/index"));
require("dotenv/config");
const salt = (0, bcrypt_1.genSaltSync)(10);
// encoded the password
const hashUserPassword = (userPassword) => {
    let hashPassword = bcrypt_1.default.hashSync(userPassword, salt);
    return hashPassword;
};
// check password that the password which is entered from the keyboard is the same as the password which is stored in the database
const checkPassword = (inputPassword, hashPassword) => {
    return bcrypt_1.default.compare(inputPassword, hashPassword);
};
// function to get user from logging in
const getUserLogin = (userName) => __awaiter(void 0, void 0, void 0, function* () {
    let user = null;
    user = yield index_1.default.user.findOne({
        username: userName,
    });
    return user;
});
const checkEmailExist = (email) => __awaiter(void 0, void 0, void 0, function* () {
    let user = null;
    user = yield index_1.default.user.findOne({
        email: email,
    });
    if (user == null) {
        return false; // this email does not exist
    }
    else {
        return true;
    }
});
const handleRegister = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    const { username, password, email, phone } = req.body;
    try {
        let isEmailExist = yield checkEmailExist(email);
        if (isEmailExist) {
            return { EM: "Email hasn't already existed", EC: -2, DT: [] };
        }
        let hashPassword = hashUserPassword(password);
        let newUser = null;
        if (username != null &&
            hashPassword != null &&
            email != null &&
            phone != null) {
            newUser = {
                username: username,
                password: hashPassword,
                email: email,
                phone: phone,
            };
        }
        const data = new index_1.default.user(newUser);
        data
            .save()
            .then(() => {
            return {
                EM: "Register successfully",
                EC: 0,
                DT: data,
            };
        })
            .catch((err) => {
            console.log("error: ", err);
            return {
                EM: "Data don't store in database",
                EC: -2,
                DT: [],
            };
        });
    }
    catch (error) {
        console.log(">>> err", error);
        return {
            EM: "The server is having an error!",
            EC: -5,
            DT: [],
        };
    }
});
const handleLogin = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const user = yield getUserLogin(req.body.username);
        if (user === null) {
            return {
                EM: "Login failed",
                EC: -2,
                DT: [],
            };
        }
        var user_password = user.password;
        let isCorrectPassword = yield checkPassword(req.body.password, user_password);
        if (isCorrectPassword) {
            let tokenData = {
                id: user.id,
                username: user.username,
                phone: user.phone,
                email: user.email,
            };
            const accessToken = jsonwebtoken_1.default.sign(tokenData, "fwfwfwfwfwfwf", {
                expiresIn: "60s",
            });
            const refreshToken = jsonwebtoken_1.default.sign(tokenData, "sfwfwfwgfwgwfwf");
            index_1.default.student.findByIdAndUpdate(user.id, { refresh_token: refreshToken });
            return {
                EM: "ok",
                EC: 0,
                DT: {
                    tokenData,
                    accessToken: accessToken,
                    refreshToken: refreshToken,
                },
            };
        }
        else {
            return {
                EM: "Login information is incorrect",
                EC: -2,
                DT: [],
            };
        }
    }
    catch (error) {
        console.log("error: ", error);
        return {
            EM: "The Server is having an error",
            EC: -5,
            DT: [],
        };
    }
});
exports.default = { handleLogin, handleRegister };
