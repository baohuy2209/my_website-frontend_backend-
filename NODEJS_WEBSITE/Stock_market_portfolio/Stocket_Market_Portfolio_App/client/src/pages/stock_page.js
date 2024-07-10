import React, { useState, useEffect } from "react";
import axios from "axios";
const Stocks = ({ addToWatchlist }) => {
  const [stocks, setStocks] = useState([]);
  const [reload, setReload] = useState(false);
  const updateReloadState = () => {
    setReload(true);
  };
  const fetchTableData = async () => {
    const response = await axios.get("http://localhost:5000/api/stocks");
    setStocks(response.data);
    setReload(false);
  };
  useEffect(() => {
    fetchTableData();
  }, [reload]);
  console.log(setStocks, "Stocksdata");

  const getRandomColor = () => {
    const colors = ["#FF0000", "#00FF00"];
    return colors[Math.floor(Math.random() * colors.length)];
  };

  return (
    <div className="App">
      <h1>Stock Market MERN App</h1>
      <h2>Stocks</h2>
      <ul>
        {stocks.map((stock) => {
          return (
            <li key={stock.symbol}>
              {stock.company} ({stock.symbol}) -
              <span style={{ color: getRandomColor() }}>
                {" "}
                ${stock.initial_price}
              </span>
              <button onClick={() => addToWatchlist(stock)}>
                Add to My Watchlist
              </button>
            </li>
          );
        })}
      </ul>
    </div>
  );
};

export default Stocks;
