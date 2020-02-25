import Vue from 'vue';

function toggleLocation(classToggle) {
  jQuery(classToggle).toggleClass('is-active');
}

Vue.directive('locationopen', {
  bind: function(el, binding, vnode) {
    jQuery(document).ready(function() {
      jQuery(el).click(function() {
        toggleLocation('.location-box-container');
      });
    });
  },
});

Vue.directive('locationclose', {
  bind: function(el, binding, vnode) {
    jQuery(document).ready(function() {
      jQuery(el).click(function() {
        toggleLocation('.location-box-container');
      });
    });
  },
});
