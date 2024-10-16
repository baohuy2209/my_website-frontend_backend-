import { ChevronRightIcon } from "@radix-ui/react-icons";
import { Button } from "../../../../components/ui/button";
const NewYork = () => {
  return (
    <div>
      <Button variant="outline" size="icon">
        <ChevronRightIcon className="h-4 w-4" />
      </Button>
    </div>
  );
};

export default NewYork;
