import { Button } from "../../../../components/ui/button";
import { ReloadIcon } from "@radix-ui/react-icons";
const NewYork = () => {
  return (
    <div>
      <Button disabled>
        <ReloadIcon className="mr-2 h-4 w-4 animate-spin" /> Please wait
      </Button>
    </div>
  );
};

export default NewYork;
