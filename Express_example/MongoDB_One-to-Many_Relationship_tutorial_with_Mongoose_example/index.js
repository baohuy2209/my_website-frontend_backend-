const express = require("express");
const app = express();
const PORT = process.env.PORT || 8080;
const mongoose = require("mongoose");
const db = require("./models");
const connect = require("./app/config/db/index");

const createTutorial = function (tutorial) {
  return db.tutorial.create(tutorial).then((docTutorial) => {
    console.log("\n>> Created Tutorial: \n", docTutorial);
    return docTutorial;
  });
};
const createImage = function (tutorialId, image) {
  return db.image.create(image).then((docImage) => {
    console.log("\n>> Create image :\n", docImage);
    return db.tutorial.findByIdAndUpdate(
      tutorialId,
      {
        $push: {
          images: {
            _id: docImage._id,
            url: docImage.url,
            caption: docImage.caption,
          },
        },
      },
      { new: true, userFindAndModify: false }
    );
  });
};
const createComment = function (tutorialId, comment) {
  return db.comment.create(comment).then((docComment) => {
    console.log("\n>> Created comment: \n", docComment);
    return db.tutorial.findByIdAndUpdate(
      tutorialId,
      {
        $push: { comments: docComment._id },
      },
      {
        new: true,
        userFindAndModify: false,
      }
    );
  });
};
const createCategory = function (category) {
  return db.category.create(category).then((docCategory) => {
    console.log("\n>> Created Category: \n", docCategory);
    return docCategory;
  });
};
const addTutorialToCategory = function (tutorialId, categoryId) {
  return db.tutorial.findByIdAndUpdate(
    tutorialId,
    { category: categoryId },
    { new: true, userFindAndModify: false }
  );
};
const getTutorialWithPopulate = function (id) {
  return db.tutorial.findById(id).populate("comments", "-_id -__v");
};
const getTutorialsInCategory = function (categoryId) {
  return db.tutorial
    .findById({ category: categoryId })
    .populate("category", "name -_id")
    .select("-comments -images -__v");
};
//run function
const run = async function () {
  var tutorial = await createTutorial({
    title: "Tutorial #1",
    author: "Nguyen Bao Huy",
  });

  tutorial = await createImage(tutorial._id, {
    path: "sites/uploads/images/mongodb.png",
    url: "/images/mongodb.png",
    caption: "MongoDB Database",
    createdAt: Date.now(),
  });
  console.log("\n Tutorial:\n", tutorial);
  tutorial = await createComment(tutorial._id, {
    username: "jack",
    text: "This is a great tutorial.",
    createdAt: Date.now(),
  });
  console.log("\n>> Tutorial:\n", tutorial);

  tutorial = await createComment(tutorial._id, {
    username: "mary",
    text: "Thank you, it helps me alot.",
    createdAt: Date.now(),
  });
  console.log("\n>> Tutorial:\n", tutorial);
  tutorial = await getTutorialWithPopulate(tutorial._id);
  console.log("\n>> populated Tutorial: \n", tutorial);
  var category = await createCategory({
    name: "Node.js",
    description: "Node.js tutorial",
  });
  tutorial = await addTutorialToCategory(tutorial._id, category._id);
  console.log("\n>> Tutorial:\n", tutorial);

  var newTutorial = await createTutorial({
    title: "Tutorial #2",
    author: "Nguyen Bao Huy",
  });

  await addTutorialToCategory(newTutorial._id, category._id);

  var tutorials = await getTutorialsInCategory(category._id);
  console.log("\n>> all Tutorials in Cagetory:\n", tutorials);
};
connect();
run();
app.get("/", (req, res) => {
  res.send({
    message: "MongoDB One to Many Relationship tutorial with Mongoose example",
  });
});
app.listen(PORT, () => {
  console.log(`Listening on http://localhost:${PORT}`);
});
