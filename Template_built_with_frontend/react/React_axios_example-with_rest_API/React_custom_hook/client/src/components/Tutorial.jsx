import { useParams, useNavigate } from "react-router-dom";
import React, { useState, useEffect } from "react";
import { useAxiosFetch } from "../customer-hooks/useAxiosFetch";
import axios from "axios";
const Tutorial = (props) => {
  const { id } = useParams();
  const initialTutorialState = "";
  const [currentTutorial, setCurrentTutorial] = useState(initialTutorialState);
  const [data, loading, error] = useAxiosFetch({
    method: "GET",
    url: "/tutorials/" + id,
  });
  useEffect(() => {
    if (data) {
      setCurrentTutorial(data);
      console.log(data);
    }
  }, [data]);
  useEffect(() => {
    if (error) {
      console.log(error);
    }
  }, [error]);
  useEffect(() => {
    if (loading) {
      console.log("getting tutorial...");
    }
  }, [loading]);
  const handleInputChange = (event) => {
    const { name, value } = event.target;
    setCurrentTutorial({ ...currentTutorial, [name]: value });
  };
  const getTutorial = (id) => {
    axios
      .get(`tutorials/${id}`)
      .then((response) => {
        setCurrentTutorial(response.data);
        console.log(response.data);
      })
      .catch((e) => {
        console.log(e);
      });
  };
  useEffect(() => {
    if (id) {
      getTutorial(id);
    }
  }, [id]);
  return (
    <div>
      {currentTutorial ? (
        <div>
          <h4>Tutorial</h4>
          {loading && <p>loading...</p>}
          <form>
            <div>
              <label htmlFor="title">Title</label>
              <input
                type="text"
                id="title"
                name="title"
                value={currentTutorial.title}
                onChange={handleInputChange}
              />
            </div>
            <div>
              <label htmlFor="description">Description</label>
              <input
                type="text"
                id="description"
                name="description"
                value={currentTutorial.description}
                onChange={handleInputChange}
              />
            </div>

            <div>
              <label>
                <strong>Status:</strong>
              </label>
              {currentTutorial.published ? "Published" : "Pending"}
            </div>
          </form>
        </div>
      ) : (
        <div>
          <br />
          <p>Please click on a Tutorial...</p>
        </div>
      )}
    </div>
  );
};
export default Tutorial;
