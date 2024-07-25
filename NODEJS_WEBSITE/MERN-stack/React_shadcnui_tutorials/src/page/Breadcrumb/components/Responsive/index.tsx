import * as React from "react";
import ResponsiveStyleDefault from "./ResponsiveStyleDefault";
import ResponsiveStyleNewYork from "./ResponsiveStyleNewYork";
interface IResponsiveProps {}

const Responsive: React.FunctionComponent<IResponsiveProps> = () => {
  return (
    <div className="container">
      <ResponsiveStyleDefault />
      <hr />
      <ResponsiveStyleNewYork />
    </div>
  );
};

export default Responsive;
