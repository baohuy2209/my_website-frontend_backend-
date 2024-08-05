const constant = require("../constants/contansts");
const errorHandler = (err, req, res, next) => {
  const statusCode = res.statusCode ? res.statusCode : 500;
  switch (statusCode) {
    case constant.VALIDATION_ERROR:
      res.json({
        title: "Validation Falsed",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case constant.UNAUTHORIZED:
      res.json({
        title: "Unauthorized",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case constant.PAYMENT_REQUIRED:
      res.json({
        title: "Payment Required",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case constant.FORBIDDEN:
      res.json({
        title: "Forbidden",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case constant.NOT_FOUND:
      res.json({
        title: "Not Found",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case constant.METHOD_NOT_ALLOWED:
      res.json({
        title: "Method Not Allowed",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case constant.NOT_ACCEPTABLE:
      res.json({
        title: "Not acceptable",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case constant.PROXY_AUTHENTICATION_REQUIRED:
      res.json({
        title: "Proxy authentication required",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
  }
};
module.exports = errorHandler;
