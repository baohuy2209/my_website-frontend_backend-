import React from "react";

const PostRequest = () => {
  const postData = () => {};
  const clearPostOutput = () => {};
  return (
    <div className="card mt-3">
      <div className="card-header">Fetch POST Request - Bezkoder</div>
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
        <button className="btn btn-sm btn-primary mr-2" onClick={postData}>
          Post Data
        </button>
        <button className="btn btn-sm btn-warning" onClick={clearPostOutput}>
          Clear
        </button>
        <div id="postResult"></div>
      </div>
    </div>
  );
};

export default PostRequest;
