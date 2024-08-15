import React from "react";
import AccordionItem from "./AccordionItem";
const Accordion = (props) => {
  return (
    <div className="accordion">
      {props.hiddenTexts.map((hiddenText) => {
        return <AccordionItem key={hiddenText.label} hiddenText={hiddenText} />;
      })}
    </div>
  );
};
export default Accordion;
