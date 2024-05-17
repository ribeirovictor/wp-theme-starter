const toggleMenu = (buttonTarget, menuTarget) => {
  const target = document.querySelector(menuTarget);
  target.classList.toggle("active");
};

const menuButton = [
  ...document.querySelectorAll(".mobile-menu--toggle"),
  ...document.querySelectorAll(".mobile-menu__backdrop"),
];
menuButton.forEach((button) =>
  button.addEventListener("click", (e) =>
    toggleMenu(e.target.classList, ".mobile-menu")
  )
);
