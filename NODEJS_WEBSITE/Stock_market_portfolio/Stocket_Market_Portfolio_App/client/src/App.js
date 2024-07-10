import "./App.css";
import React, { useState } from "react";
import Stocks from "./pages/stock_page";
import Watchlist from "./pages/watchlist_page";
import axios from "axios";
import {
  BrowserRouter as Router,
  Routes,
  Route,
  NavLink,
} from "react-router-dom";
function App() {
  const [watchlist, setWatchlist] = useState([]);
  const addToWatchlist = (stock) => {
    axios
      .post("http://localhost:5000/api/watchlist")
      .then((response) => {
        alert(response.data);
        setWatchlist([...watchlist, stock]);
      })
      .catch((error) => {
        console.error("Error adding to watchlist: ", error);
      });
  };
  return (
    <Router>
      <nav>
        <NavLink to="/stocks">Stocks</NavLink>
        <NavLink to="/watchlist">Watchlist</NavLink>
      </nav>
      <Routes>
        <Route
          path="/stocks"
          element={<Stocks addToWatchlist={addToWatchlist} />}
        />
        <Route
          path="/watchlist"
          element={<Watchlist watchList={watchlist} />}
        />
      </Routes>
    </Router>
  );
}

export default App;
