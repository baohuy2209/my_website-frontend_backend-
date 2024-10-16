import * as React from "react";
import AsChildButton from "./Aschild/index";
import WithIconButton from "./With_icon/index";
import LoadingButton from "./Loading/index";
import IconButton from "./Icon/index";
import LinkButton from "./Link/index";
import GhostButton from "./Ghost/index";
import OutlineButton from "./Outline/index";
import DestructiveButton from "./Destructive/index";
import SecondaryButton from "./Secondary/index";
import PrimaryButton from "./Primary/index";
interface IButtonProps {}

const Button: React.FunctionComponent<IButtonProps> = () => {
  return (
    <div className="container">
      <AsChildButton />
      <WithIconButton />
      <LoadingButton />
      <IconButton />
      <LinkButton />
      <GhostButton />
      <OutlineButton />
      <DestructiveButton />
      <SecondaryButton />
      <PrimaryButton />
    </div>
  );
};

export default Button;
