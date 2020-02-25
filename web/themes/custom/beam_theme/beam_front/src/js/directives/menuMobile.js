import Vue from 'vue';

Vue.directive('menumobile', {
  bind: function(el, binding, vnode) {
    function hideSubmenus() {
      jQuery(el).children('li').each((_, item) => {
        const $item = jQuery(item);
        $item.children('ul').removeClass('show');
      });
    }

    jQuery(document).ready(function() {
      jQuery(el).children('li').each((_, item) => {
        const $item = jQuery(item);
        $item.click(() => {
          hideSubmenus();
          $item.children('ul').toggleClass('show');
        });
      });
    });

  },
});
