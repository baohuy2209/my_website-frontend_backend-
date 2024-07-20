import * as React from "react";
import { Badge } from "../../../components/ui/badge";
interface IOutlineBadgeProps {}

const OutlineBadge: React.FunctionComponent<IOutlineBadgeProps> = () => {
  return <Badge variant="outline">Outline</Badge>;
};

export default OutlineBadge;
