import Default from "./styles/Default";
import NewYork from "./styles/NewYork";
export default function Collapsible() {
  return (
    <div className="flex justify-center space-x-5">
      <div className="border-separate">
        <Default />
      </div>
      <div className="border-separate">
        <NewYork />
      </div>
    </div>
  );
}
