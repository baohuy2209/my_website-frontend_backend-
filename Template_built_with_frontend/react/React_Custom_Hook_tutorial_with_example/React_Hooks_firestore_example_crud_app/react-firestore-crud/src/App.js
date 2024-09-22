import "./App.css";
import "bootstrap/dist/css/bootstrap.min.css";
import React from "react";
import TutorialsList from "./components/TutorialsList";
import AddTutorial from "./components/AddTutorial";
import { Switch, Route, Link } from "react-router-dom";
function App() {
  return (
    <div>
      <nav className="navbar navbar-expand navbar-dark bg-dark">
        <a href="/tutorials" className="navbar-brand">
          baoHuy
        </a>
        <div className="navbar-nav mr-auto">
          <li className="nav-item">
            <Link to={"/tutorial"} className="nav-link">
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
        <h2>React Hooks Firestore example</h2>
        <Switch>
          <Route exact path={["/", "/tutorials"]} component={TutorialsList} />
          <Route exact path="/add" component={AddTutorial} />
        </Switch>
      </div>
    </div>
  );
}

export default App;
