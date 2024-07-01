import mongoose from "mongoose";
export interface IRole extends mongoose.Document {
  name: string;
}
const role = mongoose.model(
  "Role",
  new mongoose.Schema<IRole>({
    name: String,
  })
);
export default role;
