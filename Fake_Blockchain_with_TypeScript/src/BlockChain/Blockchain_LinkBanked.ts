import BlockLinked from "./Block/BlockLinked";
import ILinked from "./interface/ILinked";
class BlockChain_LinkBank {
  chain: BlockLinked[];
  constructor() {
    this.chain = [];
  }
  getLastBlock(): BlockLinked {
    return this.chain[this.chain.length - 1];
  }
  addBlock(data: ILinked): void {
    const lastBank = this.getLastBlock();
    const newBank = new BlockLinked(lastBank.getHash(), data);
    this.chain.push(newBank);
  }
  isValid(): boolean {
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
export default BlockChain_LinkBank;
