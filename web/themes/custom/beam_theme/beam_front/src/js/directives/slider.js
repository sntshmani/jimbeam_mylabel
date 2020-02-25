import Vue from 'vue';

window.$ = jQuery;

Vue.directive('slider', {
  bind: function(el, binding, vnode) {
    jQuery(document).ready(function() {
      jQuery('.step-1__slider').slick({
        centerMode: true,
        centerPadding: '90px',
        slidesToShow: 1,
        dots: false,
        prevArrow: false,
        nextArrow: false,
      });
    });
  },
});
