import Vue from 'vue';

Vue.directive('langselector', {
  bind: function(el, binding, vnode) {
    jQuery(document).ready(function() {
      jQuery(el).click(function() {
        jQuery(el).toggleClass('open');
      });
    });
  },
});
