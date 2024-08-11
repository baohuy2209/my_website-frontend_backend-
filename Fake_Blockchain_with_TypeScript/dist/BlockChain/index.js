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
    /**
     *
     */
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
// Khởi tạo chuỗi khối tượng trương cho tập hợp các khách hàng đang sử dụng dịch vụ chuyển tiền tại một ngân hàng
class Management_User {
    constructor(difficulty) {
        const genesisBlock = new BlockUser("0000", dataUser);
        this.difficulty = difficulty;
        this.chain = [genesisBlock]; // khởi tạo khách hàng đầu tiên trong chuỗi khối các khách hàng
    }
    /**
     * Lấy khối cuối cùng trong chuỗi khối các khách hàng
     */
    getLastBlock() {
        return this.chain[this.chain.length - 1];
    }
    /**
     * Nếu như có một khách hàng mới đăng kí dịch vụ tại khách hàng, chúng ta add một block mới vào trong chuỗi đã có
     */
    addBlock(data) {
        const lastBlock = this.getLastBlock();
        const newBlock = new BlockUser(lastBlock.getHash(), data);
        console.log("start mining");
        console.time("mine");
        newBlock.mine(this.difficulty);
        console.timeEnd("mine");
        this.chain.push(newBlock);
    }
    /**
     * Kiểm tra tính hợp lệ của blockchain trong các trường hợp :
     *  - Nếu như có trường hợp một block sinh ra dữ liệu hash khác với hash đã có thì blockchain đó không hợp lệ.
     * Điều này đồng nghĩa với việc blockchain đó đã bị hacker hay người ngoài tấn công và thay đổi dữ liệu
     * - Nếu như có trường hợp thuộc tính prevHash của một Block khác với hash của Block trước đó thì điều đó có nghĩa là
     * blockchain đó đõ bị tấn công hoặc thay đổi dữ liệu
     */
    isValid() {
        for (let i = 1; i < this.chain.length; i++) {
            const currentBlock = this.chain[i];
            const prevBlock = this.chain[i - 1];
            if (currentBlock.getHash() !== currentBlock.calculateHash()) {
                return false;
            }
            if (currentBlock.getHash() !== prevBlock.getHash()) {
                return false;
            }
        }
        return true;
    }
}
exports.default = Management_User;
