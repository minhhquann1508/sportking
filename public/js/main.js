function showToast(message, status = "success") {
  var toast = $("#toast");
  var toastMess = $("#toast-mesage");
  toast.show();
  toastMess.text(message);
  setTimeout(() => {
    toast.hide();
  }, 1500);
}
