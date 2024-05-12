import * as React from "react";
import FormContainer from "../FormContainer/FormContainer";
import { UrlData } from "../../interface/UrlData";
import axios from "axios";
import { serverUrl } from "../../helper/Constants";
import DataTable from "../DataTable/DataTable";
interface IContainerProps {}

const Container: React.FunctionComponent<IContainerProps> = () => {
  const [data, setData] = React.useState<UrlData[]>([]);
  const [reload, setReaload] = React.useState<boolean>(false);
  const updateReloadState = (): void => {
    setReaload(true);
  };
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
