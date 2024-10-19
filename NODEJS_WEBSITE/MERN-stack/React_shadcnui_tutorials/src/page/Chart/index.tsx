import DefaultNoGrid from "./styles/BarChart/no_grid/Default";
import NewYorkNoGrid from "./styles/BarChart/no_grid/NewYork";
import DefaultHasGrid from "./styles/BarChart/has_grid/Default";
import NewYorkHasGrid from "./styles/BarChart/has_grid/NewYork";
import DefaultHasAxis from "./styles/BarChart/has_axis/Default";
import NewYorkHasAxis from "./styles/BarChart/has_axis/NewYork";
import DefaultTooltip from "./styles/BarChart/has_tooltip/Default";
import NewYorkTooktip from "./styles/BarChart/has_tooltip/NewYork";
import DefaultLegend from "./styles/BarChart/has_legend/Default";
import NewYorkLegend from "./styles/BarChart/has_legend/NewYork";
import LineChart from "./styles/LineChart/index";
const Chart = () => {
  return (
    <div className="flex flex-col">
      <div className="flex flex-row">
        <DefaultNoGrid />
        <NewYorkNoGrid />
      </div>
      <div className="flex flex-row">
        <DefaultHasGrid />
        <NewYorkHasGrid />
      </div>
      <div className="flex flex-row">
        <DefaultHasAxis />
        <NewYorkHasAxis />
      </div>
      <div className="flex flex-row">
        <DefaultTooltip />
        <NewYorkTooktip />
      </div>
      <div className="flex flex-row">
        <DefaultLegend />
        <NewYorkLegend />
      </div>
      <LineChart />
    </div>
  );
};

export default Chart;
