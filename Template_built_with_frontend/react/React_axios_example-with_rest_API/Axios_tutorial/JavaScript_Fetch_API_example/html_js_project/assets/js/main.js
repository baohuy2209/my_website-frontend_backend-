const baseURL = "http://localhost:8080/api";

function htmlizeResponse(res) {
  return (
    `<div class="alert alert-secondary mt-2" role="alert"><pre>` +
    JSON.stringify(res, null, 2) +
    "</pre></div>"
  );
}

async function getAllData() {
  let resultElement = document.getElementById("getResult");
  resultElement.innerHTML = "";

  try {
    const res = await fetch(`${baseURL}/tutorials`);

    if (!res.ok) {
      const message = `An error has occured: ${res.status} - ${res.statusText}`;
      throw new Error(message);
    }

    const data = await res.json();

    const result = {
      status: res.status + "-" + res.statusText,
      headers: {
        "Content-Type": res.headers.get("Content-Type"),
        "Content-Length": res.headers.get("Content-Length"),
      },
      length: res.headers.get("Content-Length"),
      data: data,
    };

    resultElement.innerHTML = htmlizeResponse(result);
  } catch (err) {
    resultElement.innerHTML = htmlizeResponse(err.message);
  }
}

async function getDataById() {
  let resultElement = document.getElementById("getResult");
  resultElement.innerHTML = "";

  const id = document.getElementById("get-id").value;

  if (id) {
    try {
      const res = await fetch(`${baseURL}/tutorials/${id}`);

      if (!res.ok) {
        const message = `An error has occured: ${res.status} - ${res.statusText}`;
        throw new Error(message);
      }

      const data = await res.json();

      const result = {
        data: data,
        status: res.status,
        statusText: res.statusText,
        headers: {
          "Content-Type": res.headers.get("Content-Type"),
          "Content-Length": res.headers.get("Content-Length"),
        },
      };

      resultElement.innerHTML = htmlizeResponse(result);
    } catch (err) {
      resultElement.innerHTML = htmlizeResponse(err.message);
    }
  }
}

async function getDataByTitle() {
  let resultElement = document.getElementById("getResult");
  resultElement.innerHTML = "";

  const title = document.getElementById("get-title").value;

  if (title) {
    try {
      // const res = await fetch(`${baseURL}/tutorials?title=${title}`);

      let url = new URL(`${baseURL}/tutorials`);
      const params = { title: title };
      url.search = new URLSearchParams(params);

      const res = await fetch(url);

      if (!res.ok) {
        const message = `An error has occured: ${res.status} - ${res.statusText}`;
        throw new Error(message);
      }

      const data = await res.json();

      const result = {
        status: res.status + "-" + res.statusText,
        headers: {
          "Content-Type": res.headers.get("Content-Type"),
          "Content-Length": res.headers.get("Content-Length"),
        },
        data: data,
      };

      resultElement.innerHTML = htmlizeResponse(result);
    } catch (err) {
      resultElement.innerHTML = htmlizeResponse(err.message);
    }
  }
}

async function postData() {
  let resultElement = document.getElementById("postResult");
  resultElement.innerHTML = "";

  const title = document.getElementById("post-title").value;
  const description = document.getElementById("post-description").value;

  const postData = {
    title: title,
    description: description,
  };

  try {
    const res = await fetch(`${baseURL}/tutorials`, {
      method: "post",
      headers: {
        "Content-Type": "application/json",
        "x-access-token": "token-value",
      },
      body: JSON.stringify(postData),
    });

    if (!res.ok) {
      const message = `An error has occured: ${res.status} - ${res.statusText}`;
      throw new Error(message);
    }

    const data = await res.json();

    const result = {
      status: res.status + "-" + res.statusText,
      headers: {
        "Content-Type": res.headers.get("Content-Type"),
        "Content-Length": res.headers.get("Content-Length"),
      },
      data: data,
    };

    resultElement.innerHTML = htmlizeResponse(result);
  } catch (err) {
    resultElement.innerHTML = htmlizeResponse(err.message);
  }
}

async function putData() {
  let resultElement = document.getElementById("putResult");
  resultElement.innerHTML = "";

  const id = document.getElementById("put-id").value;
  const title = document.getElementById("put-title").value;
  const description = document.getElementById("put-description").value;
  const published = document.getElementById("put-published").checked;

  const putData = {
    title: title,
    description: description,
    published: published,
  };

  try {
    const res = await fetch(`${baseURL}/tutorials/${id}`, {
      method: "put",
      headers: {
        "Content-Type": "application/json",
        "x-access-token": "token-value",
      },
      body: JSON.stringify(putData),
    });

    if (!res.ok) {
      const message = `An error has occured: ${res.status} - ${res.statusText}`;
      throw new Error(message);
    }

    const data = await res.json();

    const result = {
      status: res.status + "-" + res.statusText,
      headers: { "Content-Type": res.headers.get("Content-Type") },
      data: data,
    };

    resultElement.innerHTML = htmlizeResponse(result);
  } catch (err) {
    resultElement.innerHTML = htmlizeResponse(err.message);
  }
}

async function deleteAllData() {
  let resultElement = document.getElementById("deleteResult");
  resultElement.innerHTML = "";

  try {
    const res = await fetch(`${baseURL}/tutorials`, { method: "delete" });

    const data = await res.json();

    const result = {
      status: res.status + "-" + res.statusText,
      headers: { "Content-Type": res.headers.get("Content-Type") },
      data: data,
    };

    resultElement.innerHTML = htmlizeResponse(result);
  } catch (err) {
    resultElement.innerHTML = htmlizeResponse(err.message);
  }
}

async function deleteDataById() {
  let resultElement = document.getElementById("deleteResult");
  resultElement.innerHTML = "";

  const id = document.getElementById("delete-id").value;

  try {
    const res = await fetch(`${baseURL}/tutorials/${id}`, { method: "delete" });

    const data = await res.json();

    const result = {
      status: res.status + "-" + res.statusText,
      headers: { "Content-Type": res.headers.get("Content-Type") },
      data: data,
    };

    resultElement.innerHTML = htmlizeResponse(result);
  } catch (err) {
    resultElement.innerHTML = htmlizeResponse(err.message);
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
