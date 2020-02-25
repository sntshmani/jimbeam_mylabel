import Vue from 'vue';
import {closeTabsStep3} from "../includes/functions";

Vue.directive('accordion', {
  bind: function(el, binding, vnode) {
    jQuery(document).ready(function() {
      jQuery(jQuery('.accordion-panel')[0]).slideToggle();
      jQuery('.step-3__dropdown').on('click', function(e) {
        closeTabsStep3();
        jQuery(event.currentTarget.children[1]).slideToggle();
        jQuery(event.currentTarget).addClass('open');

        // Go to top in last tab
        const element_id = event.currentTarget.id;
        if (element_id === 'step-3__dropdown-content-permission') {
          $('html, body').animate({
            scrollTop: $(".accordion").offset().top
          }, 1000);
        }

      });

      jQuery('.accordion-panel').on('click', function(e) {
        e.stopPropagation();
      });
    });
  },
});
