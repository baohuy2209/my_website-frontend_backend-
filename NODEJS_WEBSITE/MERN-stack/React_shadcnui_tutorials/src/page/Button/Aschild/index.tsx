import * as React from "react";
import Default from "./Style/Default";
import NewYork from "./Style/NewYork";
interface IAsChildProps {}

const AsChild: React.FunctionComponent<IAsChildProps> = () => {
  return (
    <div className="container">
      <Default />
      <NewYork />
    </div>
  );
};

export default AsChild;
