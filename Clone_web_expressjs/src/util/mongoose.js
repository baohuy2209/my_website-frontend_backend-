module.exports = {
  // this function is used when have many items in database are rendered in website
  multipleMongooseToObject: function (mongoose) {
    return mongoose.map((mongoose) => mongoose.toObject());
  },
  // this function is used when have one items rendered in website
  mongooseToObject: function (mongoose) {
    return mongoose ? mongoose.toObject() : mongoose;
  },
};
