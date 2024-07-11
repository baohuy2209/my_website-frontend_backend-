import { Alert, AlertDescription, AlertTitle } from "../../components/ui/alert";
export default function AlertExample() {
  return (
    <>
      <Alert>
        <AlertTitle>Heads up!</AlertTitle>
        <AlertDescription>
          You can add components and dependencies to your app using the cli
        </AlertDescription>
      </Alert>
    </>
  );
}
