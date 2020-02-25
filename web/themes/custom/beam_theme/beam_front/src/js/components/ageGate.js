import Vue from 'vue';
import VueCookies from 'vue-cookies';

Vue.use(VueCookies);

import { initAgeFormVars } from '../includes/functions';
import axios from "axios";

Vue.component('age-gate', {
  props: ['webDomain'],
  data() {
    return {
      form: initAgeFormVars(),
      dayTouched: false,
      monthTouched: false,
      yearTouched: false,
      countryLabel: 'Select country',
      urlRedirect: null,
      age: null,
    };
  },
  methods: {
    async submit() {
      if (!this.checkSubmitEnabled()) return;
      const date = new Date(this.form.year, parseInt(this.form.month) - 1, this.form.day);
      this.age = this.getAge(date);

      const countryCode = this.form.country;

      if (this.age < 18) {
        this.setDataLayer(false);
        location.href = 'https://www.responsibility.org/';
      }
      else {
        const remember = this.form.remember;
        const expireTime = remember ? new Date(new Date().setFullYear(new Date().getFullYear() + 1)) : new Date(
          new Date().setDate(new Date().getDate() + 1));

        VueCookies.set('ageGatePassed', true, expireTime, '/', this.webDomain);
        VueCookies.set('customer-country', countryCode, expireTime, '/', this.webDomain);

        this.setDataLayer(true);
        location.href = this.urlRedirect;
      }
    },

    setDataLayer(ageGatePassed) {
      window.dataLayer.push({
          'event' : 'e_ageGate',
          'ageGatePass': ageGatePassed,
          'ageGateAge': this.age,
          'ageGateYear': this.form.year
        }
      );
    },

    checkSubmitEnabled() {
      return this.form && this.form.year && this.form.month && this.form.day && this.form.country;
    },

    getAge(birthDate) {
      const today = new Date();
      let age = today.getFullYear() - birthDate.getFullYear();
      const m = today.getMonth() - birthDate.getMonth();
      if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
      }
      return age;
    },

    async getCountryCode() {
      // Not in use. Now by selector
      let country = null;
      await axios.get('https://ipapi.co/json/', {
      }).then(response => {
        country = response.data.country;
      }).catch(function(error) {
        console.error('Error: ', error);
      });

      return country;
    },

    onChangeInputHandler() {
      if (this.form.day) this.dayTouched = true;
      if (this.form.month) this.monthTouched = true;
      if (this.form.year) this.yearTouched = true;
    },
    clickCountry(code, country, url) {
      this.form.country = code;
      this.countryLabel = country;
      this.urlRedirect = url;
    }
  },
});
