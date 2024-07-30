import React from "react";
import Accordion from "./components/Accordion";
import "./scss/main.scss";
import illustration_box from "./images/illustration-box-desktop.svg";
import illustration_woman_desktop from "./images/illustration-woman-online-desktop.svg";
import illustration_woman_mobile from "./images/illustration-woman-online-mobile.svg";
import TestPattern from "./components/text";
const questionsAnswers = [
  {
    question: "How many team members can I invite?",
    answer:
      "You can invite up to 2 additional users on the Free plan. There is no limit on team members for the Premium plan.",
  },
  {
    question: "What is the maximum file upload size?",
    answer:
      "No more than 2GB. All files in your account must fit your allotted storage space.",
  },
  {
    question: "How do I reset my password?",
    answer: `Click “Forgot password” from the login page or “Change password” from your profile page. A reset link will be emailed to you.`,
  },
  {
    question: "Can I cancel my subscription?",
    answer: `Yes! Send us a message and we’ll process your request no questions asked.`,
  },
  {
    question: "Do you provide additional support?",
    answer: `Chat and email support is available 24/7. Phone lines are open during normal business hours.`,
  },
];
function App() {
  return (
    <div className="container">
      <div className="component">
        <div className="illustration">
          <img
            src={illustration_box}
            alt="illustration with box"
            className="illustration_box"
          />
          <img
            src={illustration_woman_desktop}
            alt="illustration with woman"
            className="illustration_woman-desktop"
          />
          <img
            src={illustration_woman_mobile}
            alt="illustration with woman"
            className="illustration_woman-mobile"
          />
        </div>
        <Accordion questionsAnswers={questionsAnswers} />
      </div>
      <div className="attribution">
        Challenge by
        <a
          href="https://www.frontendmentor.io?ref=challenge"
          target="_blank"
          rel="noreferrer"
        >
          Bao Huy
        </a>
      </div>
      {/* <TestPattern /> */}
    </div>
  );
}

export default App;
