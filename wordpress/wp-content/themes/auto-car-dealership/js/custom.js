

// Scroll to Top
window.onscroll = function() {
  const auto_car_dealership_button = document.querySelector('.scroll-top-box');
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    auto_car_dealership_button.style.display = "block";
  } else {
    auto_car_dealership_button.style.display = "none";
  }
};

document.querySelector('.scroll-top-box a').onclick = function(event) {
  event.preventDefault();
  window.scrollTo({top: 0, behavior: 'smooth'});
};

