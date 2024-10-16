import { Mail } from "lucide-react";
import { Button } from "../../../../components/ui/button";
export default function Default() {
  return (
    <div className="mb-3">
      <Button>
        <Mail className="mr-2 h-4 w-4" /> Login with Eamil
      </Button>
    </div>
  );
}
