import Link from "next/link";
import { Button } from "../../../../components/ui/button";
import * as React from "react";

interface IDefaultProps {}

const Default: React.FunctionComponent<IDefaultProps> = () => {
  return (
    <Button asChild>
      <Link href="/login">Login</Link>
    </Button>
  );
};

export default Default;
