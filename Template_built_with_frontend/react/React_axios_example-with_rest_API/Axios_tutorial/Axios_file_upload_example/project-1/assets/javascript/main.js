// create instance of axios
const instance = axios.create({
  baseURL: "http://localhost:8080",
});

document.getElementById("input-file").addEventListener("change", (e) => {
  if (e.target.files.length) {
    document.getElementById("input-file-label").innerHTML =
      e.target.files[0].name;
  }
});
async function uploadFile() {
  let messageElement = document.getElementById("message"); // get eleemnt which its id is message
  messageElement.innerHTML = "";
  const selectedFile = document.getElementById("input-file").files[0];
  console.log(selectedFile);
  let formData = new FormData();
  formData.append("file", selectedFile);

  document.getElementById("progress").style.display = "flex"; // disable the tag div has id is progress
  let progressBarElement = document.getElementById("progress-bar"); // get element has id is progress-bar
  progressBarElement.innerHTML = "0%";
  progressBarElement.setAttribute("aria-valuenow", 0);
  progressBarElement.style.width = "0%";

  const onUploadProgress = (event) => {
    const percentage = Math.round((100 * event.loaded) / event.total);
    progressBarElement.innerHTML = percentage + "%";
    progressBarElement.setAttribute("aria-valuenow", percentage);
    progressBarElement.style.width = percentage + "%";
  };

  try {
    const res = await instance.post("/upload", formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
      onUploadProgress,
    });
    const result = {
      status: res.status + "-" + res.statusText,
      headers: res.headers,
      data: res.data,
    };
    messageElement.innerHTML = htmlizeResponse(result);
  } catch (error) {
    messageElement.innerHTML = htmlizeResponse(error);
  }
}

async function getFiles() {
  let messageElement = document.getElementById("message");
  messageElement.innerHTML = "";

  let filesElement = document.getElementById("list-files");
  filesElement.innerHTML = "";
  try {
    const res = await instance.get("/files");
    const result = {
      status: res.status + "-" + res.statusText,
      headers: res.headers,
    };
    messageElement.innerHTML = htmlizeResponse(result);
    filesElement.innerHTML = getHTMLFiles(res.data);
    document.getElementById("list-files").style.display = "block";
  } catch (error) {
    messageElement.innerHTML = htmlizeResponse(err);
  }
}
function htmlizeResponse(res) {
  return (
    `<div class="alert alert-secondary mt-2" role="alert"><pre>` +
    JSON.stringify(res, null, 2) +
    "</pre></div>"
  );
}

function getHTMLFiles(fileInfos) {
  if (fileInfos && fileInfos.length) {
    const files = fileInfos.map((file, index) => {
      return (
        `<li class="list-group-item" key='` +
        index +
        `'>\
          <a href='` +
        file.url +
        `'>` +
        file.name +
        `</a>\
        </li>`
      );
    });
    return (
      `<div class="card-header">List of Files</div>\<ul class="list-group list-group-flush">` +
      file.join("") +
      `</ul>`
    );
  }
  return `No file was found!`;
}
