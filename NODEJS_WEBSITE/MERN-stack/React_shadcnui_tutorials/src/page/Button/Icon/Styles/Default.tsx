import { ChevronRight } from "lucide-react";
import { Button } from "../../../../components/ui/button";

const Default = () => {
  return (
    <div className="mb-3">
      <Button variant="outline" size="icon">
        <ChevronRight className="h-4 w-4" />
      </Button>
    </div>
  );
};

export default Default;
