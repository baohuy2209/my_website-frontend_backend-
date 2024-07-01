import express from "express";
class Auth {
  async register(req: express.Request, res: express.Response) {
    try {
    } catch (error) {}
  }
  async login(
    req: express.Request,
    res: express.Response,
    next: express.NextFunction
  ) {
    try {
    } catch (error) {}
  }
  async logout(req: express.Request, res: express.Response) {
    try {
    } catch (error) {}
  }
  async fetchProfile(req: express.Request, res: express.Response) {
    try {
    } catch (error) {}
  }
  async refresh(req: express.Request, res: express.Response) {}
  test(req: express.Request, res: express.Response) {
    return res.json("test");
  }
}
export default new Auth();
