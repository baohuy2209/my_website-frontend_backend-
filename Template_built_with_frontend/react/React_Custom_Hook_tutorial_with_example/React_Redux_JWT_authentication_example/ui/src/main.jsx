import { createRoot } from "react-dom/client";
import { Provider } from "react-redux";
import App from "./App.jsx";
import store from "./store.js";
import "./index.css";
import { BrowserRouter } from "react-router-dom";

createRoot(document.getElementById("root")).render(
  <Provider store={store}>
    <BrowserRouter>
      <App />
    </BrowserRouter>
  </Provider>
);
