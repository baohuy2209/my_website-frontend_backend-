import mongoose, { Schema, Document } from "mongoose";
export interface IStudent extends Document {
  username: string;
  email: string;
  phone: string;
  role: string;
  avatar: string;
  status: string;
  refresh_token: string;
}
const StudentSchema: Schema = new Schema<IStudent>(
  {
    username: {
      type: String,
      unique: true,
      index: true,
    },
    email: {
      type: String,
      unique: true,
    },
    phone: {
      type: String,
      maxlength: 10,
    },
    role: {
      type: String,
    },
    avatar: {
      type: String, // store the link of the image
    },
    status: {
      type: String,
    },
    refresh_token: {
      type: String,
    },
  },
  {
    toJSON: { virtuals: true },
    toObject: { virtuals: true },
    timestamps: true,
  }
);
const model = mongoose.model("Student", StudentSchema);
export default model;
