import jwt from "jsonwebtoken";
import express from "express";
import db from "../model/index";
const verifyToken = async (
  req: express.Request,
  res: express.Response,
  next: express.NextFunction
) => {
  const authorizationHeader = await req.headers.authorization;
  if (authorizationHeader) {
    const token = authorizationHeader.split(" ")[1];
    jwt.verify(token, "fwfwfwfwfwfwf", (err: any, data: any) => {
      console.log("verify >>>>>>", data);
      if (err) {
        return res.status(403).json("Token is not valid");
      }
      req.body = data;
      next();
    });
  } else {
    return res.status(401).json("You are not authenticated !");
  }
};
const isAdmin = (
  req: express.Request,
  res: express.Response,
  next: express.NextFunction
) => {
  db.user
    .findById(req.body.id)
    .then((user: any) => {
      db.role
        .find({
          _id: { $in: user.roles },
        })
        .then((roles: any) => {
          for (let i = 0; i < roles.length; i++) {
            if (roles[i].name === "admin") {
              next();
              return;
            }
          }
          res.status(403).send({ message: "Require Admin Role" });
        })
        .catch((err: any) => {
          console.error("error", err);
          res.status(500).send({ message: err });
        });
    })
    .catch((err: any) => {
      console.log("error: ", err);
      res.status(500).send({ message: err });
    });
};
const isModerator = (
  req: express.Request,
  res: express.Response,
  next: express.NextFunction
) => {
  db.user
    .findById(req.body.id)
    .then((user: any) => {
      db.role
        .find({
          _id: { $in: user.roles },
        })
        .then((roles: any) => {
          for (let i = 0; i < roles.length; i++) {
            if (roles[i].name === "moderator") {
              next();
              return;
            }
          }
          res.status(403).send({ message: "Require Moderator Role" });
        })
        .catch((err: any) => {
          console.error("error", err);
          res.status(500).send({ message: err });
        });
    })
    .catch((err: any) => {
      console.log("error: ", err);
      res.status(500).send({ message: err });
    });
};

export default { verifyToken, isAdmin, isModerator };
