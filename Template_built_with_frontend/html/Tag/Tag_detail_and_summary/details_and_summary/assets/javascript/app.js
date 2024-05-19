document.addEventListener("DOMContentLoaded", () => {
  for (let i = 0; i < 50; i++) {
    const accordion = document.createElement("details");
    accordion.innerHTML =
      "<summary><div class='lx-avatar'><img src='http://randomuser.me/api/portraits/" +
      (i % 2 === 0 ? "women" : "men") +
      "/" +
      i +
      ".jpg' alt='' /></div><p><b>Lorem ipsum</b><br/><b>Age:</b> ??</p></summary><h4>Bio:</h4><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo libero nam ipsa voluptatem illo aspernatur, repellat dignissimos quo dolorem accusantium, tempora magni ipsam ut. Eum quidem delectus totam culpa placeat.</p>";
    document.querySelector("#women").append(accordion);
  }

  for (let i = 50; i < 100; i++) {
    const accordion = document.createElement("details");
    accordion.innerHTML =
      "<summary><div class='lx-avatar'><img src='http://randomuser.me/api/portraits/" +
      (i % 2 === 0 ? "women" : "men") +
      "/" +
      i +
      ".jpg' alt='' /></div><p><b>Lorem ipsum</b><br/><b>Age:</b> ??</p></summary><h4>Bio:</h4><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo libero nam ipsa voluptatem illo aspernatur, repellat dignissimos quo dolorem accusantium, tempora magni ipsam ut. Eum quidem delectus totam culpa placeat.</p>";
    document.querySelector("#men").append(accordion);
  }
});
