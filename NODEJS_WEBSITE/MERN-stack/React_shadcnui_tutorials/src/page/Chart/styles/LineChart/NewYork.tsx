import { Line, LineChart, CartesianGrid, XAxis } from "recharts";
import {
  ChartContainer,
  ChartTooltip,
  ChartTooltipContent,
  ChartLegend,
  ChartLegendContent,
} from "@/components/ui/chart";
import chartData from "../../data/dataChart";
import chartConfig from "../../config/chartConfig";

const NewYork = () => {
  return (
    <div className="mt-4 w-1/2 mr-10">
      <ChartContainer config={chartConfig} className="min-h-[200px] w-full">
        <LineChart accessibilityLayer data={chartData}>
          <CartesianGrid vertical={false} />
          <XAxis
            dataKey="month"
            tickLine={false}
            tickMargin={10}
            axisLine={false}
            tickFormatter={(value) => value.slice(0, 3)}
          />
          <ChartTooltip content={<ChartTooltipContent nameKey="month" />} />
          <ChartLegend content={<ChartLegendContent />} />
          <Line dataKey="desktop" fill="var(--color-desktop)" radius={4} />
          <Line dataKey="mobile" fill="var(--color-mobile)" radius={4} />
        </LineChart>
      </ChartContainer>
      <span className="text-red-400 text-muted-foreground font-semibold">
        Chart indicate number of using desktop and mobile in first six months of
        year (items)
      </span>
    </div>
  );
};
export default NewYork;
