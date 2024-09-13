const Tutorial = require("../models/tutorials.model");
class TutorialController {
  getAll(req, res) {
    Tutorial.find({})
      .then((tutorials) => {
        res.json(tutorials);
      })
      .catch((error) => {
        res.status(500).json({ message: error.message });
      });
  }
  getOne(req, res) {
    Tutorial.findById(req.params.id)
      .then((tutorial) => {
        res.json(tutorial);
      })
      .catch((error) => {
        res.status(404).json({ message: "Tutorial not found" });
      });
  }
  create(req, res) {
    const newTutorial = new Tutorial(req.body);
    newTutorial
      .save()
      .then((tutorial) => {
        res.json(tutorial);
      })
      .catch((error) => {
        console.log("Error: ", error);
        res.status(500).json({ message: "Server error" });
      });
  }
  update(req, res) {
    Tutorial.findByIdAndUpdate(req.params.id)
      .then((tutorial) => {
        res.json(tutorial);
      })
      .catch((error) => {
        console.log("Error: ", error);
        res.status(404).json({ message: "Tutorial not found" });
      });
  }
  deleteAll(req, res) {
    Tutorial.deleteMany({})
      .then(() => {
        console.log("Deleted all tutorials");
      })
      .catch((error) => {
        console.error("Error deleting articles", error);
        res
          .status(500)
          .json({ message: "Not found tutorial which you want delete" });
      });
  }
  deleteOne(req, res) {
    Tutorial.findByIdAndDelete(req.params.id)
      .then(() => {
        res.json("Deleted the tutorial");
      })
      .catch((error) => {
        console.log("Error: ", error);
        res.status(500).json({ message: "Not found tutorial" });
      });
  }
  searchByTitle = async (req, res) => {
    try {
      const tutorials = await Tutorial.find({ title: req.params.title });
      res.json(tutorials);
    } catch (error) {
      console.error("Error searching:", error);
    }
  };
}
module.exports = new TutorialController();
