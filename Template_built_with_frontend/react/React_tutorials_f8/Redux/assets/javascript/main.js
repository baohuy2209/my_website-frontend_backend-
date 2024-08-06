import { createStore } from "https://cdn.skypack.dev/redux";
const initialState = 0;
// Reducer
function reducer(state = initialState, action) {
  switch (action.type) {
    case "DEPOSIT":
      return state + action.payload;
    case "WITHDRAW":
      return state - action.payload;
    default:
      return state;
  }
}
// store
let store = (window.store = createStore(reducer));
window.store = createStore(reducer);
// Actions
function actionDeposit(cost) {
  return {
    type: "DEPOSIT",
    payload: cost,
  };
}
function actionWithdraw(cost) {
  return {
    type: "WITHDRAW",
    payload: cost,
  };
}
// DOM event s
const deposit = document.querySelector("#deposit");
const withdraw = document.querySelector("#withdraw");

// Event handler
deposit.onclick = function () {
  store.dispatch(actionDeposit(10));
};
withdraw.onclick = function () {
  store.dispatch(actionWithdraw(10));
};

// Listener
store.subscribe(() => {
  render();
});

// Render
function render() {
  const output = document.querySelector("#output");
  output.innerText = store.getState();
}
