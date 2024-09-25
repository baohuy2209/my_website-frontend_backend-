import React from "react";
import UserService from "../services/user.service";
const BoardModerator = () => {
  const [content, setContent] = React.useState("");

  React.useEffect(() => {
    UserService.getModeratorBoard()
      .then((response) => {
        setContent(response.data);
      })
      .catch((error) => {
        const _content =
          (error.response &&
            error.response.data &&
            error.response.data.message) ||
          error.message ||
          error.toString();
        setContent(_content);
      });
  }, []);
  return (
    <div className="container">
      <header className="jumbotron">{content}</header>
    </div>
  );
};
export default BoardModerator;
