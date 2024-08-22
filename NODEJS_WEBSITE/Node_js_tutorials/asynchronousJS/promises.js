const promise = new Promise((resolve, reject) => {
  console.log("Async task execution");
  throw "err";
  if (false) {
    const person = { name: "Bao Huy" };
    resolve(person);
  } else {
    const error = { errCode: "1001" };
    reject(error);
  }
});
promise
  .then((val) => {
    console.log(val);
  })
  .catch((err) => {
    console.log(err);
  })
  .finally(() => {
    console.log("clean up");
  });

let p = Promise.resolve("execution is done");
// let p = Promise.reject("execution is reject");
p.then((val) => {
  console.log(val);
});

function asyncTask() {
  return Promise.resolve();
}
const name = "Bao Huy";
asyncTask().then(() => console.log(name));

const p = Promise.resolve("done");
p.then((val) => {
  console.log(val);
  return "done2";
}).then((val) => {
  console.log(val);
});

const makeApiCall = (time) => {
  return new Promise((resolve, reject) => {
    setTimeout(() => {
      resolve("This API executed in: " + time);
    }, time);
  });
};
let multiApiCall = [makeApiCall(1000), makeApiCall(2000), makeApiCall(500)];
Promise.all(multiApiCall).then((values) => {
  console.log(values);
});
Promise.race(multiApiCall).then((value) => {
  console.log(value);
});
