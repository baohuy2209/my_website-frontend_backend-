import "./App.css";
import "bootstrap/dist/css/bootstrap.min.css";
import GetRequest from "./components/Get_request/index";
import PostRequest from "./components/Post_request/index";
import PutRequest from "./components/Put_request/index";
import DeleteRequest from "./components/Delete_request/index";
function App() {
  return (
    <div className="container my-3" Style="max-width: 600px">
      <h3>Axios Requests Example</h3>
      <GetRequest />
      <PostRequest />
      <PutRequest />
      <DeleteRequest />
    </div>
  );
}

export default App;
