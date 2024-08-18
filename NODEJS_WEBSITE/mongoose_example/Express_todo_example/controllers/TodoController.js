const Todo = require("../models/todo.model");
const utils = require("../utils/utils");
const index = async (req, res, next) => {
  try {
    const userId = req.cookies ? req.cookies.user_id : undefined;
    const todos = await Todo.find({ user_id: userId })
      .sort("-updated_at")
      .exec();
    res.render("../views/index.ejs", {
      title: "Express Todo Example",
      todos,
    });
  } catch (err) {
    next(err);
  }
};
const create = async (req, res, next) => {
  try {
    const newTodo = new Todo({
      user_id: req.cookies ? req.cookies.user_id : undefined,
      content: req.body.content,
      updated_at: Date.now(),
    });
    await newTodo.save();
    res.redirect("/");
  } catch (err) {
    next(err);
  }
};
const deleteById = async (req, res, next) => {
  try {
    const todo = await Todo.findById(req.params.id);
    const userId = req.cookies ? req.cookies.user_id : undefined;
    if (todo.user_id !== userId) {
      return utils.forbidden(res);
    }
    await Todo.findByIdAndDelete(req.params.id);
    res.redirect("/");
  } catch (err) {
    next(err);
  }
};
const edit = async (req, res, next) => {
  try {
    const userId = req.cookies ? req.cookies.user_id : undefined;
    const todos = await Todo.find({ user_id: userId })
      .sort("-updated_at")
      .exec();
    res.render("edit", {
      title: "Express Todo example",
      todos,
      current: req.params.id,
    });
  } catch (err) {
    next(err);
  }
};
const update = async (req, res, next) => {
  try {
    const todo = await Todo.findById(req.params.id);
    const userId = req.cookies ? req.cookies.user_id : undefined;
    if (todo.user_id !== userId) {
      return utils.forbidden(res);
    }

    todo.content = req.body.content;
    todo.updated_at = Date.now();
    await todo.save();
    res.redirect("/");
  } catch (err) {
    next(err);
  }
};
module.exports = {
  index,
  create,
  deleteById,
  edit,
  update,
};
