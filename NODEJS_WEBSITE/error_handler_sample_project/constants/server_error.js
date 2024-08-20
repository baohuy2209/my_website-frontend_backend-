module.exports = {
  INTERVAL_SERVER_ERROR: 500,
  // ! The server hash encountered a situation it does not know how to handle
  NOT_IMPLEMENTED: 501,
  /**
   * ! The request method is not supported by the server and cannot be handled.
   * ! The only methods that servers are required to support (and therefore that must not return this code)
   * ! and GET and HEAD.
   */
  BAD_GATEWAY: 502,
  /**
   * ! This error response means that the server, while working as a gateway to
   * ! get a response needed to handle the request, got an invalid response
   */
  SERVICE_UNAVAILABLE: 503,
  /**
   * ! The server is not ready to handle the request.
   * ! Common causes are server that is down for maintenance or that is overloaded.
   * ! Note that together with this response, a user-friendly page explaining the
   * ! problem should be sent. This response should be used for temporary conditions and the Retry-After.
   * ! HTTP header should, if possible, contain the estimated time before the recovery of the service.
   * ! The webmaster must also take care about the caching-related heades that are sent along with this response,
   * ! as these temporary condition responses should usually not be cached.
   */
  GATEWAY_TIMEOUT: 504,
  /**
   * This error response is given when the server is acting as a gateway and cannot
   * get a response in time.
   */
  HTTP_VERSION_NOT_SUPPORTED: 505,
  /**
   * The HTTP version used in the request is not supported by the server.
   */
  VARIANT_ALSO_NEGOTIATES: 506,
  /**
   * The server has an internal configuration error: the chosen variant resource
   * is configured to engage in transparent content negotiatio itself, and is therefore not proper end point in the negotiation process.
   */
  INSUFFICIENT_STORAGE: 507,
  /**
   * The method could not be performed on the resource because the server is unable to store the representation needed to successfully complete the request.
   */
  LOOP_DETECTED: 508,
  /**
   * The server detected an infinite loop while processing the request
   */
  NOT_EXTENDED: 510,
  /**
   * Further extensions to the request are required for the server to fulfill it.
   */
  NETWORK_AUTHENTICATION_REQUIRED: 511,
  /**
   * Indicated that the client needs to authenticate to gain network access.
   */
};
