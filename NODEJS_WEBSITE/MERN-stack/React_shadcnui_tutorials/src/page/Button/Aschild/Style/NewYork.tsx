import { Button } from "../../../../components/ui/button";
import * as React from "react";

interface INewYorkProps {}

const NewYork: React.FunctionComponent<INewYorkProps> = () => {
  return (
    <Button asChild>
      <a href="/login">Login</a>
    </Button>
  );
};

export default NewYork;
