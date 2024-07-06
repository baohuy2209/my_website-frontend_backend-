import React from "react";
import AxiosService from "../../services/Axios.service";
const delete_request = () => {
  const deleteAllData = () => {
    AxiosService.deleteAllData();
  };
  const deleteDataById = () => {
    AxiosService.deleteDataById();
  };
  const clearDeleteOutput = () => {
    AxiosService.clearDeleteOutput();
  };
  return (
    <div className="card mt-3">
      <div className="card-header">Axios DELETE Request</div>
      <div className="card-body">
        <div className="input-group input-group-sm">
          <button class="btn btn-sm btn-danger" onClick={deleteAllData}>
            Delete All
          </button>
          <input
            type="text"
            id="delete-id"
            className="form-control ml-2"
            placeholder="Id"
          />
          <div className="input-group-append">
            <button class="btn btn-sm btn-danger" onClick={deleteDataById}>
              Delete by Id
            </button>
          </div>
          <button
            class="btn btn-sm btn-warning ml-2"
            onClick={clearDeleteOutput}
          >
            Clear
          </button>
        </div>
        <div id="deleteResult"></div>
      </div>
    </div>
  );
};
export default delete_request;
