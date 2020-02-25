import Vue from 'vue';
import {getValueArrayArrays} from '../includes/functions';

Vue.component('location-switcher', {
  template:
    `
      <span>{{ country_label }}</span>
 `,
  props: ['countries'],
  data() {
    const current_country = window.$cookies.get('customer-country');
    const countriesOptions = JSON.parse(this.countries);

    return {
      country_label: current_country ? getValueArrayArrays(countriesOptions, current_country, 'code','name') : null,
    };
  },
  methods: {},
});
