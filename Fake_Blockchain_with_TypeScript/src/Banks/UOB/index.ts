import Management_User from "../../BlockChain/BlockChain_ManageUser";
import dbUser from "./database/db";
// Khởi tạo blockchain với độ khó là 256. Độ khó này có thể thay đổi tùy ý
/**
 * Tượng trưng BlockChain của ngân hàng UOB
 */
const UOBBlockChain = new Management_User(256);
console.log(UOBBlockChain);
// thêm người dùng mới
for (let i = 0; i < dbUser.length; i++) {
  UOBBlockChain.addBlock(dbUser[i]);
}
export default UOBBlockChain;
