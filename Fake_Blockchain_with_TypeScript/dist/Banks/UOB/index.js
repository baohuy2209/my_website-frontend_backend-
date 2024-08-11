"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const BlockChain_ManageUser_1 = __importDefault(require("../../BlockChain/BlockChain_ManageUser"));
const db_1 = __importDefault(require("./database/db"));
// Khởi tạo blockchain với độ khó là 256. Độ khó này có thể thay đổi tùy ý
/**
 * Tượng trưng BlockChain của ngân hàng UOB
 */
const UOBBlockChain = new BlockChain_ManageUser_1.default(256);
console.log(UOBBlockChain);
// thêm người dùng mới
for (let i = 0; i < db_1.default.length; i++) {
    UOBBlockChain.addBlock(db_1.default[i]);
}
exports.default = UOBBlockChain;
