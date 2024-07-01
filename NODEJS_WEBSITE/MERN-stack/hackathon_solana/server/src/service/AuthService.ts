import jwt from "jsonwebtoken";
import bcrypt, { genSalt, genSaltSync } from "bcrypt";
import db from "../app/model/index";
import "dotenv/config";
import * as express from "express";
const salt = genSaltSync(10);
// encoded the password
const hashUserPassword = (userPassword: string) => {
  let hashPassword = bcrypt.hashSync(userPassword, salt);
  return hashPassword;
};
// check password that the password which is entered from the keyboard is the same as the password which is stored in the database
const checkPassword = (inputPassword: string, hashPassword: string) => {
  return bcrypt.compare(inputPassword, hashPassword);
};
// function to get user from logging in
const getUserLogin = async (userName: string) => {
  let user = null;
  user = await db.user.findOne({
    username: userName,
  });
  return user;
};
const checkEmailExist = async (email: string) => {
  let user = null;
  user = await db.user.findOne({
    email: email,
  });
  if (user == null) {
    return false; // this email does not exist
  } else {
    return true;
  }
};
const handleRegister = async (req: express.Request, res: express.Response) => {
  const { username, password, email, phone } = req.body;
  try {
    let isEmailExist = await checkEmailExist(email);
    if (isEmailExist) {
      return { EM: "Email hasn't already existed", EC: -2, DT: [] };
    }
    let hashPassword = hashUserPassword(password);
    let newUser = null;
    if (
      username != null &&
      hashPassword != null &&
      email != null &&
      phone != null
    ) {
      newUser = {
        username: username,
        password: hashPassword,
        email: email,
        phone: phone,
      };
    }
    const data = new db.user(newUser);
    data
      .save()
      .then(() => {
        return {
          EM: "Register successfully",
          EC: 0,
          DT: data,
        };
      })
      .catch((err) => {
        console.log("error: ", err);
        return {
          EM: "Data don't store in database",
          EC: -2,
          DT: [],
        };
      });
  } catch (error) {
    console.log(">>> err", error);
    return {
      EM: "The server is having an error!",
      EC: -5,
      DT: [],
    };
  }
};
const handleLogin = async (req: express.Request, res: express.Response) => {
  try {
    const user = await getUserLogin(req.body.username);
    if (user === null) {
      return {
        EM: "Login failed",
        EC: -2,
        DT: [],
      };
    }
    var user_password: any = user.password;
    let isCorrectPassword = await checkPassword(
      req.body.password,
      user_password
    );
    if (isCorrectPassword) {
      let tokenData = {
        id: user.id,
        username: user.username,
        phone: user.phone,
        email: user.email,
      };
      const accessToken = jwt.sign(tokenData, "fwfwfwfwfwfwf", {
        expiresIn: "60s",
      });
      const refreshToken = jwt.sign(tokenData, "sfwfwfwgfwgwfwf");
      db.student.findByIdAndUpdate(user.id, { refresh_token: refreshToken });
      return {
        EM: "ok",
        EC: 0,
        DT: {
          tokenData,
          accessToken: accessToken,
          refreshToken: refreshToken,
        },
      };
    } else {
      return {
        EM: "Login information is incorrect",
        EC: -2,
        DT: [],
      };
    }
  } catch (error) {
    console.log("error: ", error);
    return {
      EM: "The Server is having an error",
      EC: -5,
      DT: [],
    };
  }
};
export default { handleLogin, handleRegister };
