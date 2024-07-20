import * as React from "react";
import { Badge } from "../../../components/ui/badge";
interface ISecondaryBadgeProps {}

const SecondaryBadge: React.FunctionComponent<ISecondaryBadgeProps> = () => {
  return <Badge variant="secondary">Secondary</Badge>;
};

export default SecondaryBadge;
