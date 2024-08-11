"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const Blockchain_LinkBanked_1 = __importDefault(require("./BlockChain/Blockchain_LinkBanked"));
const crypto_js_1 = __importDefault(require("crypto-js"));
const hashCentralBank = crypto_js_1.default.SHA256("3%ETReqwTQET").toString();
const primitiveData = {
    isLinked: true,
    Bank: "Central Bank",
};
const UOBLinked = {
    isLinked: true,
    Bank: "UOB",
};
const VCBLinked = {
    isLinked: true,
    Bank: "VietComBank",
};
const blockchainLinkedBank = new Blockchain_LinkBanked_1.default();
blockchainLinkedBank.addBlock(primitiveData);
blockchainLinkedBank.addBlock(UOBLinked);
blockchainLinkedBank.addBlock(VCBLinked);
