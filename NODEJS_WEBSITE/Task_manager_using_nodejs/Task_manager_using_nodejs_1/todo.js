console.log("todo.js is running");
const fs = require("fs");
const addTodo = (title) => {
  const todos = fetchTodos();
  const todo = {
    title,
  };
  const duplicatetodos = todos.filter((todo) => todo.title === title);

  if (duplicatetodos.length === 0) {
    todos.push(todo);
    saveTodos(todos);
    return todo;
  }
};

const deleteTodo = (title) => {
  let todos = fetchTodos();
  let filteredtodos = todos.filter((todo) => todo.title !== title);
  saveTodos(filteredtodos);

  return todos.length !== filtertodos;
};
