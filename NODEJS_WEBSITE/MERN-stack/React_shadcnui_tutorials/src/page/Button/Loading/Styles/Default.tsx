import { Loader2 } from "lucide-react";
import { Button } from "../../../../components/ui/button";

const Default = () => {
  return (
    <div className="mb-2">
      <Button disabled>
        <Loader2 className="mr-2 h-4 w-4 animate-spin" /> Please wait
      </Button>
    </div>
  );
};

export default Default;
