import Vue from 'vue';

Vue.directive('header', {
  bind: function(el, binding, vnode) {
    window.addEventListener('scroll', handleScroll);

    if (window.innerWidth <= 768) {
      jQuery(el).addClass('hamburger');
    }

    function handleScroll() {
      if (window.pageYOffset > 100) jQuery(el).addClass('hamburger');
      else {
        if (window.innerWidth <= 768) return;
        jQuery(el).removeClass('hamburger');
        jQuery(el).removeClass('open');
        jQuery('#nav-icon').removeClass('open');
      }
    }

    jQuery(document).ready(function() {
      jQuery('#nav-icon').click(function() {
        jQuery(this).toggleClass('open');
        jQuery(el).toggleClass('open');
      });
    });
  },
});
