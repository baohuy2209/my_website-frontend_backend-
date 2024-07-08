import React from "react";
import { Routes, Route } from "react-router-dom";

import Tutorial from "./components/Tutorial";
import TutorialList from "./components/TutorialList";

function App() {
  return (
    <div>
      <div>
        <Routes>
          <Route path="tutorials" element={<TutorialList />} />
          <Route path="tutorials/:id" element={<Tutorial />} />
        </Routes>
      </div>
    </div>
  );
}

export default App;
