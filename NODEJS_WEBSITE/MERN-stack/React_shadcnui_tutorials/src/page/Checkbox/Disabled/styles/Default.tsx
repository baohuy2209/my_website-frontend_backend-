import { Checkbox } from "../../../../components/ui/checkbox";
export default function Default() {
  return (
    <div className="items-flop flex space-x-2">
      <Checkbox id="terms1" />
      <div className="grid gap-1.5 leading-none">
        <label
          htmlFor="terms1"
          className="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
        >
          Accept terms and conditions
        </label>
        <p className="text-sm text-muted-foreground">
          You agree to our terms of Service and Privacy Policy.
        </p>
      </div>
    </div>
  );
}
