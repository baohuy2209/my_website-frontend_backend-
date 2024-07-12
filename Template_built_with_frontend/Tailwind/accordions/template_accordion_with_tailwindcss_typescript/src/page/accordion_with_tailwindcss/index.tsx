import * as React from "react";
import "./input.css";
interface IAppProps {}

const App: React.FunctionComponent<IAppProps> = () => {
  return (
    <>
      <div className="h-screen bg-gradient-to-br from-pink-50 to-indigo-100 grid place-items-center">
        <div className="w-6/12 mx-auto rounded border">
          <div className="bg-white p-10 shadow-sm">
            <h3 className="text-lg font-medium text-gray-800">
              Several Windows stacked on each other
            </h3>
            <p className="text-sm font-light text-gray-600 my-3">
              The accordion is a graphical control element comprising a
              vertically stacked list of items such as labels or thumbnails
            </p>

            <div className="h-1 w-full mx-auto border-b my-5"></div>

            {/* <!-- What is term --> */}
            <div className="transition hover:bg-indigo-50">
              {/* <!-- header --> */}
              <div className="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 576 512"
                  className="h-5 w-5"
                >
                  <path d="M320 80a32 32 0 1 1 -64 0 32 32 0 1 1 64 0zM288 0c-44.2 0-80 35.8-80 80c0 35.9 23.7 66.3 56.3 76.4c-.2 1.2-.3 2.4-.3 3.6v32H216c-13.3 0-24 10.7-24 24s10.7 24 24 24h48V464H240c-73.7 0-133.7-58.6-135.9-131.8l16.3 14c10.1 8.6 25.2 7.5 33.8-2.6s7.5-25.2-2.6-33.8l-56-48c-9-7.7-22.3-7.7-31.2 0l-56 48c-10.1 8.6-11.2 23.8-2.6 33.8s23.8 11.2 33.8 2.6L56 332.1C58.2 431.8 139.8 512 240 512h48 48c100.2 0 181.8-80.2 184-179.9l16.4 14.1c10.1 8.6 25.2 7.5 33.8-2.6s7.5-25.2-2.6-33.8l-56-48c-9-7.7-22.2-7.7-31.2 0l-56 48c-10.1 8.6-11.2 23.8-2.6 33.8s23.8 11.2 33.8 2.6l16.3-14C469.7 405.4 409.7 464 336 464H312V240h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H312V160c0-1.2-.1-2.4-.3-3.6C344.3 146.3 368 115.9 368 80c0-44.2-35.8-80-80-80z" />
                </svg>
                <h3>What is term?</h3>
              </div>
              {/* <!-- Content --> */}
              <div className="accordion-content px-5 pt-0 overflow-hidden max-h-0">
                <p className="leading-6 font-light pl-9 text-justify">
                  Our asked sex point her she seems. New plenty she horses
                  parish design you. Stuff sight equal of my woody. Him children
                  bringing goodness suitable she entirely put far daughter.
                </p>
                <button className="rounded-full bg-indigo-600 text-white font-medium font-lg px-6 py-2 my-5 ml-9">
                  Learn more
                </button>
              </div>
            </div>

            {/* <!-- When to use Accordion Components --> */}
            <div className="transition hover:bg-indigo-50">
              {/* <!-- header --> */}
              <div className="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 576 512"
                  className="h-5 w-5"
                >
                  <path d="M320 80a32 32 0 1 1 -64 0 32 32 0 1 1 64 0zM288 0c-44.2 0-80 35.8-80 80c0 35.9 23.7 66.3 56.3 76.4c-.2 1.2-.3 2.4-.3 3.6v32H216c-13.3 0-24 10.7-24 24s10.7 24 24 24h48V464H240c-73.7 0-133.7-58.6-135.9-131.8l16.3 14c10.1 8.6 25.2 7.5 33.8-2.6s7.5-25.2-2.6-33.8l-56-48c-9-7.7-22.3-7.7-31.2 0l-56 48c-10.1 8.6-11.2 23.8-2.6 33.8s23.8 11.2 33.8 2.6L56 332.1C58.2 431.8 139.8 512 240 512h48 48c100.2 0 181.8-80.2 184-179.9l16.4 14.1c10.1 8.6 25.2 7.5 33.8-2.6s7.5-25.2-2.6-33.8l-56-48c-9-7.7-22.2-7.7-31.2 0l-56 48c-10.1 8.6-11.2 23.8-2.6 33.8s23.8 11.2 33.8 2.6l16.3-14C469.7 405.4 409.7 464 336 464H312V240h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H312V160c0-1.2-.1-2.4-.3-3.6C344.3 146.3 368 115.9 368 80c0-44.2-35.8-80-80-80z" />
                </svg>
                <h3>When to use Accordion Components?</h3>
              </div>
              {/* <!-- Content --> */}
              <div className="accordion-content px-5 pt-0 overflow-hidden max-h-0">
                <p className="leading-6 font-light pl-9 text-justify">
                  Our asked sex point her she seems. New plenty she horses
                  parish design you. Stuff sight equal of my woody. Him children
                  bringing goodness suitable she entirely put far daughter.
                </p>
                <button className="rounded-full bg-indigo-600 text-white font-medium font-lg px-6 py-2 my-5 ml-9">
                  Learn more
                </button>
              </div>
            </div>

            {/* <!-- Accordion Wrapper --> */}
            <div className="transition hover:bg-indigo-50">
              {/* <!-- header --> */}
              <div className="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 576 512"
                  className="h-5 w-5"
                >
                  <path d="M320 80a32 32 0 1 1 -64 0 32 32 0 1 1 64 0zM288 0c-44.2 0-80 35.8-80 80c0 35.9 23.7 66.3 56.3 76.4c-.2 1.2-.3 2.4-.3 3.6v32H216c-13.3 0-24 10.7-24 24s10.7 24 24 24h48V464H240c-73.7 0-133.7-58.6-135.9-131.8l16.3 14c10.1 8.6 25.2 7.5 33.8-2.6s7.5-25.2-2.6-33.8l-56-48c-9-7.7-22.3-7.7-31.2 0l-56 48c-10.1 8.6-11.2 23.8-2.6 33.8s23.8 11.2 33.8 2.6L56 332.1C58.2 431.8 139.8 512 240 512h48 48c100.2 0 181.8-80.2 184-179.9l16.4 14.1c10.1 8.6 25.2 7.5 33.8-2.6s7.5-25.2-2.6-33.8l-56-48c-9-7.7-22.2-7.7-31.2 0l-56 48c-10.1 8.6-11.2 23.8-2.6 33.8s23.8 11.2 33.8 2.6l16.3-14C469.7 405.4 409.7 464 336 464H312V240h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H312V160c0-1.2-.1-2.4-.3-3.6C344.3 146.3 368 115.9 368 80c0-44.2-35.8-80-80-80z" />
                </svg>
                <h3>How can it be defined?</h3>
              </div>
              {/* <!-- Content --> */}
              <div className="accordion-content px-5 pt-0 overflow-hidden max-h-0">
                <p className="leading-6 font-light pl-9 text-justify">
                  Our asked sex point her she seems. New plenty she horses
                  parish design you. Stuff sight equal of my woody. Him children
                  bringing goodness suitable she entirely put far daughter.
                </p>
                <button className="rounded-full bg-indigo-600 text-white font-medium font-lg px-6 py-2 my-5 ml-9">
                  Learn more
                </button>
              </div>
            </div>

            {/* <!-- Accordion Wrapper --> */}
            <div className="transition hover:bg-indigo-50">
              {/* <!-- header --> */}
              <div className="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 576 512"
                  className="h-5 w-5"
                >
                  <path d="M320 80a32 32 0 1 1 -64 0 32 32 0 1 1 64 0zM288 0c-44.2 0-80 35.8-80 80c0 35.9 23.7 66.3 56.3 76.4c-.2 1.2-.3 2.4-.3 3.6v32H216c-13.3 0-24 10.7-24 24s10.7 24 24 24h48V464H240c-73.7 0-133.7-58.6-135.9-131.8l16.3 14c10.1 8.6 25.2 7.5 33.8-2.6s7.5-25.2-2.6-33.8l-56-48c-9-7.7-22.3-7.7-31.2 0l-56 48c-10.1 8.6-11.2 23.8-2.6 33.8s23.8 11.2 33.8 2.6L56 332.1C58.2 431.8 139.8 512 240 512h48 48c100.2 0 181.8-80.2 184-179.9l16.4 14.1c10.1 8.6 25.2 7.5 33.8-2.6s7.5-25.2-2.6-33.8l-56-48c-9-7.7-22.2-7.7-31.2 0l-56 48c-10.1 8.6-11.2 23.8-2.6 33.8s23.8 11.2 33.8 2.6l16.3-14C469.7 405.4 409.7 464 336 464H312V240h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H312V160c0-1.2-.1-2.4-.3-3.6C344.3 146.3 368 115.9 368 80c0-44.2-35.8-80-80-80z" />
                </svg>
                <h3>Chamber reached do he nothing be?</h3>
              </div>
              {/* <!-- Content --> */}
              <div className="accordion-content px-5 pt-0 overflow-hidden max-h-0">
                <p className="leading-6 font-light pl-9 text-justify">
                  Our asked sex point her she seems. New plenty she horses
                  parish design you. Stuff sight equal of my woody. Him children
                  bringing goodness suitable she entirely put far daughter.
                </p>
                <button className="rounded-full bg-indigo-600 text-white font-medium font-lg px-6 py-2 my-5 ml-9">
                  Learn more
                </button>
              </div>
            </div>
          </div>
        </div>
        <section className="mt-4 text-center">
          Build with ❤️ by{" "}
          <a href="https://github.com/saadh393" target="_blank">
            Saad Hasan{" "}
          </a>
        </section>
        <script>
    const accordionHeader = document.querySelectorAll(".accordion-header");
    accordionHeader.forEach((header) => {
    header.addEventListener("click", function () {
        const accordionContent = header.parentElement.querySelector(".accordion-content");
        let accordionMaxHeight = accordionContent.style.maxHeight;

        // Condition handling
        if (accordionMaxHeight == "0px" || accordionMaxHeight.length == 0) {
        accordionContent.style.maxHeight = `${accordionContent.scrollHeight + 32}px`;
        header.querySelector(".fas").classList.remove("fa-plus");
        header.querySelector(".fas").classList.add("fa-minus");
        header.parentElement.classList.add("bg-indigo-50");
        } else {
        accordionContent.style.maxHeight = `0px`;
        header.querySelector(".fas").classList.add("fa-plus");
        header.querySelector(".fas").classList.remove("fa-minus");
        header.parentElement.classList.remove("bg-indigo-50");
        }
    });
    });
</script>
      </div>
    </>
  );
};

export default App;
