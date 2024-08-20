const const_error = require("../constants/constants");
const errorHandler = (err, req, res, next) => {
  const statusCode = res.statusCode ? res.statusCode : 500;
  switch (statusCode) {
    case const_error.BAD_REQUEST:
      res.json({
        title: "Bad request",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.UNAUTHORIZED:
      res.json({
        title: "Unauthorized",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.PAYMENT_REQUIRED:
      res.json({
        title: "Payment required",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.FORBIDDEN:
      res.json({
        title: "Forbidden",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.NOT_FOUND:
      res.json({
        title: "Not found",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.METHOD_NOT_ALLOWED:
      res.json({
        title: "Method not allowed",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.NOT_ACCEPTABLE:
      res.json({
        title: "Not acceptable",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.PROXY_AUTHENTICATION_REQUIRED:
      res.json({
        title: "Proxy authentication required",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.REQUEST_TIMEOUT:
      res.json({
        title: "Request timeout",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.CONFLICT:
      res.json({
        title: "Conflict",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.GONE:
      res.json({
        title: "Gone",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.LENGTH_REQUIRED:
      res.json({
        title: "Length required",
        message: err.message,
        stackTrace: err.stack,
      });
      break;

    case const_error.PRECONDITION_FAILED:
      res.json({
        title: "Precondition failed",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.PAYLOAD_TOO_LARGE:
      res.json({
        title: "Payload too large",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.URL_TOO_LONG:
      res.json({
        title: "Url too long",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.UNSUPPORTED_MEDIA_TYPE:
      res.json({
        title: "Unsupported media type",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.RANGE_NOT_SATISFIABLE:
      res.json({
        title: "Range not satisfiable",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.EXPECTATION_FAILED:
      res.json({
        title: "Expectation failed",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.TEAPOT:
      res.json({
        title: "Teapot",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.MISDIRECTED_REQUEST:
      res.json({
        title: "Misdirected request",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.UNPROCESSABLE_CONTENT:
      res.json({
        title: "Unprocessable content",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.LOCKED:
      res.json({
        title: "Locked",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.FAILED_DEPENDENCY:
      res.json({
        title: "Failed dependency",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.TOO_EARLY:
      res.json({
        title: "Too early",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.UPGRADE_REQUIRED:
      res.json({
        title: "Upgrade required",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.PRECONDITION_REQUIRED:
      res.json({
        title: "Precondition required",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.TOO_MANY_REQUESTS:
      res.json({
        title: "Too many requests",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.REQUEST_HEADER_FIELDS_TOO_LARGE:
      res.json({
        title: "Request header fields too large",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.UNAVAILABLE_FOR_LEGAL_REASONS:
      res.json({
        title: "Unavailable for legal reasons",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.INTERVAL_SERVER_ERROR:
      res.json({
        title: "Interval server error",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.NOT_IMPLEMENTED:
      res.json({
        title: "Not implemented",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.BAD_GATEWAY:
      res.json({
        title: "Bad gateway",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.SERVICE_UNAVAILABLE:
      res.json({
        title: "Service unavailable",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.GATEWAY_TIMEOUT:
      res.json({
        title: "Gateway timeout",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.HTTP_VERSION_NOT_SUPPORTED:
      res.json({
        title: "Http version not supported",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.VARIANT_ALSO_NEGOTIATES:
      res.json({
        title: "Variant also negotiates",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.INSUFFICIENT_STORAGE:
      res.json({
        title: "Insufficient storage",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.LOOP_DETECTED:
      res.json({
        title: "Loop detected",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.NOT_EXTENDED:
      res.json({
        title: "Not extended",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    case const_error.NETWORK_AUTHENTICATION_REQUIRED:
      res.json({
        title: "Network authentication required",
        message: err.message,
        stackTrace: err.stack,
      });
      break;
    default:
      console.log("All good !!!");
      break;
  }
};
module.exports = errorHandler;
