import { Route, Link, Switch } from "react-router-dom";
import TutorialsList from "./components/TutorialsList";
import Tutorial from "./components/Tutorial";
import AddTutorial from "./components/AddTutorial";
import "bootstrap/dist/css/bootstrap.min.css";
function App() {
  return (
    <>
      <div>
        <nav className="navbar navbar-expand navbar-dark bg-dark">
          <Link to={"/tutorials"} className="navbar-brand">
            BHCoder
          </Link>
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
          <Switch>
            <Route path="/" component={TutorialsList} />
            <Route path="/tutorials" component={TutorialsList} />
            <Route path="/add" component={AddTutorial} />
            <Route path="/tutorials/:id" component={Tutorial} />
          </Switch>
        </div>
      </div>
    </>
  );
}

export default App;
