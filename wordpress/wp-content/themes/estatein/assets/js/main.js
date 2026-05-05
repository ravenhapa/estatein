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

  const propertySliders = document.querySelectorAll("[data-property-slider]");

  propertySliders.forEach(function (slider) {
    const track = slider.querySelector("[data-property-slider-track]");
    const prevButton = slider.querySelector("[data-property-slider-prev]");
    const nextButton = slider.querySelector("[data-property-slider-next]");
    const current = slider.querySelector("[data-property-slider-current]");
    const total = slider.querySelector("[data-property-slider-total]");

    if (!track || !prevButton || !nextButton || !current || !total) {
      return;
    }

    const slides = Array.from(track.children);
    let index = 0;

    function visibleSlides() {
      if (window.innerWidth <= 640) {
        return 1;
      }

      if (window.innerWidth <= 1120) {
        return 2;
      }

      return 3;
    }

    function maxIndex() {
      return Math.max(0, slides.length - visibleSlides());
    }

    function slideWidth() {
      if (!slides.length) {
        return 0;
      }

      const gap = parseFloat(window.getComputedStyle(track).columnGap || window.getComputedStyle(track).gap || "0");
      return slides[0].getBoundingClientRect().width + gap;
    }

    function formatCount(value) {
      return String(value).padStart(2, "0");
    }

    function update() {
      const width = slideWidth();
      track.style.transform = "translateX(-" + index * width + "px)";
      current.textContent = formatCount(index + 1);
      total.textContent = formatCount(slides.length);
      prevButton.disabled = index <= 0;
      nextButton.disabled = index >= maxIndex();
    }

    prevButton.addEventListener("click", function () {
      index = Math.max(0, index - 1);
      update();
    });

    nextButton.addEventListener("click", function () {
      index = Math.min(maxIndex(), index + 1);
      update();
    });

    window.addEventListener("resize", function () {
      index = Math.min(index, maxIndex());
      update();
    });

    update();
  });

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
