import "./App.css";
import GetRequest from "./components/GET_requests/index";
import PostRequest from "./components/POST_requests/index";
import DeleteRequest from "./components/DELETE_request/index";
import PutRequest from "./components/PUT_request/index";
import "bootstrap/dist/css/bootstrap.min.css";
function App() {
  return (
    <div id="app" className="container">
      <GetRequest />
      <PostRequest />
      <DeleteRequest />
      <PutRequest />
    </div>
  );
}

export default App;
