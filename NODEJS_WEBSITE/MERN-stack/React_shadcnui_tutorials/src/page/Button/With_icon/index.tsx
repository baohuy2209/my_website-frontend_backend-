import * as React from "react";
import Default from "./Styles/Default";
import NewYork from "./Styles/NewYork";
interface IWithIconProps {}

const WithIcon: React.FunctionComponent<IWithIconProps> = () => {
  return (
    <div className="container mb-3">
      <Default />
      <NewYork />
    </div>
  );
};

export default WithIcon;
