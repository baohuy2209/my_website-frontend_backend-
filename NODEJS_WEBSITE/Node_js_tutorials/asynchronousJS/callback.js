function asyncTask(cb) {
  setTimeout(() => {
    cb(null, "This is data from server");
  }, 0);
}
function makeApiCall(cb) {
  setTimeout(() => {
    console.log("This is async task execution");
  }, 0);
}
// ! This is callback hell
// makeApiCall(() => {
//     makeApiCall(() => {
//         asyncTask(() => {
//             asyncTask(() => {
//                 asyncTask(() => {

//                 })
//             })
//         })
//     })
// })
