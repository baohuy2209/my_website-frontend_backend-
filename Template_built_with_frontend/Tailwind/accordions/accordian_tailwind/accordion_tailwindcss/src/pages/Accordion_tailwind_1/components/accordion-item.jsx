import { useState } from "react";
import Minus from "./icons/minus";
import Plus from "./icons/plus";
const Accordion_item = ({ title }) => {
  const [expanded, setExpanded] = useState(false);
  return (
    <div className="transition hover:bg-indigo-50">
      <div className="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16">
        <div className="accordion-icon h-4 w-4">
          {expanded ? <Minus /> : <Plus />}
        </div>
        <h3 onClick={() => setExpanded(!expanded)}>{props.title}</h3>
      </div>
      <div className="accordion-content px-5 pt-0 overflow-hidden max-h-0">
        {expanded && (
          <p className="leading-6 font-light pl-9 text-justify">
            {props.information}
          </p>
        )}
        <button className="rounded-full bg-indigo-600 text-white font-medium font-lg px-6 py-2 my-5 ml-9 ">
          Learn more
        </button>
      </div>
    </div>
  );
};
export default Accordion_item;
