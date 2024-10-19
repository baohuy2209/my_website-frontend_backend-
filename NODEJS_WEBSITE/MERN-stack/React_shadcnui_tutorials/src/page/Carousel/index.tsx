import Carousel1 from "./carousel1/index";
import Size from "./sizes/index";
import Spacing from "./spacing/index";
import Plugins from "./plugin/index";
import Orientation from "./orientation/index";
import API from "./api/index";
const Carousel = () => {
  return (
    <div className="gap-y-5">
      <Carousel1 />
      <Size />
      <Spacing />
      <Plugins />
      <Orientation />
      <API />
    </div>
  );
};
export default Carousel;
