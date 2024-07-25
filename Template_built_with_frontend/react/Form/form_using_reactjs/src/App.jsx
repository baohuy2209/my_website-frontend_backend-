import "./App.css";
import React, { useState } from "react";

function App() {
  const [firstName, setFirstName] = useState("");
  const [lastName, setLastName] = useState("");
  const [email, setEmail] = useState("");
  const [contact, setContact] = useState("");
  const [gender, setGender] = useState("male");
  const [subjects, setSubjects] = useState({
    english: true,
    maths: false,
    physics: false,
  });
  const [resume, setResume] = useState("");
  const [url, setUrl] = useState();
  const [selectedOption, setSelectedOption] = useState("");
  const [about, setAbout] = useState("");

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log(
      firstName,
      lastName,
      email,
      contact,
      gender,
      subjects,
      resume,
      url,
      about
    );
  };
  const handleSubjectChange = (sub) => {
    setSubjects((prev) => ({ ...prev, [sub]: !prev[sub] }));
  };
  const handleReset = () => {
    setFirstName("");
    setLastName("");
    setEmail("");
    setContact("");
    setGender("male");
    setSubjects({
      english: true,
      maths: false,
      physics: false,
    });
    setResume("");
    setUrl("");
    setSelectedOption("");
    setAbout("");
  };
  return (
    <div className="App">
      <h1>Form in React</h1>
      <fieldset>
        <form action="#" method="get">
          <div>
            <label for="firstname">First Name</label>
            <input
              type="text"
              name="firstname"
              id="firstname"
              value={firstName}
              onChange={(e) => {
                setFirstName(e.target.value);
              }}
              placeholder="Enter First Name"
              required
            />
          </div>
          <div>
            <label for="lastname">Last Name</label>
            <input
              type="text"
              name="lastname"
              id="lastname"
              value={lastName}
              onChange={(e) => {
                setLastName(e.target.value);
              }}
              placeholder="Enter Last Name"
              required
            />
          </div>
          <div>
            <label for="email">Enter Email* </label>
            <input
              type="email"
              name="email"
              id="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              placeholder="Enter email"
              required
            />
          </div>
          <div>
            <label for="tel">Contact*</label>
            <input
              type="tel"
              name="contact"
              id="contact"
              value={contact}
              onChange={(e) => {
                setContact(e.target.value);
              }}
              placeholder="Enter Mobile number"
              required
            />
          </div>
          <div>
            <label for="gender">Gender* </label>
            <input
              type="radio"
              name="gender"
              id="male"
              value="male"
              checked={gender === "male"}
              onChange={(e) => {
                setContact(e.target.value);
              }}
            />
            Male
            <input
              type="radio"
              name="gender"
              value="female"
              id="female"
              checked={gender === "female"}
              onChange={(e) => {
                setGender(e.target.value);
              }}
            />
            Female
            <input
              type="radio"
              name="gender"
              value="other"
              id="other"
              checked={gender === "other"}
              onChange={(e) => {
                setGender(e.target.value);
              }}
            />
            Other
          </div>
          <div>
            <label for="lang">Your best Subject</label>
            <input
              type="checkbox"
              name="lang"
              id="english"
              checked={subjects.english === true}
              onChange={(e) => {
                handleSubjectChange("english");
              }}
            />
            English
            <input
              type="checkbox"
              name="lang"
              id="maths"
              checked={subjects.maths === true}
              onChange={(e) => {
                handleSubjectChange("maths");
              }}
            />
            Maths
            <input
              type="checkbox"
              name="lang"
              id="physics"
              checked={subjects.physics === true}
              onChange={(e) => {
                handleSubjectChange("physics");
              }}
            />
            Physics
          </div>
          <div>
            <label for="url">Enter URL</label>
            <input
              type="url"
              name="url"
              id="url"
              onChange={(e) => {
                setUrl(e.target.value);
              }}
              placeholder="Enter url"
              required
            />
          </div>
          <div>
            <label>Select your choice</label>
            <select
              name="select"
              id="select"
              value={selectedOption}
              onChange={(e) => {
                setSelectedOption(e.target.value);
              }}
            >
              <option value="" disabled selected={selectedOption === ""}>
                Select your Ans
              </option>
              <optgroup label="Beginers">
                <option value="1">HTML</option>
                <option value="2">CSS</option>
                <option value="3">JavaScript</option>
              </optgroup>
              <optgroup label="Advance">
                <option value="4">React</option>
                <option value="5">Node</option>
                <option value="6">Express</option>
                <option value="t">MongoDB</option>
              </optgroup>
            </select>
          </div>
          <div>
            <label for="about">About</label>
            <textarea
              name="about"
              id="about"
              cols="10"
              rows="10"
              onChange={(e) => {
                setAbout(e.target.value);
              }}
              placeholder="About your self"
              required
            ></textarea>
            <button type="reset" value="reset" onClick={() => handleReset()}>
              Reset
            </button>
            <button
              type="submit"
              value="submit"
              onClick={(e) => handleSubmit(e)}
            >
              Submit
            </button>
          </div>
        </form>
      </fieldset>
    </div>
  );
}

export default App;
