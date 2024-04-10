module.exports = function sortMiddleware(req, res, next) {
  // initialize property "_sort" of object res.locals
  res.locals._sort = {
    enabled: false, // default value
    type: "default", // default value
  };
  // check if the req.query has property "_sort"
  if (req.query.hasOwnProperty("_sort")) {
    // assign new object to res.locals._sort
    Object.assign(res.locals._sort, {
      enabled: true,
      type: req.query.type,
      column: req.query.column,
    });
  }
  next();
};
