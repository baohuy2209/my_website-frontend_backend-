import Link from "next/link";
import { Button } from "../../../../components/ui/button";
import * as React from "react";

interface INewYorkProps {}

const NewYork: React.FunctionComponent<INewYorkProps> = () => {
  return (
    <Button asChild>
      <Link href="/login">Login</Link>
    </Button>
  );
};

export default NewYork;
