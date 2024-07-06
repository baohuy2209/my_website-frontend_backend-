import React from "react";
import AxiosService from "../../services/Axios.service";
const put_request = () => {
  const postData = () => {
    AxiosService.postData();
  };
  const clearPostOutput = () => {
    AxiosService.clearPostOutput();
  };
  return (
    <div className="card mt-3">
      <div className="card-header">Axios POST request</div>
      <div className="card-body">
        <div className="form-group">
          <input
            type="text"
            className="form-control"
            id="post-title"
            placeholder="Title"
          />
        </div>
        <div className="form-group">
          <input
            type="text"
            className="form-control"
            id="post-description"
            placeholder="Description"
          />
        </div>
        <buton className="btn btn-sm btn-primary" onClick={postData}>
          Post Data
        </buton>
        <buton className="btn btn-sm btn-warning" onClick={clearPostOutput}>
          Clear
        </buton>
        <div id="postResult"></div>
      </div>
    </div>
  );
};
export default put_request;
