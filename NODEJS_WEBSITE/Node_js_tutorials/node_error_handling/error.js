// Error Object
// const error = new Error("Something went wrong !!");
// // console.log(error.stack); // Something went wrong !!
// throw new Error("I am error object");

const { CustomError } = require("./CustomError");
// throw new CustomError("This osa custom error");

// handle exception using try and catch
// try {
//   doSomething();
// } catch (err) {
//   console.log("Error occured");
//   console.log(err);
// }
function doSomething() {
  const data = fetch("localhost:3000/api");
  //   console.log("I am from doFunction");
  //   const data = "I am from doFunction";
  return data;
}
// process.on("uncaughtexception", (err) => {
//   console.log("There was an uncaught exception");
//   process.exit(1);
// });
// doSomething();
// exception with promise
// const promises = new Promise((resolve, reject) => {
//   if (true) {
//     resolve(doSomething());
//   } else {
//     reject(doSomething());
//   }
// });
// promises
//   .then((val) => {
//     console.log(val);
//   })
//   .catch((err) => {
//     console.log("Error occured");
//     console.log(err);
//   });

const someFunction = async () => {
  try {
    await doSomething();
  } catch (err) {
    throw new CustomError(err.message);
  }
};
someFunction();
