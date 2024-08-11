"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const BlockLinked_1 = __importDefault(require("./Block/BlockLinked"));
class BlockChain_LinkBank {
    constructor() {
        this.chain = [];
    }
    getLastBlock() {
        return this.chain[this.chain.length - 1];
    }
    addBlock(data) {
        const lastBank = this.getLastBlock();
        const newBank = new BlockLinked_1.default(lastBank.getHash(), data);
        this.chain.push(newBank);
    }
    isValid() {
        for (let i = 1; i < this.chain.length; i++) {
            const currentBank = this.chain[i];
            const prevBank = this.chain[i - 1];
            if (currentBank.getHash() !== currentBank.calculateHash()) {
                return false;
            }
            if (currentBank.getHash() !== prevBank.getHash()) {
                return false;
            }
        }
        return true;
    }
}
exports.default = BlockChain_LinkBank;
