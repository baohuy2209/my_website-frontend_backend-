import "./App.css";
import Header from "./components/Header";
import Accordion from "./components/Accordion";
function App() {
  const title = "Accordion App";
  const hiddenTexts = [
    {
      label: "Button 1",
      value: "Text of Accordion 1",
    },
    {
      label: "Button 2",
      value: "Text of Accordion 2",
    },
    {
      label: "Button 3",
      value: "Text of Accordion 3",
    },
    {
      label: "Button 4",
      value: "Text of Accordion ",
    },
  ];
  return (
    <div className="App">
      <Header title={title} />
      <Accordion hiddenTexts={hiddenTexts} />
    </div>
  );
}

export default App;
