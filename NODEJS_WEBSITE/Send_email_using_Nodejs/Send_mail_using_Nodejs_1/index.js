const express = require("express");
const nodemailer = require("nodemailer");
const app = express();
const port = 3000;
const secure_configuration = require("./secure");
const transporter = nodemailer.createTransport({
  service: "gmail",
  auth: {
    type: "OAuth2",
    user: secure_configuration.EMAIL_USERNAME,
    pass: secure_configuration.PASSWORD,
    clientId: secure_configuration.CLIENT_ID,
    clientSecret: secure_configuration.CLIENT_SECRET,
    refreshToken: secure_configuration.REFRESH_TOKEN,
  },
});
const mailConfigurations = {
  // It should be a string of sender email
  from: "mrtwinklesharma@gmail.com",
  to: "smtwinkle451@gmail.com, anyothergmailid@gmail.com",
  subject: "Sending email using node.js",
  html: "<h2>Hi! There</h2> <h5> This HTML content is being send by NodeJS along with NodeMailer.</h5>",
  attachments: [
    {
      filename: "text.txt",
      content: "Hello, GeekforGeeks Learner",
    },
    {
      path: "/home/mrtwinklesharma/Programming/document.docx",
    },
    {
      path: "/home/mrtwinklesharma/Videos/Sample.mp4",
    },
    {
      filename: "license.txt",
      path: "https://raw.github.com/nodemailer/nodemailer/master/LICENSE",
    },
  ],
};
transporter.sendMail(mailConfigurations, function (error, info) {
  if (error) throw Error(error);
  console.log("Email sent successfully");
  console.log(info);
});
app.get("/", (req, res) => {
  req.send("Hello world!");
});

app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
});
