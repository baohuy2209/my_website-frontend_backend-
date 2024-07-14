import { Request, Response } from "express";
function welcome(req: Request, res: Response): Response {
  return res.json({ message: "Welcome to my application" });
}

export default welcome;
