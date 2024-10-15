// get local access token in localStorage
function getLocalAccessToken() {
  const accessToken = window.localStorage.getItem("accessToken");
  return accessToken;
}
// get local refresh token in localStorage
function getLocalRefreshToken() {
  const refreshToken = window.localStorage.getItem("refreshToken");
  return refreshToken;
}

// create instance axios
const instance = axios.create({
  baseURL: "http://localhost:8080/api",
  headers: {
    "Content-Type": "application/json",
  },
});
// Begin interceptors
/**
 * Request
 */
instance.interceptors.request.use(
  (config) => {
    const token = getLocalAccessToken();
    if (token) {
      config.headers["x-access-token"] = token;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);
/**
 * Response
 */
instance.interceptors.response.use(
  (res) => {
    return res;
  },
  async (err) => {
    const originalConfig = err.config;
    if (err.response) {
      if (err.response.status === 401 && !originalConfig._retry) {
        originalConfig._retry = true;

        try {
          const rs = await refreshToken();

          const { accessToken } = rs.data;
          window.localStorage.setItem("accessToken", accessToken);
          instance.defaults.headers.common["x-access-token"] = accessToken;

          return instance(originalConfig);
        } catch (_error) {
          if (_error.response && _error.response.data) {
            return Promise.reject(_error.response.data);
          }
          return Promise.reject(_error);
        }
      }
      if (error.response.status === 403 && err.response.data) {
        return Promise.reject(error.response.data);
      }
    }
    return Promise.reject(err);
  }
);
// signin through call API by Axios
function signin() {
  return instance.post("/auth/sigin", {
    username: "zkoder",
    password: "12345678",
  });
}
// get refresh token by Axios
function refreshToken() {
  return instance.post("/auth/refreshtoken", {
    refreshToken: getLocalRefreshToken(),
  });
}
// [GET] /test/user
function getUserContent() {
  return instance.get("/test/user");
}
// Login
async function login() {
  // get tag has id = getResult1
  var resultElement = document.getElementById("getResult1");

  // set empty string
  resultElement.innerHTML = "";

  try {
    const res = await signin();
    // destructuring to get accessToken and refreshToken from data which return when execute
    const { accessToken, refreshToken } = res.data;
    // storage accessToken to localStorage
    window.localStorage.setItem("accessToken", accessToken);
    // storage refreshToken to localStorage
    window.localStorage.setItem("refreshToken", refreshToken);
    // print accessToken and refreshToken on the UI
    resultElement.innerHTML =
      "<pre>" +
      JSON.stringify({ accessToken, refreshToken }, null, 2) +
      "</pre>";
  } catch (err) {
    resultElement.innerHTML = err;
  }
}

async function getData() {
  var resultElement = document.getElementById("getResult2");
  resultElement.innerHTML = "";
  try {
    const res = await getUserContent();
    resultElement.innerHTML =
      "<pre>" + JSON.stringify(res.data, null, 2) + "</pre>";
  } catch (err) {
    resultElement.innerHTML = "<pre>" + JSON.stringify(err, null, 2) + "</pre>";
  }
}
function clearOutput1() {
  var resultElement = document.getElementsById("getResult1");
  resultElement.innerHTML = "";
}

function clearOutput2() {
  var resultElement = document.getElementById("getResult2");
  resultElement.innerHTML = "";
}
