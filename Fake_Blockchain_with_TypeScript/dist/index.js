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
Object.defineProperty(exports, "__esModule", { value: true });
const CryptoJS = __importStar(require("crypto-js"));
class BlockUser {
    constructor(preHash, data) {
        this.preHash = preHash;
        this.data = data;
        this.preHash = preHash;
        this.data = data;
        this.timestamp = new Date();
        this.hash = this.calculateHash();
        this.mineVar = 0;
    }
    calculateHash() {
        return CryptoJS.SHA256(this.preHash + JSON.stringify(this.data) + this.timestamp + this.mineVar).toString();
    }
    mine(difficult) {
        while (!this.hash.startsWith("0".repeat(difficult))) {
            this.mineVar += 1;
            this.hash = this.calculateHash();
        }
    }
}
const dataUser = {
    fullName: "Nguyen Bao Huy",
    age: 20,
    email: "huynguyen002311@gmail.com",
    gender: "male",
    phoneNumber: "0123456789",
    dob: new Date("22-09-2005"),
    dataFaceId: "12@432ErrTGreg34trgfg",
    dataFingerId: "DTWERT45636ewrty",
    isGenesis: true,
    history_transaction: [],
};
class Management_User {
    constructor(difficulty) {
        const genesisBlock = new BlockUser("0000", dataUser);
        this.difficulty = difficulty;
        this.chain = [genesisBlock];
    }
    getLastBlock() {
        return this.chain[this.chain.length - 1];
    }
    addBlock(data) {
        const lastBlock = this.getLastBlock();
        const newBlock = new BlockUser(lastBlock.hash, data);
        console.log("start mining");
        console.time("mine");
        newBlock.mine(this.difficulty);
        console.timeEnd("mine");
        this.chain.push(newBlock);
    }
    isValid() {
        for (let i = 1; i < this.chain.length; i++) {
            const currentBlock = this.chain[i];
            const prevBlock = this.chain[i - 1];
            if (currentBlock.hash !== currentBlock.calculateHash()) {
                return false;
            }
            if (currentBlock.hash !== prevBlock.hash) {
                return false;
            }
        }
        return true;
    }
}
const dbUser = [
    {
        fullName: "Nguyen Thi Bao Trang",
        age: 19,
        email: "baotrang@gmail.com",
        gender: "female",
        phoneNumber: "234132514545",
        dob: new Date("24-11-2005"),
        dataFaceId: "EWT@#et234r!$t@#$T5hrgw",
        dataFingerId: "RQT3453rtqrt%!53reWERy",
        isGenesis: false,
        history_transaction: [],
    },
    {
        fullName: "Nguyen Truong Son",
        age: 19,
        email: "sontruong@gmail.com",
        gender: "male",
        phoneNumber: "23123214314165",
        dob: new Date("24-11-2005"),
        dataFaceId: "%!$%RTGQTRT#$TẺGFg",
        dataFingerId: "RQT3453rtqrt%!53reWERy",
        isGenesis: false,
        history_transaction: [],
    },
    {
        fullName: "Tran Xu Kin",
        age: 19,
        email: "kinxug@gmail.com",
        gender: "male",
        phoneNumber: "013043210502",
        dob: new Date("06-05-2005"),
        dataFaceId: "#$@#TRGHWE@$THGRrygw3$56treg5",
        dataFingerId: "$#%Rtgq4t#$5tGY#@RGHwerGH",
        isGenesis: false,
        history_transaction: [],
    },
    {
        fullName: "Nguyen Hoang Yen",
        age: 19,
        email: "hoangyen@gmail.com",
        gender: "female",
        phoneNumber: "315451312535",
        dob: new Date("21-3-2005"),
        dataFaceId: "QWE%!3245reqwQtg#$5$#re",
        dataFingerId: "3%!$t31$tregq34TQrt43",
        isGenesis: false,
        history_transaction: [],
    },
];
const myBlockChain = new Management_User(0);
console.log(myBlockChain);
for (let i = 0; i < dbUser.length; i++) {
    myBlockChain.addBlock(dbUser[i]);
}
console.log(myBlockChain);
