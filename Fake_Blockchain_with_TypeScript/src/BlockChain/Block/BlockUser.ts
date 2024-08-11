import IUser from "../interface/IUser";
import * as CryptoJS from "crypto-js";

// Khởi tạo một block đại diện cho User
class BlockUser {
  public timestamp: Date; // thuộc tính lưu thời gian đăng ký dịch vụ giao dịch
  private hash: string; // thuộc tính lưu hash của một người người
  /**
   * hash là một chuỗi để nhận biết người dùng, coi như là đặc điểm nhận diện giữa các người dùng (các block)
   */
  private mineVar: number; // tạo một biến dữ liệu để tạo hash

  constructor(private preHash: any, private data: IUser) {
    this.preHash = preHash;
    this.data = data;
    this.timestamp = new Date();
    this.hash = this.calculateHash();
    this.mineVar = 0;
  }
  // hàm tạo hash từ 3 thuộc tính preHash, timestamp, data của một khối block
  calculateHash(): string {
    return CryptoJS.SHA256(
      this.preHash + JSON.stringify(this.data) + this.timestamp + this.mineVar
    ).toString();
  }
  // hàm tạo block với độ khó difficult
  /**
   * Bởi vì nếu không có biến difficult để tăng độ khó khi hash ra các khối block khác
   * thì khi một block bị người khác chiếm giữ và thay đổi thay thông tin thì người đó rất dễ chạy lại hash của tất cả
   * các block khác vì tốc độ của hàm hash rất nhanh
   */
  mine(difficult: number): void {
    /**
     * Từ Block đầu tiên chúng ta sẽ tạo ra các khối block  khác
     */
    while (!this.hash.startsWith("0".repeat(difficult))) {
      this.mineVar += 1;
      this.hash = this.calculateHash();
    }
  }
  getHash(): string {
    return this.hash;
  }
}
export default BlockUser;
