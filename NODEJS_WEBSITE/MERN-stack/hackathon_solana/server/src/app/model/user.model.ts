import mongoose, { Schema, Document } from "mongoose";
export interface IUser extends Document {
  id: string;
  username: string;
  password: string;
  slug: string;
  email: string;
  phone: string;
  roles: [];
  tutorials: Object;
}
const UserSchema: Schema = new Schema<IUser>(
  {
    username: {
      type: String,
      unique: true,
      index: true,
    },
    password: {
      type: String,
    },
    slug: {
      type: String,
      unique: true,
    },
    email: {
      type: String,
      unique: true,
    },
    phone: {
      type: String,
      unique: true,
    },
    roles: [
      {
        type: mongoose.Schema.Types.ObjectId,
        ref: "Role",
      },
    ],
    tutorials: {
      type: mongoose.Schema.Types.ObjectId,
      ref: "Tutorial",
    },
  },
  {
    toJSON: { virtuals: true },
    toObject: { virtuals: true },
    timestamps: true,
  }
);
const model = mongoose.model("User", UserSchema);
export default model;
