document.addEventListener("DOMContentLoaded", function () {
  var employeeId;
  var deleteForm = document.forms["delete-employee-form"];
  var btnDeleteCourse = document.getElementById("btn-delete-employee");
  $("#delete-employee-modal").addEventListener(
    "show.bs.modal",
    function (event) {
      var button = $(event.relatedTarget);
      employeeId = button.data("id");
    }
  );
  btnDeleteCourse.onclick = function () {
    deleteForm.action = "/api.employees/" + employeeId + "?_method=DELETE";
    deleteForm.submit();
  };
});
