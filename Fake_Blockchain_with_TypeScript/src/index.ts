import UOB from "./Banks/UOB/index";
import VCB from "./Banks/VietCombank/index";
import BlockChain_LinkBank from "./BlockChain/Blockchain_LinkBanked";
import BlockLinked from "./BlockChain/Block/BlockLinked";
import CryptoJS from "crypto-js";
import ILinked from "./BlockChain/interface/ILinked";
const hashCentralBank = CryptoJS.SHA256("3%ETReqwTQET").toString();
const primitiveData: ILinked = {
  isLinked: true,
  Bank: "Central Bank",
};
const UOBLinked: ILinked = {
  isLinked: true,
  Bank: "UOB",
};
const VCBLinked: ILinked = {
  isLinked: true,
  Bank: "VietComBank",
};
const blockchainLinkedBank = new BlockChain_LinkBank();
blockchainLinkedBank.addBlock(primitiveData);
blockchainLinkedBank.addBlock(UOBLinked);
blockchainLinkedBank.addBlock(VCBLinked);
