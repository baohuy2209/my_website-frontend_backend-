import React from "react";
const WatchList = ({ watchList }) => {
  const getRandomColor = () => {
    const colors = ["#FF0000", "#00FF00"];
    return colors[Math.floor(Math.random() * colors.length)];
  };
  return (
    <div className="App">
      <h1>Stock Market MERN App</h1>
      <h2>My WatchList</h2>
      <ul>
        {watchList.map((stock) => {
          return (
            <li key={stock.symbol}>
              {stock.company} ({stock.symbol}) -
              <span style={{ color: getRandomColor() }}>
                {" "}
                ${stock.initial_price}
              </span>
            </li>
          );
        })}
      </ul>
    </div>
  );
};
export default WatchList;
