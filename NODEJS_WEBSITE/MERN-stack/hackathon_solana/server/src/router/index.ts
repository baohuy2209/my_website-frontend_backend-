import AuthRouter from "./child_route/auth.routes";
import UserRouter from "./child_route/user.routes";
function route(app: any) {
  app.use("/api/v1/auth", AuthRouter);
  app.use("/api/v1/user", UserRouter);
}
export default route;
