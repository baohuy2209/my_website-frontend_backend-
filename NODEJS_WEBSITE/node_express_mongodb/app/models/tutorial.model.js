module.exports = (mongoose) => {
  var Schema = new mongoose.Schema(
    {
      title: String,
      description: String,
      published: Boolean,
    },
    {
      timestamp: true,
    }
  );

  Schema.method("toJSON", function () {
    const { __v, _id, ...object } = this.toObject();
    object.id = _id;
    return object;
  });

  const Tutorial = mongoose.model("tutorial", Schema);
  return Tutorial;
};
