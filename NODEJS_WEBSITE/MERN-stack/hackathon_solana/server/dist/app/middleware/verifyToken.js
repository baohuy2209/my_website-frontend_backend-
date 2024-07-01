"use strict";
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
const index_1 = __importDefault(require("../model/index"));
const verifyToken = (req, res, next) => __awaiter(void 0, void 0, void 0, function* () {
    const authorizationHeader = yield req.headers.authorization;
    if (authorizationHeader) {
        const token = authorizationHeader.split(" ")[1];
        jsonwebtoken_1.default.verify(token, "fwfwfwfwfwfwf", (err, data) => {
            console.log("verify >>>>>>", data);
            if (err) {
                return res.status(403).json("Token is not valid");
            }
            req.body = data;
            next();
        });
    }
    else {
        return res.status(401).json("You are not authenticated !");
    }
});
const isAdmin = (req, res, next) => {
    index_1.default.user
        .findById(req.body.id)
        .then((user) => {
        index_1.default.role
            .find({
            _id: { $in: user.roles },
        })
            .then((roles) => {
            for (let i = 0; i < roles.length; i++) {
                if (roles[i].name === "admin") {
                    next();
                    return;
                }
            }
            res.status(403).send({ message: "Require Admin Role" });
        })
            .catch((err) => {
            console.error("error", err);
            res.status(500).send({ message: err });
        });
    })
        .catch((err) => {
        console.log("error: ", err);
        res.status(500).send({ message: err });
    });
};
const isModerator = (req, res, next) => {
    index_1.default.user
        .findById(req.body.id)
        .then((user) => {
        index_1.default.role
            .find({
            _id: { $in: user.roles },
        })
            .then((roles) => {
            for (let i = 0; i < roles.length; i++) {
                if (roles[i].name === "moderator") {
                    next();
                    return;
                }
            }
            res.status(403).send({ message: "Require Moderator Role" });
        })
            .catch((err) => {
            console.error("error", err);
            res.status(500).send({ message: err });
        });
    })
        .catch((err) => {
        console.log("error: ", err);
        res.status(500).send({ message: err });
    });
};
exports.default = { verifyToken, isAdmin, isModerator };
