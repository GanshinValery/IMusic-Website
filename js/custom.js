
  $(function () {

    // MENU
    $('.navbar-collapse a').on('click',function(){
      $(".navbar-collapse").collapse('hide');
    });

    // AOS ANIMATION
    AOS.init({
      disable: 'mobile',
      duration: 800,
      anchorPlacement: 'center-bottom'
    });


    // SMOOTHSCROLL NAVBAR
    $(function() {
      $('.navbar a, .hero-text a').on('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 49
        }, 1000);
        event.preventDefault();
      });
    });    
  });

// MODAL AUTH
// Get the modal element and its background
var modal = document.getElementById('modal');
var background = document.getElementById('modal-background');

// Add a click event listener to the 'open-modal' element
document.getElementById('open-modal').addEventListener('click', function() {
  // Display the modal when the 'open-modal' element is clicked
  modal.style.display = 'block';
  background.style.display = 'block'; // Also display the background
});

// Add a click event listener to the close button and the modal background
document.getElementsByClassName('close')[0].addEventListener('click', function() {
  modal.style.display = 'none';
  background.style.display = 'none'; // Hide the background too
});

background.addEventListener('click', function(event) {
  // Check if the clicked element is the modal background
  if (event.target == background) {
    modal.style.display = 'none';
    background.style.display = 'none'; // Hide the background too
  }
});

// Add a click event listener to the window
window.addEventListener('click', function(event) {
  // Check if the clicked element is the modal or its background
  if (event.target == modal || event.target == background) {
    modal.style.display = 'none';
    background.style.display = 'none'; // Hide the background too
  }
});

    

