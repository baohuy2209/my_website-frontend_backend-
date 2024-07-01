import user from "./user.model";
import role from "./role.model";
import student from "./student.model";
const db = {
  role: role,
  user: user,
  student: student,
  ROLES: ["user", "admin", "moderator"],
};
export default db;
