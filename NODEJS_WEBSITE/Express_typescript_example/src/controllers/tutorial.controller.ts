import { Request, Response } from "express";
export default class TutorialController {
  async create(req: Request, res: Response) {
    try {
      res.status(201).json({
        message: "create OK",
        reqBody: req.body,
      });
    } catch (err) {
      res.status(500).json({
        message: "Internal Server Error!",
      });
    }
  }
  async findAll(req: Request, res: Response) {
    try {
      res.status(200).json({
        message: "findAll OK",
        reqBody: req.body,
      });
    } catch (error) {
      res.status(500).json({
        message: "Internal Server Error",
      });
    }
  }
  async findOne(req: Request, res: Response) {
    try {
      res.status(200).json({
        message: "findOne OK",
        reqBody: req.body,
      });
    } catch (error) {
      res.status(500).json({
        message: "Internal Server Error",
      });
    }
  }
  async update(req: Request, res: Response) {
    try {
      res.status(200).json({
        message: "findAll OK",
        reqBody: req.body,
      });
    } catch (err) {
      res.status(500).json({
        message: "Internal Server Error !",
      });
    }
  }
  async delete(req: Request, res: Response) {
    try {
      res.status(200).json({
        message: "delete OK",
        reqBody: req.body,
      });
    } catch (error) {
      res.status(500).json({
        message: "Internal Server Error !",
      });
    }
  }
}
