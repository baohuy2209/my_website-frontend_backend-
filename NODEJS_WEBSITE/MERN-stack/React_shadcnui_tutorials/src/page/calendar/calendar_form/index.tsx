import Default from "./styles/Default";
import NewYork from "./styles/NewYork";
const Calendar = () => {
  return (
    <div className="flex flex-row justify-center items-center">
      <Default />
      <NewYork />
    </div>
  );
};

export default Calendar;
