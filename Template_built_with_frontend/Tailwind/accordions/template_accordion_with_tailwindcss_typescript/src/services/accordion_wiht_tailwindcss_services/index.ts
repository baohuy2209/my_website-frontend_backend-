import React, { ReactHTMLElement } from "react";
const accordionHeader: [HTMLDivElement] =
  document.querySelectorAll(".accordion-header");
accordionHeader.forEach((header) => {
  header.addEventListener("click");
});
