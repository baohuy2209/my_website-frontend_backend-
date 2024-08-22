// console.log("This is nodejs tutorial");
// const _ = require("lodash");
// const arr = [1, 4, 6, 8];
// console.log(_.chunk(arr));
// const cowsay = require("cowsay");
// console.log(
//   cowsay.say({
//     text: "I am learning NodeJs",
//     e: "00",
//     t: "U",
//   })
// );
const { ford, tesla } = require("./car");
console.log(JSON.stringify(ford, null, 3));
console.log(JSON.stringify(tesla, undefined, 2));
