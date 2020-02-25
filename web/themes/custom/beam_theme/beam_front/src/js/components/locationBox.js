import Vue from 'vue';
import VueCookies from "vue-cookies";
Vue.use(VueCookies);

Vue.component('locationBox', {
  props: ['webDomain'],
  methods: {
    clickCountry(code, url) {
      const checked = VueCookies.get('ageGatePassed');
      if (checked) {
        const expireTime = new Date(new Date().setFullYear(new Date().getFullYear() + 1));

        VueCookies.set('customer-country', code, expireTime, '/', this.webDomain);
      }
      location.href = url;
    },
  },
});
