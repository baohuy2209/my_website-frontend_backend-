import React from "react";
import AxiosService from "../../services/Axios.service";
const put_request = () => {
  const putData = () => {
    AxiosService.putData();
  };
  const clearPutOutput = () => {
    AxiosService.clearGetOutput();
  };
  return (
    <div className="card mt-3">
      <div className="card-header">Axios PUT request</div>
      <div className="card-body">
        <div className="form-group">
          <input
            type="text"
            className="form-control"
            id="put-id"
            placeholder="Id"
          />
        </div>
        <div className="form-group">
          <input
            type="text"
            className="form-control"
            id="put-title"
            placeholder="Title"
          />
        </div>
        <div className="form-group">
          <input
            type="text"
            className="form-control"
            id="put-description"
            placeholder="Description"
          />
        </div>
        <div className="form-check">
          <input
            type="checkbox"
            className="form-check-input"
            id="put-published"
          />
          <label className="form-check-label" htmlFor="put-published">
            Publish
          </label>
        </div>
        <div class="form-group mt-2">
          <buton className="btn btn-sm btn-primary" onClick={putData}>
            Update Data
          </buton>
          <buton className="btn btn-sm btn-warning" onClick={clearPutOutput}>
            Clear
          </buton>
        </div>
        <div id="putResult"></div>
      </div>
    </div>
  );
};
export default put_request;
