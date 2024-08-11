import IUser from "./interface/IUser";
import BlockUser from "./Block/BlockUser";
const dataUser: IUser = {
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
  difficulty: number; // dùng để đảm bảo độ khó để hash lại các block khác khi có được thông tin của một block, hoặc thông tin của một block bị hack
  chain: BlockUser[]; // thuộc tính lưu các block trong một chuỗi
  constructor(difficulty: number) {
    /**
     * hash này được lấy từ hash gốc của ngân hàng trong chuỗi block liên kết giữa các ngân hàng
     */
    const hashBank = "UOBHASH"; // minh họa
    const genesisBlock = new BlockUser(hashBank, dataUser);
    this.difficulty = difficulty;
    this.chain = [genesisBlock]; // khởi tạo khách hàng đầu tiên trong chuỗi khối các khách hàng
  }
  /**
   * Lấy khối cuối cùng trong chuỗi khối các khách hàng
   */
  getLastBlock(): BlockUser {
    return this.chain[this.chain.length - 1];
  }
  /**
   * Nếu như có một khách hàng mới đăng kí dịch vụ tại khách hàng, chúng ta add một block mới vào trong chuỗi đã có
   */
  addBlock(data: IUser): void {
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
  isValid(): boolean {
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
export default Management_User;
