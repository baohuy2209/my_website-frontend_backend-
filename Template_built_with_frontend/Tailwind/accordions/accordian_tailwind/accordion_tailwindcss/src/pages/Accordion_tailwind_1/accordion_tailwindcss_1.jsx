import "./assets/css/style.css";
import { useState } from "react";
import data from "./assets/javascript/data";
import Accordion_item from "./components/accordion-item";
function Accordion_tailwindcss_1() {
  const [accordions, setAccordions] = useState(data);
  setAccordions(null);
  return (
    <main>
      <div className="container">
        <div className="h-screen bg-gradient-to-br from-pink-50 to-indigo-100 grid place place-items-center">
          <div className="w-6/12 mx-auto rounded border">
            <div className="bg-white p-10 shadow-sm">
              <div>
                <h3 className="text-lg font-medium text-gray-800">
                  Several Windows stacked on each other
                </h3>
                <p className="text-sm font-light text-gray-600 my-3">
                  The accordion is a graphical control element comprising a
                  vertically stacked list of items such as labels or thumbnails
                </p>
                <div className="h-1 w-full mx-auto border-b my-5"></div>
                <section>
                  {accordions.map((accordion) => {
                    return (
                      <Accordion_item
                        key={accordion.id}
                        title={accordion.title}
                        information={accordion.information}
                      />
                    );
                  })}
                </section>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  );
}
export default Accordion_tailwindcss_1;
