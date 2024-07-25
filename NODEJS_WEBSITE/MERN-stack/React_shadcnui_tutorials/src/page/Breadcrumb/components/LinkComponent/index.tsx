import * as React from "react";
import LinkComponentStyleDefault from "./LinkComponentStyleDefault";
import LinkComponentStyleNewYork from "./LinkComponentStyleNewYork";
interface ILinkComponentProps {}

const LinkComponent: React.FunctionComponent<ILinkComponentProps> = () => {
  return (
    <div className="container">
      <LinkComponentStyleDefault />
      <hr />
      <LinkComponentStyleNewYork />
    </div>
  );
};

export default LinkComponent;
