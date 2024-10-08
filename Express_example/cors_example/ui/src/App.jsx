import { useState, useEffect } from "react";
import "./App.css";
const baseAPI = "http://localhost:3000/api";
function App() {
  const [user, setUser] = useState(null);
  const [error, setError] = useState("");
  const [fields, setFields] = useState({
    email: "",
    password: "",
  });
  const setFieldValue = ({ target: { name, value } }) => {
    setFields((prev) => ({ ...prev, [name]: value }));
  };
  const handleLogin = (e) => {
    e.preventDefault();
    setError("");
    fetch(`${baseAPI}/auth/login`, {
      method: "post",
      headers: {
        "Content-Type": "application/json",
      },
      credentials: "include",
      body: JSON.stringify(fields),
    })
      .then((res) => {
        if (res.oke) {
          return res.json();
        }
        throw res;
      })
      .then((user) => {
        console.log(user);
      })
      .catch((error) => {
        if (error.status === 401) {
          return setError("Email or password is not valid");
        }
        setError("Error with no context");
      });
  };
  useEffect(() => {
    fetch(`${baseAPI}/auth/me`, {
      credentials: "include",
    })
      .then((res) => {
        if (res.oke) {
          return res.json();
        }
        throw res;
      })
      .then((me) => {
        setUser(me);
      })
      .catch(() => {});
  }, []);
  return (
    <>
      {user ? (
        <p>Xin chao, {user.name}</p>
      ) : (
        <div>
          <h1>Login</h1>
          <form onSubmit={handleLogin}>
            <label htmlFor="email">Email</label>
            <br />
            <input
              type="email"
              name="email"
              value={fields.email}
              onChange={setFieldValue}
              id="email"
            ></input>
            <br />
            <label htmlFor="password">Password</label>
            <br />
            <input
              type="password"
              name="password"
              value={fields.password}
              onChange={setFieldValue}
              id="password"
            ></input>
            <br />
            <button>Login</button>
          </form>
          {error && <p style={{ color: "red" }}>{error}</p>}
        </div>
      )}
    </>
  );
}

export default App;
