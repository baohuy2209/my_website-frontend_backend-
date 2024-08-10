import * as CryptoJS from "crypto-js";
// Định nghĩa interface chứa tất cả các miền dữ liệu thu nhập từ người dùng
interface IUser {
  fullName: string; // Họ và tên đầy đủ
  age: number; // Số tuổi
  email: string; // email của khách hàng
  gender: string; // giới tính
  phoneNumber: string; // số điện thoại
  dob: Date; // ngày tháng năm sinh
  dataFaceId: string; // dữ liệu được mã hóa thành chuỗi kí tự từ dữ liệu xác thực khuôn mặt
  dataFingerId: string; // dữ liệu được mã hóa thành chuỗi kí tự từ dữ liệu xác thực vân tay
  isGenesis: boolean; // trường dữ liệu xác định người dùng đầu tiên
  history_transaction: string[]; // trường dữ liệu lưu trữ lịch sử giao dịch của khách hàng
}
// Khởi tạo một block đại diện cho User
class BlockUser {
  public timestamp: Date; // thuộc tính lưu thời gian đăng ký dịch vụ giao dịch
  private hash: string; // thuộc tính lưu hash của một người người
  /**
   * hash là một chuỗi để nhận biết người dùng, coi như là đặc điểm nhận diện giữa các người dùng (các block)
   */
  private mineVar: number; // tạo một biến dữ liệu để tạo hash
  /**
   *
   */
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
    const genesisBlock = new BlockUser("0000", dataUser);
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
// Database điển hình minh họa cho khách hàng đăng ký sử dụng dịch vụ giao dịch tại ngân hàng
const dbUser: IUser[] = [
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
// Khởi tạo blockchain với độ khó là 256
const myBlockChain = new Management_User(256);
console.log(myBlockChain);
// thêm người dùng mới
for (let i = 0; i < dbUser.length; i++) {
  myBlockChain.addBlock(dbUser[i]);
}

console.log(myBlockChain);
