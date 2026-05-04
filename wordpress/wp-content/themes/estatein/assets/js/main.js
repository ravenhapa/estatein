(function () {
  const menuToggle = document.querySelector(".menu-toggle");
  const navigation = document.querySelector("#primary-navigation");
  const announcement = document.querySelector("[data-announcement]");
  const announcementClose = document.querySelector("[data-announcement-close]");

  if (announcement && announcementClose) {
    announcementClose.addEventListener("click", function () {
      announcement.classList.add("is-hidden");
    });
  }

  if (!menuToggle || !navigation) {
    return;
  }

  menuToggle.addEventListener("click", function () {
    const expanded = menuToggle.getAttribute("aria-expanded") === "true";

    menuToggle.setAttribute("aria-expanded", String(!expanded));
    navigation.classList.toggle("is-open", !expanded);
  });

  document.addEventListener("keydown", function (event) {
    if (event.key !== "Escape") {
      return;
    }

    menuToggle.setAttribute("aria-expanded", "false");
    navigation.classList.remove("is-open");
  });
})();
