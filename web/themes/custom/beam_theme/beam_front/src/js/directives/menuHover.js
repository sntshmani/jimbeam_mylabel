import Vue from 'vue';

Vue.directive('menuhover', {
  bind: function(el, binding, vnode) {
    window.addEventListener('mousemove', handleMouseMove);

    function hideSubmenus() {
      jQuery(el).children('li').each((_, item) => {
        const $item = jQuery(item);
        $item.children('ul').removeClass('show');
      });
    }

    function handleMouseMove(e) {
      if (e.screenY > 230) hideSubmenus();
    }

    jQuery(document).ready(function() {
      jQuery(el).children('li').each((_, item) => {
        const $item = jQuery(item);
        $item.hover(() => {
          hideSubmenus();
          $item.children('ul').addClass('show');
        });
      });
    });

  },
});
