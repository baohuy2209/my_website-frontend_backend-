// Định nghĩa interface chứa tất cả các miền dữ liệu thu nhập từ người dùng
interface IUser {
  fullName: string; // Họ và tên đầy đủ
  age: number; // Số tuổi
  email: string; // email của khách hàng
  gender: string; // giới tính
  phoneNumber: string; // số điện thoại
  dob: Date; // ngày tháng năm sinh
  dataFaceId: string; // dữ liệu được mã hóa thành chuỗi kí tự từ dữ liệu xác thực khuôn mặt
  dataFingerId: string; // dữ liệu được mã hóa thành chuỗi kí tự từ dữ liệu xác thực vân tay
  isGenesis: boolean; // trường dữ liệu xác định người dùng đầu tiên
  history_transaction: string[]; // trường dữ liệu lưu trữ lịch sử giao dịch của khách hàng
}
export default IUser;
