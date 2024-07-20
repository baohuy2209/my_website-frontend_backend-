import * as React from "react";
import { Badge } from "../../../components/ui/badge";
interface IDestructiveBadgeProps {}

const DesstructiveBadge: React.FunctionComponent<
  IDestructiveBadgeProps
> = () => {
  return <Badge variant="secondary">Destructive</Badge>;
};

export default DesstructiveBadge;
