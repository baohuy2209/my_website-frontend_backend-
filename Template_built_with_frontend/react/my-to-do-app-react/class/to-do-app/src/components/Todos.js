import React from "react";
import TodoItem from "./TodoItem";
class Todos extends React.Component {
  render() {
    return (
      <div>
        <ul>
          {this.props.todos.map(function (todo) {
            <TodoItem key={todo.id} todo={todo.title} />;
          })}
        </ul>
      </div>
    );
  }
}
export default Todos;
