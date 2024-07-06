import instance from "./axios.config";
import htmlize from "./htmlizeResponse";
async function getAllData() {
  let resultElement = document.getElementById("getResult");
  resultElement.innerHTML = "";
  try {
    const res = await instance.get("tutorials");

    const result = {
      status: res.status + " - " + res.statusText,
      headers: res.headers,
      data: res.data,
    };
    resultElement.innerHTML = htmlize(result);
  } catch (err) {
    resultElement.innerHTML = htmlize(err);
  }
}
async function getDataById() {
  let resultElement = document.getElementById("getResult");
  resultElement.innerHTML = "";

  const id = document.getElementById("get-id").value;

  if (id) {
    try {
      const res = await instance.get(`/tutorials/${id}`);
      const result = {
        status: res.status + "-" + res.statusText,
        headers: res.headers,
        data: res.data,
      };
      resultElement.innerHTML = htmlize(result);
    } catch (error) {
      resultElement.innerHTML = htmlize(error);
    }
  }
}
async function getDataByTitle() {
  let resultElement = document.getElementById("getResult");
  resultElement.innerHTML = "";

  const title = document.getElementById("get-title").value;

  if (title) {
    try {
      const res = await instance.get("/tutorials", {
        params: {
          title: title,
        },
      }); // find data by title
      const result = {
        status: res.status + "-" + res.statusText,
        headers: res.headers,
        data: res.data,
      };

      resultElement.innerHTML = htmlize(result);
    } catch (err) {
      resultElement.innerHTML = htmlize(err);
    }
  }
}

async function postData() {
  let resultElement = document.getElementById("postResult");
  resultElement.innerHTML = "";

  const title = document.getElementById("post-title").value;
  const description = document.getElementById("post-description").value;

  try {
    const res = await instance.post("/tutorials", {
      title: title,
      desription: description,
    });
    const result = {
      status: res.status + "-" + res.statusText,
      headers: res.headers,
      data: res.data,
    };

    resultElement.innerHTML = htmlize(result);
  } catch (err) {
    resultElement.innerHTML = htmlize(err);
  }
}
async function putData() {
  let resultElement = document.getElementById("putResult");
  resultElement.innerHTML = "";

  const id = document.getElementById("put-id").value;
  const title = document.getElementById("put-title").value;
  const description = document.getElementById("put-description").value;
  const published = document.getElementById("put-published").checked;

  try {
    const res = await instance.put(`/tutorials/${id}`, {
      title: title,
      description: description,
      published: published,
    });
    const result = {
      status: res.status + "-" + res.statusText,
      headers: res.headers,
      data: res.data,
    };
    resultElement.innerHTML = htmlize(result);
  } catch (err) {
    resultElement.innerHTML = htmlize(err);
  }
}
async function deleteAllData() {
  let resultElement = document.getElementById("deleteResult");
  resultElement.innerHTML = "";

  try {
    const res = await instance.delete("/tutorials");
    const result = {
      status: res.status + "-" + res.statusText,
      headers: res.headers,
      data: res.data,
    };
    resultElement.innerHTML = htmlize(result);
  } catch (err) {
    resultElement.innerHTML = htmlize(err);
  }
}
async function deleteDataById() {
  let resultElement = document.getElementById("deleteResult");
  resultElement.innerHTML = "";
  const id = document.getElementById("delete-id").value;
  try {
    const res = await instance.delete(`tutorials/${id}`);
    const result = {
      status: res.status + "-" + res.statusText,
      heades: res.headers,
      data: res.data,
    };
    resultElement.innerHTML = htmlize(result);
  } catch (err) {
    resultElement.innerHTML = htmlize(err);
  }
}
function clearGetOutput() {
  document.getElementById("getResult").innerHTML = "";
}
function clearPostOutput() {
  document.getElementById("postResult").innerHTML = "";
}
function clearPutOutput() {
  document.getElementById("putResult").innerHTML = "";
}
function clearDeleteOutput() {
  document.getElementById("deleteResult").innerHTML = "";
}
const Operation = {
  getAllData,
  getDataById,
  clearDeleteOutput,
  clearPutOutput,
  clearPostOutput,
  clearGetOutput,
  deleteDataById,
  deleteAllData,
  putData,
  postData,
  getDataByTitle,
};
export default Operation;
