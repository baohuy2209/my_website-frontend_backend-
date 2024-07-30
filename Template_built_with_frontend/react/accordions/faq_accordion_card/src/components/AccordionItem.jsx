import React from "react";
const AccordionItem = ({
  showDescription,
  ariaExpanded,
  fontWeightBold,
  item,
  index,
  onClick,
}) => {
  return (
    <div className="faq_question" key={item.question}>
      <dt>
        <button
          aria-expanded={ariaExpanded}
          aria-controls={`faq${index + 1}_desc`}
          data-qa="faq_question-button"
          className={`faq_question-button ${fontWeightBold}`}
          onClick={onClick}
        >
          {item.question}
        </button>
      </dt>
      <dd>
        <p
          id={`faq${index + 1}_desc`}
          data-qa="faq_desc"
          class={`faq_desc ${showDescription}`}
        >
          {item.answer}
        </p>
      </dd>
    </div>
  );
};
export default AccordionItem;
