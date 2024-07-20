import * as React from "react";
import CustomeSeparator from "./components/CustomSeparator/index";
import Collapsed from "./components/Collapsed/index";
import LinkComponent from "./components/LinkComponent/index";
import Responsive from "./components/Responsive/index";
import Dropdown from "./components/Dropdown/index";
interface IBreabCrumbProps {}

const BreabCrumb: React.FunctionComponent<IBreabCrumbProps> = () => {
  return (
    <div className="container">
      <CustomeSeparator />
      <hr />
      <Collapsed />
      <hr />
      <LinkComponent />
      <hr />
      <Responsive />
      <hr />
      <Dropdown />
    </div>
  );
};

export default BreabCrumb;
