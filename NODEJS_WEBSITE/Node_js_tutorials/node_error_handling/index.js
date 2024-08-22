const path = require("path");
const filePath =
  "NODEJS_WEBSITE/Node_js_tutorials/node_error_handling/files/sample.txt";
// // dirname
// console.log(path.dirname(filePath));
// console.log(__dirname);
// // basename
// console.log(path.basename(filePath));
// console.log(__filename);
// // extension
// console.log(path.extname(filePath));
// const sampleFile = "sample.txt";
// console.log(path.join(path.dirname(filePath)), sampleFile);
const fs = require("fs");
const fsPromise = require("fs").promises;
// Reading from a file - Async
// fs.readFile(filePath, "utf-8", (err, data) => {
//   if (err) {
//     throw new Error("Something went wrong !");
//   }
//   console.log(data.toString());
// });

// try {
//   const data = fs.readFileSync(
//     path.join(__dirname, "files", "sample.txt"),
//     "utf-8"
//   );
//   console.log(data);
// } catch (err) {
//   console.log(error);
// }
const filereading = async () => {
  try {
    const data = await fsPromise.readFile(filePath, { encoding: "utf-8" });
    console.log("FS PROMISES: ", data);
  } catch (err) {
    console.log(err);
  }
};
filereading();
// Writing into file
const txtFile = path.join(__dirname, "files", "text.txt");
const content = "I love this nodejs tutorial series";
// fs.writeFile(txtFile, content, (err) => {
//   if (err) {
//     throw new Error("Something went wrong !");
//   }
//   console.log("Write operation completed successfully !!!");
//   fs.readFile(txtFile, "utf-8", (err, data) => {
//     if (err) {
//       throw new Error("Something went wrong !");
//     }
//     console.log(data);
//   });
// });

const writingInFile = async () => {
  try {
    await fsPromise.writeFile(txtFile, "\n It's Awesome!", {
      flag: "a+",
    });
    // await fsPromise.appendFile(txtFile, "\n This is file rendered");
    await fs.promises.rename(txtFile, path.join(__dirname, "files", "new.txt"));
    const data = await fsPromise.readFile(txtFile);
    console.log(data.toString());
  } catch (error) {
    console.log(error);
  }
};
writingInFile();
