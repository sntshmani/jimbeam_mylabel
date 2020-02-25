import Vue from "vue";

Vue.directive("info", {
  bind: function(el, binding, vnode) {
    jQuery(document).ready(function() {
      jQuery(el).hover(function() {
        jQuery(".info-block").toggleClass("active");
      });
    });
  }
});
