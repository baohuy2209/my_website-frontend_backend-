import "./App.css";
import "bootstrap/dist/css/bootstrap.min.css";
import React, { Component } from "react";
import { Link, Routes, Route } from "react-router-dom";
import TutorialList from "./components/tutorials-list.component";
import AddTutorial from "./components/add-tutorial.component";
import Tutorial from "./components/tutorial.component";
class App extends Component {
  render() {
    return (
      <div>
        <nav className="navbar navbar-expand navbar-dark bg-dark">
          <a href="/tutorials" className="px-2 navbar-brand">
            Bao Huy
          </a>
          <div className="navbar-nav mr-auto">
            <li className="nav-item">
              <Link to={"/tutorials"} className="nav-link">
                Tutorials
              </Link>
            </li>
            <li className="nav-item">
              <Link to={"/add"} className="nav-link">
                Add
              </Link>
            </li>
          </div>
        </nav>
        <div className="container mt-3">
          <Routes>
            <Route path="/" element={<TutorialList />} />
            <Route path="/tutorials" element={<TutorialList />} />
            <Route path="/add" element={<AddTutorial />} />
            <Route path="/tutorials/:id" element={<Tutorial />} />
          </Routes>
        </div>
      </div>
    );
  }
}
// https://www.bezkoder.com/react-node-express-mongodb-mern-stack/#Project_Structure
export default App;
