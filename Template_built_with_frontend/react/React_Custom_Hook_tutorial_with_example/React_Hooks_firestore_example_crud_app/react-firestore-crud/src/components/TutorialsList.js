import React, { useState } from "react";
import TutorialDataService from "../services/TutorialService";
import Tutorial from "./Tutorial";
import { useCollection } from "react-firebase-hooks/firestore";
const TutorialsList = () => {
  const [currentTutorial, setCurrentTutorial] = useState(null);
  const [currentIndex, setCurrentIndex] = useState(-1);

  const [tutorials, loading, error] = useCollection(
    TutorialDataService.getAll().orderBy("title", "asc")
  );
  const refreshList = () => {
    setCurrentTutorial(null);
    setCurrentIndex(-1);
  };

  const setActiveTutorial = (tutorial, index) => {
    const { title, description, published } = tutorial;

    setCurrentTutorial({
      id: tutorial.id,
      title,
      description,
      published,
    });

    setCurrentIndex(index);
  };

  return (
    <div className="list row">
      <div className="col-md-6">
        <h4>Tutorials List</h4>
        {error && <strong>Error: {error}</strong>}
        {loading && <span>Loading ...</span>}
        <ul className="list-group">
          {!loading &&
            tutorials &&
            tutorials.docs.map((tutorial, index) => (
              <li
                className={
                  "list-group-item " + (index === currentIndex ? "active" : "")
                }
                onClick={() => setActiveTutorial(tutorial, index)}
                key={tutorial.id}
              >
                {tutorial.data().title}
              </li>
            ))}
        </ul>
      </div>
      <div className="col-md-6">
        {currentTutorial ? (
          <Tutorial tutorial={currentTutorial} refreshList={refreshList} />
        ) : (
          <div>
            <br />
            <p>Please click on a Tutorial...</p>
          </div>
        )}
      </div>
    </div>
  );
};

export default TutorialsList;
