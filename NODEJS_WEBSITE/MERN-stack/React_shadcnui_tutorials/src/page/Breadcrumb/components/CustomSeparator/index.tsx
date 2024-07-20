import * as React from "react";
import StyleDefault from "./Custom_separatorStyleDefault";
import StyleNewYork from "./Custom_separatorStyleDefault";
interface ICustomSeparatorProps {}

const CustomSeparator: React.FunctionComponent<ICustomSeparatorProps> = () => {
  return (
    <div className="container flex items-center justify-center">
      <StyleDefault />
      <hr />
      <StyleNewYork />
    </div>
  );
};

export default CustomSeparator;
