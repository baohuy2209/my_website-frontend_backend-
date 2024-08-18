module.exports = {
  multipleMongooseToObject: function (mongooses) {
    return mongooses.map((mongooose) => mongooses.toObject());
  },
  mongooseToObject: function (mongoose) {
    return mongoose ? mongoose.toObject() : mongoose;
  },
};
