import * as React from "react";
import DropdownStyleDefault from "./DropdownStyleDefault";
import DropdownStyleNewYork from "./DropdownStyleNewYork";
interface IDropdownProps {}

const Dropdown: React.FunctionComponent<IDropdownProps> = () => {
  return (
    <div>
      <DropdownStyleDefault />
      <hr />
      <DropdownStyleNewYork />
    </div>
  );
};

export default Dropdown;
