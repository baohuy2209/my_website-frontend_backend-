document.addEventListener("DOMContentLoaded", function () {
  var employeeId;
  var id;
  var deleteForm = document.forms["delete-employee-form"];
  var btnDeleteCourse = document.getElementById("btn-delete-employee");
  var deleteModal = document.getElementById("delete-employee-modal");
  deleteModal.addEventListener("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    employeeId = button.data("bs-id");
    id = employeeId;
    console.log(employeeId);
  });
  btnDeleteCourse.onClick = function () {
    deleteForm.action = "/api/employee/" + id + "?_method=DELETE";
    deleteForm.submit();
  };
});
