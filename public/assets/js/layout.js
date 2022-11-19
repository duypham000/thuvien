function removeCookie(cname) {
  const d = new Date();
  d.setTime(d.getTime() - 24 * 60 * 60 * 1000);
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=;" + expires + ";path=/";
}
function logout() {
  removeCookie("username");
  removeCookie("role");
  window.location.href = "/login";
}
