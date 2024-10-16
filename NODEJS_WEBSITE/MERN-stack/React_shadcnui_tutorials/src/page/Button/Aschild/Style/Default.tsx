import { Button } from "../../../../components/ui/button";
import * as React from "react";

interface IDefaultProps {}

const Default: React.FunctionComponent<IDefaultProps> = () => {
  return (
    <Button asChild>
      <a href="/login">Login</a>
    </Button>
  );
};

export default Default;
