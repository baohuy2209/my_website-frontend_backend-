"use strict";
module.exports = User;
function User(name, age, species) {
  this.name = name;
  this.age = age;
  this.species = species;
}
User.all = function (fn) {
  process.nextTick(function () {
    fn(null, users);
  });
};

User.count = function (fn) {
  process.nextTick(function () {
    fn(null, users.length);
  });
};

var users = [];
users.push(new User("Toki", 2, "ferret"));
users.push(new User("Loki", 1, "ferret"));
users.push(new User("Jane", 6, "ferret"));
users.push(new User("Luna", 1, "cat"));
users.push(new User("Manny", 1, "cat"));
