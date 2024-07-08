import React from "react";
import Header from "./layouts/Header";
import Todos from "./Todos";
class TodoApp extends React.Component {
  state = {
    todos: [
      {
        id: 1,
        title: "Set up development environment",
        completed: true,
      },
      {
        id: 2,
        title: "Develop website and add content",
        completed: false,
      },
      {
        id: 3,
        title: "Deloy to live server",
        completed: false,
      },
    ],
  };
  render() {
    return (
      <div className="container">
        <Header />
        <Todos todos={this.state.todos} />
      </div>
    );
  }
}
export default TodoApp;
