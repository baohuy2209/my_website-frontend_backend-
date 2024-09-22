import React from "react";
import TutorialService from "../services/TutorialService";
const AddTutorial = () => {
  const initialTutorialState = {
    title: "",
    description: "",
    published: false,
  };
  const [tutorial, setTutorial] = React.useState(initialTutorialState);
  const [submitted, setSubmitted] = React.useState(false);
  const handleInputChange = (event) => {
    const { name, value } = event.target;
    setTutorial({ ...tutorial, [name]: value });
  };
  const saveTutorial = () => {
    var data = {
      title: tutorial.title,
      description: tutorial.description,
      published: false,
    };
    TutorialService.create(data)
      .then(() => {
        setSubmitted(true);
      })
      .catch((e) => {
        console.log(e);
      });
  };
  const newTutorial = () => {
    setTutorial(initialTutorialState);
    setSubmitted(false);
  };
  return (
    <div className="submit-form">
      {submitted ? (
        <div>
          <h4>You submitted successfully!</h4>
          <button className="btn btn-success" onClick={newTutorial}>
            Add
          </button>
        </div>
      ) : (
        <div>
          <div className="form-group">
            <label htmlFor="title">Title</label>
            <input
              type="text"
              className="form-control"
              id="title"
              required
              value={tutorial.title}
              onChange={handleInputChange}
              name="title"
            />
          </div>
          <div className="form-group">
            <label htmlFor="title">Description</label>
            <input
              type="text"
              className="form-control"
              id="description"
              required
              value={tutorial.title}
              onChange={handleInputChange}
              name="description"
            />
          </div>
          <button onClick={saveTutorial} className="btn btn-success">
            Submit
          </button>
        </div>
      )}
    </div>
  );
};
export default AddTutorial;
