import Header from "./components/Header/Header";
import Footer from "./components/Footer/Footer";
import Container from "./components/container/container";
interface IAppProps {} // interface

const App: React.FunctionComponent<IAppProps> = () => {
  return (
    <>
      <Header />
      {/* Body web */}
      <Container />
      <Footer />
    </>
  );
};

export default App;
