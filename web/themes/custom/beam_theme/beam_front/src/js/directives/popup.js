import Vue from "vue";

Vue.directive("popup", {
  bind: function(el, binding, vnode) {
    jQuery(document).ready(function() {
      jQuery(el).click(function() {
        jQuery(".block-popup").toggleClass("active");
      });
    });
  }
});
