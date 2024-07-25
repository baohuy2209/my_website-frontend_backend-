import * as React from "react";
import AsChildButton from "./Aschild/index";

interface IButtonProps {}

const Button: React.FunctionComponent<IButtonProps> = () => {
  return (
    <div className="container">
      <AsChildButton />
    </div>
  );
};

export default Button;
