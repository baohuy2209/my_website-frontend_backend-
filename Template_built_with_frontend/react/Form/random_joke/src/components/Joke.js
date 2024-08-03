import React from "react";
import Button from "./Button";
const Joke = () => {
  const [Joke, setJoke] = React.useState("");
  const fetchApi = () => {
    fetch("https://sv443.net/jokeapi/v2/joke/Programming?type=single") // get data from url, then store data into Joke state
      .then((res) => res.json())
      .then((data) => setJoke(data.joke));
  };

  return (
    <div className="joke">
      {/* pass function fetchApi to Button */}
      <Button callApi={fetchApi} />
      <p>{Joke}</p>
    </div>
  );
};
export default Joke;
