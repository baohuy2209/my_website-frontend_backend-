export default function authHeader() {
  const user = JSON.parse(localStorage.getItem("user"));
  if (user && user.accessToken) {
    return { Authorizaion: "Bearer" + user.accessToken };
  } else {
    return {};
  }
}
