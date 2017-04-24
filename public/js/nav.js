$(function() {
  $('.sub-nav').hide();
  $('.items.special').on('click' , function() {
    $('.sub-nav').slideToggle(1000);
  });
});
