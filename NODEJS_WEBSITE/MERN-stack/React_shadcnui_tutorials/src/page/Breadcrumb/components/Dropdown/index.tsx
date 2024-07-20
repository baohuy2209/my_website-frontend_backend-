import * as React from "react";
import StyleDefault from "./DropdownStyleDefault";
import StyleNewYork from "./DropdownStyleNewYork";
interface IDropdownProps {}

const Dropdown: React.FunctionComponent<IDropdownProps> = () => {
  return (
    <div>
      <StyleDefault />
      <hr />
      <StyleNewYork />
    </div>
  );
};

export default Dropdown;
