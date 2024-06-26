const mongoose = require("mongoose");
const db = require("./models");
mongoose
  .connect("mongodb://localhost/bezkoder_db", {
    useNewUrlParser: true,
    useUnifiedTopology: true,
  })
  .then(() => console.log("Successfully connect to MongoDB"))
  .catch((err) => console.log("Connection error: ", err));
const createTutorial = function (tutorial) {
  return db.Tutorial.create(tutorial).then((docTutorials) => {
    console.log("\n >> Create tutorial: \n", docTutorials);
    return docTutorials;
  });
};

const createTag = function (tag) {
  return db.Tag.create(tag).then((docTag) => {
    console.log("\n >> Created Tag: \n", docTag);
    return docTag;
  });
};

const addTagToTutorial = function (tutorialId, tag) {
  return db.Tutorial.findByIdAndUpdate(
    tutorialId,
    { $push: { tags: tag._id } },
    { new: true, useFindAndModify: false }
  );
};
const addTutorialToTag = function (tagId, tutorial) {
  return db.Tag.findByIdAndUpdate(
    tagId,
    { $push: { tutorials: tutorial._id } },
    { new: true, useFindAndModify: false }
  );
};
const getTutorialWithPopulate = function (id) {
  return db.Tutorial.findByIdAndUpdate(id).populate(
    "tags",
    "-_id -__v -tutorials"
  );
};

const getTagWithPopulate = function (id) {
  return db.Tag.findByIdAndUpdate(id).populate("tutorials", "-_id -__v -tags");
};
const run = async function () {
  var tut1 = await createTutorial({
    title: "Tut #1",
    author: "bezkoder",
  });

  var tagA = await createTag({
    name: "tagA",
    slug: "tag-a",
  });

  var tagB = await createTag({
    name: "tagB",
    slug: "tag-b",
  });

  var tutorial = await addTagToTutorial(tut1._id, tagA);
  console.log("\n>> tut1:\n", tutorial);

  var tag = await addTutorialToTag(tagA._id, tut1);
  console.log("\n>> tagA:\n", tag);

  tutorial = await addTagToTutorial(tut1._id, tagB);
  console.log("\n>> tut1:\n", tutorial);

  tag = await addTutorialToTag(tagB._id, tut1);
  console.log("\n>> tagB:\n", tag);

  var tut2 = await createTutorial({
    title: "Tut #2",
    author: "zkoder",
  });

  tutorial = await addTagToTutorial(tut2._id, tagB);
  console.log("\n>> tut2:\n", tutorial);

  tag = await addTutorialToTag(tagB._id, tut2);
  console.log("\n>> tagB:\n", tag);
  tutorial = await getTutorialWithPopulate(tut1._id);
  console.log("\n>> populated tut1: ", tutorial);
  tag = await getTagWithPopulate(tag._id);
  console.log("\n >> populated tagB:\n", tag);
};

run();
