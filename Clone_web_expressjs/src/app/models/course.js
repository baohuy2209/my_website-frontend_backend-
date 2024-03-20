const mongoose = require("mongoose");
const Schema = mongoose.Schema;
const mongooseDelete = require("mongoose-delete");

var slug = require("mongoose-slug-generator");

const Course = new Schema(
  {
    Name: { type: String, maxLength: 255 },
    Description: { type: String, maxLength: 600 },
    VideoId: { type: String, maxLength: 200 },
    Image: { type: String, maxLength: 1000 },
    Level: { type: String, maxLength: 255 },
    Create: { type: String },
    Lessons: { type: Number },
    Hour_learning: { type: String },
    Title: { type: String, maxLength: 255 },
    Benefit: { type: String },
    slug: {
      type: String,
      slug: "Name",
      unique: true,
    },
  },
  {
    timestamps: true,
  }
);

// Add plugins
mongoose.plugin(slug);
Course.plugin(mongooseDelete, {
  deleteAt: true,
  overrideMethods: "all",
});
module.exports = mongoose.model("Course", Course);
