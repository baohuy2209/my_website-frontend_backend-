function createStore(reducer) {
  let state = reducer(undefined, {});
  const subscribers = [];
  return {
    getState: () => {
      return state;
    },
    dispatch: (action) => {
      state = reducer(state, action);
      subscribers.forEach((subscriber) => subscriber());
    },
    subscribe: (subscriber) => {
      subscribers.push(subscriber);
    },
  };
}
module.exports = createStore;
