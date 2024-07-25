import * as React from "react";
import CollapsedStyleDefault from "./CollapsedStyleDefault";
import CollapsedStyleNewYork from "./CollapsedStyleNewYork";
interface ICollapsedProps {}

const Collapsed: React.FunctionComponent<ICollapsedProps> = () => {
  return (
    <div className="container flex item-center justify-center p-2">
      <CollapsedStyleDefault />
      <hr />
      <CollapsedStyleNewYork />
    </div>
  );
};

export default Collapsed;
