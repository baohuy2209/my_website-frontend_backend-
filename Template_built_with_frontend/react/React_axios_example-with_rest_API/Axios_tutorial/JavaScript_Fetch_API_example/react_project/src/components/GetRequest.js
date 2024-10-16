import React from "react";

const GetRequest = () => {
  const getAllData = () => {};
  const clearGetOutput = () => {};
  const getDataById = () => {};
  const getDataByTitle = () => {};
  return (
    <div className="card mt-3">
      <div className="card-header">Fetch GET Request - Bezkoder</div>
      <div className="card-body">
        <div className="input-group input-group-sm">
          <button className="bttn btn-sm btn-primary" onClick={getAllData}>
            Get All
          </button>
          <input
            type="text"
            id="get-id"
            class="form-control ml-2"
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
              Find by Title
            </button>
          </div>
          <button
            className="btn btn-sm btn-warning ml-2"
            onClick={clearGetOutput}
          >
            clear
          </button>
        </div>
        <div id="getResult"></div>
      </div>
    </div>
  );
};

export default GetRequest;
