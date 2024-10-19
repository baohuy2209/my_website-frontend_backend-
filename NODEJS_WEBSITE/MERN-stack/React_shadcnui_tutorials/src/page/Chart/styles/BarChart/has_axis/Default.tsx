import { Bar, BarChart, CartesianGrid, XAxis } from "recharts";
import { ChartContainer } from "@/components/ui/chart";
import chartData from "../../../data/dataChart";
import chartConfig from "../../../config/chartConfig";

const Default = () => {
  return (
    <div className="mt-4 w-1/2 mr-10">
      <ChartContainer config={chartConfig} className="min-h-[200px] w-full">
        <BarChart accessibilityLayer data={chartData}>
          <CartesianGrid vertical={false} />
          <XAxis
            dataKey="month"
            tickLine={false}
            tickMargin={10}
            axisLine={false}
            tickFormatter={(value) => value.slice(0, 3)}
          />
          <Bar dataKey="desktop" fill="var(--color-desktop)" radius={4} />
          <Bar dataKey="mobile" fill="var(--color-mobile)" radius={4} />
        </BarChart>
      </ChartContainer>
      <span className="text-red-400 text-muted-foreground font-semibold">
        Chart indicate number of using desktop and mobile in first six months of
        year (items)
      </span>
    </div>
  );
};
export default Default;
