import * as React from "react";
import CustomSeparatorStyleDefault from "./Custom_separatorStyleDefault";
import CustomSeparatorStyleNewYork from "./Custom_separatorStyleDefault";
interface ICustomSeparatorProps {}

const CustomSeparator: React.FunctionComponent<ICustomSeparatorProps> = () => {
  return (
    <div className="container flex items-center justify-center">
      <div style={{ width: "100%" }}>
        <CustomSeparatorStyleDefault />
      </div>
      <div style={{ width: "100%" }}>
        <CustomSeparatorStyleNewYork />
      </div>
    </div>
  );
};

export default CustomSeparator;
