import * as CryptoJS from "crypto-js";
import ILinked from "../interface/ILinked";
class BlockLinked {
  public timestamp: Date;
  private hash: string;
  constructor(private prevHash: any, private data: ILinked) {
    this.timestamp = new Date();
    this.prevHash = prevHash;
    this.hash = this.calculateHash();
    this.data = data;
  }
  calculateHash(): string {
    return CryptoJS.SHA256(
      this.prevHash + JSON.stringify(this.data) + this.timestamp
    ).toString();
  }
  getHash(): string {
    return this.hash;
  }
}
export default BlockLinked;
