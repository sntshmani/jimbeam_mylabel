import Vue from 'vue';
import {
  initPrivateFormVars,
  validateStep,
  submit,
  bottleProperties,
  checkStep2,
  initBottleVars, nextStepBottle, submitBottleForm
} from '../includes/bottleFunctions';

import axios from 'axios';
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate);

import stepLabel from './stepLabel';
import customSelect from './select';
import customFile from './file';

import { required, email } from 'vuelidate/lib/validators'

Vue.component('bottle-private-form', {
  props: ['url', 'fileUrl', 'drawUrl', 'labelUrl', 'prohibitedUrl',
    'showPictureLabel', 'errorMsgStep1', 'errorMsgStep2', 'errorMsgProhibited', 'fixedImages'],
  components: {
    'step-label': stepLabel,
    'custom-select': customSelect,
    'custom-file': customFile,
  },
  data() {
    return {
      showStep: 1,
      form: initPrivateFormVars(),
      vars: initBottleVars(),
      image_picture_url: null,
      image_bottle_lateral_url: null,
      bottleProperties: bottleProperties,
      errorMsg: null,
      isMobile: window.innerWidth <= 768,
      fixedImagesObject: JSON.parse(this.fixedImages),
    };
  },
  validations: {
    form: {
      email: {required, email},
    },
  },
  mounted() {
    const that = this;
    jQuery('.step-1__slider').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
      that.form.bottle = nextSlide;
    });
    window.addEventListener('resize', this.handleResize);
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.handleResize);
  },
  methods: {
    handleResize() {
      this.isMobile = window.innerWidth <= 768;
    },
    async nextStep(e) {
      e.preventDefault();
      this.errorMsg = await validateStep(this.form, this.showStep, this);
      if (!this.errorMsg) {
        nextStepBottle(this);
      }
      else {
        this.$toasted.show(this.errorMsg);
      }
    },
    previousStep() {
      this.errorMsg = null;
      this.showStep--;
      this.$emit('changeLabel', this.showStep);
    },
    clickBottle(bottle_key, bottle_object) {
      this.form.bottle = bottle_key;
      this.bottleProperties.title = bottle_object.title;
      this.bottleProperties.imgBottle = bottle_object.bottle;
    },

    async uploadDraw(file) {
      this.$emit('changeImageUrl', null);
      let imageType = typeof file;

      // Only call API when new image is uploaded
      if (imageType === 'object') {
        let formData = new FormData();
        formData.append('file', file);

        await axios.post(this.drawUrl, formData).then(response => {
          this.form.image_picture = response.data.file;
          this.image_picture_url = response.data.file_url;
          this.$emit('changeImageUrl', this.image_picture_url);
        }).catch(function(error) {
          console.error('Error: ', error);
        });
      }
    },

    uploadImage(file) {
      let imageType = typeof this.form.image_picture;

      // Only call API when new image is uploaded
      if (imageType === 'object') {
        let formData = new FormData();
        formData.append('file', file);

        axios.post(this.fileUrl, formData).then(response => {
          this.form.image_picture = response.data.file;
          this.image_picture_url = response.data.file_url;
        }).catch(function(error) {
          console.error('Error: ', error);
        });
      }
    },

    submitForm() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      } else {
        submitBottleForm(this);
      }
    },

    checkStep2Completed() {
      return checkStep2(this.form);
    },
  },
});
