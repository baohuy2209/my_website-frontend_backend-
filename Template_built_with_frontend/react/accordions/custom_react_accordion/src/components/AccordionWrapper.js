import React, { createContext, useState } from "react";
export const AccordionContext = createContext({
  active: 0,
  setActive: () => {},
});
const AccordionWrapper = (props) => {
  // Instantiate active item, which means that item is being chosen
  // First index active is 0;
  const [active, setActive] = useState(0);
  return (
    <AccordionContext.Provider value={{ active, setActive }}>
      <div className="accordion-wrapper">
        <form>{props.children}</form>
      </div>
    </AccordionContext.Provider>
  );
};
export default AccordionWrapper;
