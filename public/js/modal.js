"use strict";

const loginmodal = $(".loginmodal");
const btnloginmodal = $("#loginbutton");
const registeremodal = $(".registermodal");
const btnregistermodal = $("#registerbutton");
const overlay = $(".overlay");

const openModalLogin = function () {
  if (!loginmodal.hasClass("hidden")) {
    loginmodal.addClass("hidden");
    return;
  }
  loginmodal.removeClass("hidden");
  overlay.removeClass("hidden");
  registeremodal.addClass("hidden");
};

const openModalRegister = function () {
  if (!registeremodal.hasClass("hidden")) {
    registeremodal.addClass("hidden");
    return;
  }
  registeremodal.removeClass("hidden");
  overlay.removeClass("hidden");
  loginmodal.addClass("hidden");
};

const closeModal = function () {
  loginmodal.addClass("hidden");
  registeremodal.addClass("hidden");
  overlay.addClass("hidden");
};

btnloginmodal.on("click", openModalLogin);
btnregistermodal.on("click", openModalRegister);

overlay.on("click", closeModal);

//con escape tambien se puede salir del modal a parte de clickando fuera
document.addEventListener("keydown", function (e) {
  if (
    e.key === "Escape" &&
    (!loginmodal.hasClass("hidden") || !registeremodal.hasClass("hidden"))
  ) {
    closeModal();
  }
});
