const hash = require("crypto-js/sha256");
class Block {
  constructor(preHash, data) {
    this.preHash = preHash;
    this.data = data;
    this.timestamp = new Date();
    this.hash = this.calculateHash();
    this.mineVar = 0;
  }
  calculateHash() {
    return hash(
      this.preHash + JSON.stringify(this.data) + this.timestamp + this.myVar
    ).toString();
  }
  // mine block
  mine(difficulty) {
    while (!this.hash.startsWith("0".repeat(difficulty))) {
      this.mineVar += 1;
      this.hash = this.calculateHash();
    }
  }
}
class BlockChain {
  constructor(difficulty) {
    const genesisBlock = new Block("0000", { isGenesis: true });
    this.difficulty = difficulty;
    this.chain = [genesisBlock];
  }
  getLastBlock() {
    return this.chain[this.chain.length - 1];
  }
  addBlock(data) {
    const lastBlock = this.getLastBlock();
    const newBlock = new Block(lastBlock.hash, data);
    console.log("start mining");
    console.time("mine");
    newBlock.mine(this.difficulty);
    console.timeEnd("mine");
    this.chain.push(newBlock);
  }
  isValid() {
    for (let i = 1; i < this.chain.length; i++) {
      const currentBlock = this.chain[i];
      const prevBlock = this.chain[i - 1];
      if (currentBlock.hash !== currentBlock.calculateHash()) {
        return false;
      }
      if (currentBlock.hash !== prevBlock.hash) {
        return false;
      }
    }
    return true;
  }
}
const myBlockchain = new BlockChain(5);
console.log(myBlockchain);

myBlockchain.addBlock({
  from: "Huy",
  to: "Thuy",
  amount: 500,
});
myBlockchain.addBlock({
  from: "Thuy",
  to: "Kin",
  amount: 400,
});
myBlockchain.addBlock({
  from: "Kin",
  to: "Son",
  amount: 100,
});
console.log(myBlockchain.chain);
