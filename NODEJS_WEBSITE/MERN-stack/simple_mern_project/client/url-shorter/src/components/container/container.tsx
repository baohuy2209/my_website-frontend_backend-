// component container
import * as React from "react";
// child component : form container
import FormContainer from "../FormContainer/FormContainer";
import { UrlData } from "../../interface/UrlData"; // import interface
import axios from "axios";
import { serverUrl } from "../../helper/Constants";
// child components: datatable
import DataTable from "../DataTable/DataTable";
interface IContainerProps {} // interface

const Container: React.FunctionComponent<IContainerProps> = () => {
  const [data, setData] = React.useState<UrlData[]>([]);
  const [reload, setReaload] = React.useState<boolean>(false); // set up the state has boolean value. This state is used to check container had reloaded
  const updateReloadState = (): void => {
    setReaload(true);
  }; // function to update the reload state

  const fetchTableData = async () => {
    const response = await axios.get(`${serverUrl}/shortUrl`);
    console.log("The response from server is: ", response);
    setData(response.data);
    setReaload(false);
  };
  React.useEffect(() => {
    fetchTableData();
  }, [reload]);
  return (
    <>
      <FormContainer updateReloadState={updateReloadState} />
      <DataTable updateReloadState={updateReloadState} data={data} />
    </>
  );
};

export default Container;
