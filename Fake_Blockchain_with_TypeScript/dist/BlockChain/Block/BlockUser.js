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
// Khởi tạo một block đại diện cho User
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
    // hàm tạo hash từ 3 thuộc tính preHash, timestamp, data của một khối block
    calculateHash() {
        return CryptoJS.SHA256(this.preHash + JSON.stringify(this.data) + this.timestamp + this.mineVar).toString();
    }
    // hàm tạo block với độ khó difficult
    /**
     * Bởi vì nếu không có biến difficult để tăng độ khó khi hash ra các khối block khác
     * thì khi một block bị người khác chiếm giữ và thay đổi thay thông tin thì người đó rất dễ chạy lại hash của tất cả
     * các block khác vì tốc độ của hàm hash rất nhanh
     */
    mine(difficult) {
        /**
         * Từ Block đầu tiên chúng ta sẽ tạo ra các khối block  khác
         */
        while (!this.hash.startsWith("0".repeat(difficult))) {
            this.mineVar += 1;
            this.hash = this.calculateHash();
        }
    }
    getHash() {
        return this.hash;
    }
}
exports.default = BlockUser;
