import * as React from "react";
import StyleDefault from "./CollapsedStyleDefault";
import StyleNewYork from "./CollapsedStyleNewYork";
interface ICollapsedProps {}

const Collapsed: React.FunctionComponent<ICollapsedProps> = () => {
  return (
    <div className="container flex item-center justify-center p-2">
      <StyleDefault />
      <hr />
      <StyleNewYork />
    </div>
  );
};

export default Collapsed;
