import React, { useState } from "react";
import AccordionItem from "./AccordionItem";
const Accordion = ({ questionsAnswers }) => {
  const [activeIndex, setActiveIndex] = useState(1); // determine the element in accordion which is expanding the answer

  const renderedQuestionsAnswers = questionsAnswers.map((item, index) => {
    const showDescription = index === activeIndex ? "show-description" : "";
    const fontWeightBold = index === activeIndex ? "font-weight-bold" : "";
    const ariaExpanded = index === activeIndex ? "true" : "false";

    return (
      <AccordionItem
        showDescription={showDescription}
        fontWeightBold={fontWeightBold}
        ariaExpanded={ariaExpanded}
        item={item}
        index={index}
        onClick={() => {
          setActiveIndex(index); // when we click on any question in accordion, the method setActiveIndex will get new value to set the current value of activeIndex
        }}
      />
    );
  });
  return (
    <div className="faq">
      <h1 className="faq_title">FAQ</h1>
      <dl className="faq_list">{renderedQuestionsAnswers}</dl>
    </div>
  );
};
export default Accordion;
