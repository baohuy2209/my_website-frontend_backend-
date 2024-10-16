import GetRequest from "./components/GetRequest";
import PostRequest from "./components/PostRequest";
import PutRequest from "./components/PutRequest";
import DeleteRequest from "./components/DeleteRequest";
import "bootstrap/dist/css/bootstrap.min.css";
function App() {
  return (
    <div class="container my-3" style={{ maxWidth: "600px" }}>
      <h3>Fetch Requests example</h3>
      <GetRequest />
      <PostRequest />
      <PutRequest />
      <DeleteRequest />
      <p className="mt-3">
        ©<a href="https://www.bezkoder.com/fetch-request">bezkoder.com</a>
      </p>
    </div>
  );
}

export default App;
