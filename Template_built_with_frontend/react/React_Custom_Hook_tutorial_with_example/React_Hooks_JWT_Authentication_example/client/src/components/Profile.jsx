import AuthService from "../services/auth.service";
function Profile() {
  const currentUser = AuthService.getCurrentUser();
  return (
    <div className="container">
      <div className="jumbotron">
        <header>
          <h3>
            <strong>{currentUser.username}</strong> Profile
          </h3>
        </header>
      </div>
    </div>
  );
}
export default Profile;
