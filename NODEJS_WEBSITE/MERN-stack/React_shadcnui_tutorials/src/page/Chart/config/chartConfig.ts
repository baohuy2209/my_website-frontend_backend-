import { Monitor } from "lucide-react";
import { ChartConfig } from "@/components/ui/chart";
const chartConfig = {
  desktop: {
    label: "Desktop",
    icon: Monitor,
    color: "#2563eb",
  },
  mobile: {
    label: "Mobile",
    color: "#60a5fa",
  },
} satisfies ChartConfig;
export default chartConfig;
