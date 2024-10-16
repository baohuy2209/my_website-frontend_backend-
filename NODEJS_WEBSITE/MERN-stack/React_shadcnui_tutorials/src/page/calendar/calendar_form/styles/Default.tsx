import { Calendar } from "../../../../components/ui/calendar";
import React from "react";
const NewYork = () => {
  const [date, setDate] = React.useState<Date | undefined>(new Date());
  return (
    <div className="w-[300px] flex flex-col justify-center items-center">
      <Calendar
        mode="single"
        selected={date}
        onSelect={setDate}
        className="rounded-md border"
      />
    </div>
  );
};
export default NewYork;
