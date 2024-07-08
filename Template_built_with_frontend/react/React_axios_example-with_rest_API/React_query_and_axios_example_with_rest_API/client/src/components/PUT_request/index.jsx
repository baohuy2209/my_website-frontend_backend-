import React, { useState, useEffect } from "react";
import { useMutation } from "react-query";

import apiClient from "./http-common";

function App() {
  const [putId, setPutId] = useState("");
  const [putTitle, setPutTitle] = useState("");
  const [putDescription, setPutDescription] = useState("");
  const [putPublished, setPutPublished] = useState(false);

  const [putResult, setPutResult] = useState(null);

  const fortmatResponse = (res) => {
    return JSON.stringify(res, null, 2);
  };

  const { isLoading: isUpdatingTutorial, mutate: updateTutorial } = useMutation(
    async () => {
      return await apiClient.put(`/tutorials/${putId}`, {
        title: putTitle,
        description: putDescription,
        published: putPublished,
      });
    },
    {
      onSuccess: (res) => {
        const result = {
          status: res.status + "-" + res.statusText,
          headers: res.headers,
          data: res.data,
        };

        setPutResult(fortmatResponse(result));
      },
      onError: (err) => {
        setPutResult(fortmatResponse(err.response?.data || err));
      },
    }
  );

  useEffect(() => {
    if (isUpdatingTutorial) setPutResult("updating...");
  }, [isUpdatingTutorial]);

  function putData() {
    if (putId) {
      try {
        updateTutorial();
      } catch (err) {
        setPutResult(fortmatResponse(err));
      }
    }
  }

  const clearPutOutput = () => {
    setPutResult(null);
  };

  return (
    <div id="app" className="container">
      <div className="card">
        <div className="card-header">React Query Axios PUT - BezKoder.com</div>
        <div className="card-body">
          <div className="form-group">
            <input
              type="text"
              value={putId}
              onChange={(e) => setPutId(e.target.value)}
              className="form-control"
              placeholder="Id"
            />
          </div>
          <div className="form-group">
            <input
              type="text"
              value={putTitle}
              onChange={(e) => setPutTitle(e.target.value)}
              className="form-control"
              placeholder="Title"
            />
          </div>
          <div className="form-group">
            <input
              type="text"
              value={putDescription}
              onChange={(e) => setPutDescription(e.target.value)}
              className="form-control"
              placeholder="Description"
            />
          </div>
          <div className="form-check mb-2">
            <input
              type="checkbox"
              name="putPublished"
              checked={putPublished}
              onChange={(e) => setPutPublished(e.target.checked)}
              className="form-check-input"
            />
            <label className="form-check-label" htmlFor="putPublished">
              Publish
            </label>
          </div>
          <button className="btn btn-sm btn-primary" onClick={putData}>
            Update Data
          </button>
          <button
            className="btn btn-sm btn-warning ml-2"
            onClick={clearPutOutput}
          >
            Clear
          </button>

          {putResult && (
            <div className="alert alert-secondary mt-2" role="alert">
              <pre>{putResult}</pre>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}

export default App;
