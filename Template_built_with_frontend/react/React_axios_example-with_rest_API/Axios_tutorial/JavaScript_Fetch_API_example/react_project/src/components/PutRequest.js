import React from "react";

const PutRequest = () => {
  const putData = () => {};
  const clearPutOutput = () => {};
  return (
    <div className="card mt-3">
      <div className="card-header">Fetch PUT Request - Bezkoder</div>
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
        <div className="form-check mb-2">
          <input
            type="checkbox"
            className="form-check-input"
            id="put-published"
          />
          <label className="form-check-label" for="put-published">
            Publish
          </label>
        </div>
        <button className="btn btn-sm btn-primary mr-2" onClick={putData()}>
          Update Data
        </button>
        <button className="btn btn-sm btn-warning" onClick={clearPutOutput()}>
          Clear
        </button>
      </div>
    </div>
  );
};

export default PutRequest;
