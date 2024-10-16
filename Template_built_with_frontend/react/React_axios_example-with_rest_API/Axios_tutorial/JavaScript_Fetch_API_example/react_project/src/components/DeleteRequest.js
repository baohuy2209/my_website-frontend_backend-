import React from "react";

const DeleteRequest = () => {
  const deleteAllData = () => {};
  const deleteDataById = () => {};
  const clearDeleteOutput = () => {};
  return (
    <div className="card mt-3">
      <div className="card-header">Fetch DELETE Request - Bezkoder</div>
      <div className="card-body">
        <div className="input-group input-group-sm">
          <button className="btn btn-sm btn-danger" onClick={deleteAllData}>
            Delete All
          </button>
          <input
            type="text"
            id="delete-id"
            className="form-control ml-2"
            placeholder="Id"
          />
          <div className="input-group-append">
            <button className="btn btn-sm btn-danger" onClick={deleteDataById}>
              Delete by Id
            </button>
          </div>

          <button
            className="btn btn-sm btn-warning ml-2"
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

export default DeleteRequest;
