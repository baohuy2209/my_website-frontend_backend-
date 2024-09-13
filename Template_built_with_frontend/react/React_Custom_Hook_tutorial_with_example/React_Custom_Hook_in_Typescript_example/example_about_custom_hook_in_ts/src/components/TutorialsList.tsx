import * as React from "react";
import { Link } from "react-router-dom";
import ITutorialData from "../types/tutorial.type";
import TutorialService from "../service/tutorial.service";
import { useAxiosFetch } from "../custom-hooks/useAxiosFetch";

export default function TutorialList() {
  const [tutorials, setTutorials] = React.useState<Array<ITutorialData>>([]);
  const [searchTitle, setSearchTitle] = React.useState<string>("");
  const [currentTutorial, setCurrentTutorial] =
    React.useState<ITutorialData | null>(null);
  const [currentIndex, setCurrentIndex] = React.useState<number>(-1);
  const [data, error, loading] = useAxiosFetch({
    method: "GET",
    url: "/tutorials",
    params: {
      title: searchTitle,
    },
  });
  React.useEffect(() => {
    if (data) {
      setTutorials(data);
      console.log(data);
    } else {
      setTutorials([]);
    }
  }, [data]);
  React.useEffect(() => {
    if (error) {
      console.log(error);
    }
  }, [error]);
  React.useEffect(() => {
    if (loading) {
      console.log("retrieving tutorials ... ");
    }
  }, [loading]);
  const onChangeSearchTitle = (e: React.ChangeEvent<HTMLInputElement>) => {
    const searchTitle = e.target.value;
    setSearchTitle(searchTitle);
  };
  const retrieveTutorials = () => {
    TutorialService.getAll()
      .then((response: any) => {
        setTutorials(response.data);
        console.log(response.data);
      })
      .catch((e: Error) => {
        console.log(e);
      });
  };
  const refreshList = () => {
    retrieveTutorials();
    setCurrentTutorial(null);
    setCurrentIndex(-1);
  };
  const setActiveTutorial = (tutorial: ITutorialData, index: number) => {
    setCurrentTutorial(tutorial);
    setCurrentIndex(index);
  };
  const removeAllTutorials = () => {
    TutorialService.deleteAll()
      .then((response: any) => {
        console.log(response.data);
        refreshList();
      })
      .catch((e: Error) => {
        console.log(e);
      });
  };
  const searchTitleImplement = () => {
    setCurrentIndex(-1);
    setCurrentTutorial(null);
    TutorialService.findByTitle(this.state.searchTitle)
      .then((response: any) => {
        setTutorials(response.data);
        console.log(response);
      })
      .catch((e: Error) => {
        console.log(e);
      });
  };
  React.useEffect(() => {
    retrieveTutorials();
  }, []);
  return (
    <div className="list row">
      <div className="col-md-8">
        <div className="input-group mb-3">
          <input
            type="text"
            className="form-control"
            placeholder="Search by title"
            value={searchTitle}
            onChange={onChangeSearchTitle}
          />
          <div className="input-group-append">
            <button
              className="btn btn-outline-secondary"
              type="button"
              onClick={searchTitleImplement}
            >
              Search
            </button>
          </div>
        </div>
      </div>
      <div className="col-md-6">
        <h4>Tutorials List</h4>
        {loading && <p>Loading ... </p>}
        <ul className="list-group">
          {tutorials &&
            tutorials.map((tutorial: ITutorialData, index: number) => {
              return (
                <li
                  className={
                    "list-group-item" + (index === currentIndex ? "active" : "")
                  }
                  onClick={() => {
                    setActiveTutorial(tutorial, index);
                  }}
                  key={index}
                >
                  {tutorial.title}
                </li>
              );
            })}
        </ul>
        <button
          className="m-3 btn btn-sm btn-danger"
          onClick={removeAllTutorials}
        >
          Remove All
        </button>
      </div>
      <div className="col-md-6">
        {currentTutorial ? (
          <div>
            <h4>Tutorial</h4>
            <div>
              <label>
                <strong>Title: </strong>
              </label>{" "}
              {currentTutorial.title}
            </div>
            <div>
              <label>
                <strong>Description: </strong>
              </label>{" "}
              {currentTutorial.description}
            </div>
            <div>
              <label>
                <strong>Status: </strong>
              </label>{" "}
              {currentTutorial.published ? "Published" : "Pending"}
            </div>
            <Link
              to={"/tutorials/" + currentTutorial.id}
              className="badge badge-warning"
            >
              Edit
            </Link>
          </div>
        ) : (
          <div>
            <br />
            <p>Please click on a Tutorial...</p>
          </div>
        )}
      </div>
    </div>
  );
}
