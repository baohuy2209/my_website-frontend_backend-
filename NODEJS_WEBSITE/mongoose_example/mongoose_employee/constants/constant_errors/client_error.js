module.exports = {
  BAD_REQUEST: 400,
  /**
   * 400: The server cannot or will not process the request due to something
   * that is perceived to be a client error (e.g., malformed request syntax, invalid
   * request message framing, or deceptive request routing).
   */
  UNAUTHORIZED: 401,
  /**
   * 401: Although the HTTP standard specifies "unauthorized", semantically this response means "unauthenticated".
   * That is, the client must authenticate itself to get the requested response.
   */
  PAYMENT_REQUIRED: 402,
  /**
   * 402: This response code is reserved for futrure use.
   * The initial aim for creating this code was using it for digital payment systems, however
   * this status code is used very rarely and no standard convention exists.
   */
  FORBIDDEN: 403,
  /**
   * 403: The client does not have access rights to the content; that is, it is unauthorized, so the server is refusing to
   * give the requested resource. Unlike 401 unauthorized, the client's identity is known to the server.
   */
  NOT_FOUND: 404,
  /**
   * 404: The server cannot find the requested resource. In the browser, this means the URL is not recognized.
   * In an API, this can also mean that the endpoint is valid but resource itself does not exist. Servers may also send this response instead of
   * 403 forbidden to hide the existence of a resource from an unauthorized client.
   * This response code is probably the most well known due to its frequent occurrence on the web.
   */
  METHOD_NOT_ALLOWED: 405,
  /**
   * 405: The request method is known by the server by it not supported by the target resource.
   * For example, an API may not allow calling DELETE to remove a resouce.
   */
  NOT_ACCEPTABLE: 406,
  /**
   * 406: This response is sent when the web server, after performing server driven content negotiation,
   * doesn't find any content that conforms to the criteria given by the user agent.
   */
  PROXY_AUTHENTICATION_REQUIRED: 407,
  /**
   * 407: This is similar to 401 Unauthorized but authentication is needed to be done by a proxy.
   */
  REQUEST_TIMEOUT: 408,
  /**
   * 408: This response is sent on an idle connection by some servers, even without any previous request by the client.
   * It means that the server would like to shut down this unused connection. This response is used much more since more browsers,
   * like Chrome, Firefor 27+, or IE9, use HTTP pre-connection mechanisms to speed up surfing.
   * Aslo note that some servers merely shut down the connection without sending this message.
   */
  CONFLICT: 409,
  /**
   * 409: This response is sent when a request conflicts with current state of the server.
   */
  GONE: 410,
  /**
   * 410: This response is sent when the requested content has been permanently deleted from server,
   * with no forwarding address. Clients are expected to remove their caches and links to the resource.
   * The HTTP specification intends this status code to be used for "limited-time, promotional services". APIs should not feel compelled to indicate resources that have been deleted with this status code.
   */
  LENGTH_REQUIRED: 411,
  /**
   * 411: Server rejected the request because the Content-length header field is not defined and the server required it.
   */
  PRECONDITION_FAILED: 412,
  /**
   * 412: The client has indicated preconditions in its headers which the server does not meet.
   */
  PAYLOAD_TOO_LARGE: 413,
  /**
   * 413: Request entity is larger than limits defined by server.
   * The server might clost the connection or return an Retry-After header field.
   */
  URL_TOO_LONG: 414,
  /**
   * 414:The URL requested by the client is longer than the server is willing to interpret.
   */
  UNSUPPORTED_MEDIA_TYPE: 415,
  /**
   * 415: The media format of the requested data is not supported by the server, so the server is rejecting the request.
   */
  RANGE_NOT_SATISFIABLE: 416,
  /**
   * 416: The range specified by the Range header field in the request cannot be fulfilled.
   * It's possible that the range is outside the size of the target URL's data.
   */
  EXPECTATION_FAILED: 417,
  /**
   * 417: This response code means the expectation indicated by the expect request header field cannot be met by the server.
   */
  TEAPOT: 418,
  /**
   * 418: The server refuses the attempt to brew coffee with a teapot.
   */
  MISDIRECTED_REQUEST: 421,
  /**
   * 421: The request was directed at a server that is not able to produce a response.
   * This can be sent by a server that is not configured to produce responses for the combination of scheme and authority that are included in the request URL.
   */
  UNPROCESSABLE_CONTENT: 422,
  /**
   * 422: The request was well-formed but was unable to be followed due to semantic errors.
   */
  LOCKED: 423,
  /**
   * 423: The resource that is being accessed is locked.
   */
  FAILED_DEPENDENCY: 424,
  /**
   * 424: The request failed due failure of a previous request.
   */
  TOO_EARLY: 425,
  /**
   * 425: Indicates that the server is unwilling to risk processing a request that might be replayed.
   */
  UPGRADE_REQUIRED: 426,
  /**
   * 426: The server refuses to perform the request using the current protocol but might be willing to do so after the client upgrades to a different protocol. The server sends an Upgrade header in a 426 response to indicate the required protocol(s).
   */
  PRECONDITION_REQUIRED: 428,
  /**
   * 428:The origin server requires the request to be conditional. This response is intended to prevent the 'lost update' problem, where a client GETs a resource's state, modifies it and PUTs it back to the server, when meanwhile a third party has modified the state on the server, leading to a conflict.
   */
  TOO_MANY_REQUESTS: 429,
  /**
   * 429: The user has sent too many requests in a given amount of time ("rate limiting").
   */
  REQUEST_HEADER_FIELDS_TOO_LARGE: 431,
  /**
   * 431: The server is unwilling to process the request because its header fields are too large. The request may be resubmitted after reducing the size of the request header fields.
   */
  UNAVAILABLE_FOR_LEGAL_REASONS: 451,
  /**
   * 451: The user agent requested a resource that cannot legally be provided, such as a web page censored by a government.
   */
};
