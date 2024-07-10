import React from "react";
import AxiosServer from "../../services/Axios.service";
const get_request = () => {
  const getAllData = () => {
    AxiosServer.getAllData();
  };
  const getDataById = () => {
    AxiosServer.getDataById();
  };
  const getDataByTitle = () => {
    AxiosServer.getDataByTitle();
  };
  const clearGetOutput = () => {
    AxiosServer.clearGetOutput();
  };
  return (
    <div className="card mt-3">
      <div className="card-header">Axios GET Request</div>
      <div className="card-body">
        <div className="input-group input-group-sm">
          <button className="btn btn-sm btn-primary" onclick={getAllData}>
            Get All
          </button>
          <input
            type="text"
            id="get-id"
            className="form-control ml-2"
            placeholder="Id"
          />
          <div className="input-group-append">
            <button className="btn btn-sm btn-primary" onClick={getDataById}>
              Get by Id
            </button>
          </div>

          <input
            type="text"
            id="get-title"
            className="form-control ml-2"
            placeholder="Title"
          />
          <div className="input-group-append">
            <button className="btn btn-sm btn-primary" onClick={getDataByTitle}>
              Find By Title
            </button>
          </div>
          <button
            className="btn btn-sm btn-warning ml-2"
            onClick={clearGetOutput}
          >
            Clear
          </button>
        </div>
        <div id="getResult"></div>
      </div>
    </div>
  );
};
export default get_request;
