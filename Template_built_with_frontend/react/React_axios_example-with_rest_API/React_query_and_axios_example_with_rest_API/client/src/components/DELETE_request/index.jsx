import React, { useState, useEffect } from "react";
import { useMutation } from "react-query";

import apiClient from "./http-common";

function App() {
  const [deleteId, setDeleteId] = useState("");

  const [deleteResult, setDeleteResult] = useState(null);

  const fortmatResponse = (res) => {
    return JSON.stringify(res, null, 2);
  };

  const { isLoading: isDeletingTutorials, mutate: deleteAllTutorials } =
    useMutation(
      async () => {
        return await apiClient.delete("/tutorials/");
      },
      {
        onSuccess: (res) => {
          const result = {
            status: res.status + "-" + res.statusText,
            headers: res.headers,
            data: res.data,
          };

          setDeleteResult(fortmatResponse(result));
        },
        onError: (err) => {
          setDeleteResult(fortmatResponse(err.response?.data || err));
        },
      }
    );

  useEffect(() => {
    if (isDeletingTutorials) setDeleteResult("deleting...");
  }, [isDeletingTutorials]);

  function deleteAllData() {
    try {
      deleteAllTutorials();
    } catch (err) {
      setDeleteResult(fortmatResponse(err));
    }
  }

  const { isLoading: isDeletingTutorial, mutate: deleteTutorial } = useMutation(
    async () => {
      return await apiClient.delete(`/tutorials/${deleteId}`);
    },
    {
      onSuccess: (res) => {
        const result = {
          status: res.status + "-" + res.statusText,
          headers: res.headers,
          data: res.data,
        };

        setDeleteResult(fortmatResponse(result));
      },
      onError: (err) => {
        setDeleteResult(fortmatResponse(err.response?.data || err));
      },
    }
  );

  useEffect(() => {
    if (isDeletingTutorial) setDeleteResult("deleting...");
  }, [isDeletingTutorial]);

  function deleteDataById() {
    if (deleteId) {
      try {
        deleteTutorial();
      } catch (err) {
        setDeleteResult(fortmatResponse(err));
      }
    }
  }

  const clearDeleteOutput = () => {
    setDeleteResult(null);
  };

  return (
    <div id="app" className="container">
      <div className="card">
        <div className="card-header">
          React Query Axios DELETE - BezKoder.com
        </div>
        <div className="card-body">
          <div className="input-group input-group-sm">
            <button className="btn btn-sm btn-danger" onClick={deleteAllData}>
              Delete All
            </button>

            <input
              type="text"
              value={deleteId}
              onChange={(e) => setDeleteId(e.target.value)}
              className="form-control ml-2"
              placeholder="Id"
            />
            <div className="input-group-append">
              <button
                className="btn btn-sm btn-danger"
                onClick={deleteDataById}
              >
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

          {deleteResult && (
            <div className="alert alert-secondary mt-2" role="alert">
              <pre>{deleteResult}</pre>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}

export default App;
