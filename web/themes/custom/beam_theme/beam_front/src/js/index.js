import '../sass/app.scss';

import Vue from 'vue';
import VueCookies from 'vue-cookies';
import Toasted from 'vue-toasted';

import { showAgeGate } from './includes/functions';

Vue.use(VueCookies);
Vue.use(Toasted, {duration: 2000, singleton: true, className: 'BeamToast'});

import './directives/popup';
import './directives/menuHover';
import './directives/header';
import './directives/langSelector';
import './directives/locationDialog';
import './directives/menuMobile';
import './directives/accordion';
import './directives/slider';
import './directives/info';

import './components/ageGate';
import './components/locationBox';
import './components/bottleForm';
import './components/bottlePrivateForm';
import './components/select';
import './components/phoneSelect';
import './components/file';

const app = new Vue({
  el: '#beam-front',
  delimiters: ['${', '}$'],
  data: {
    isUserLogin: false,
    showAgeGate: showAgeGate(),
    showLocationDialog: false,
    isMobile: window.innerWidth <= 768,
  },
  mounted() {
    window.addEventListener('resize', this.handleResize);
  },
  beforeDestroy: function() {
    window.removeEventListener('resize', this.handleResize);
  },
  methods: {
    handleResize() {
      this.isMobile = window.innerWidth <= 768;
    },
  },
});
