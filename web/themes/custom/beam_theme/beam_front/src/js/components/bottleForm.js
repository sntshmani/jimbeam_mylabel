import Vue from 'vue';
import _ from 'lodash';
import {
  bottleProperties,
  validateStep,
  initBottleVars,
  initFormVars,
  submit, checkStep2, nextStepBottle, openTabPersonalDetails, submitBottleForm
} from '../includes/bottleFunctions';

import axios from 'axios';
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate);

import stepLabel from './stepLabel';
import customSelect from './select';
import phoneSelect from './phoneSelect';
import customFile from './file';


import { required, sameAs, email } from 'vuelidate/lib/validators'

Vue.component('bottle-form', {
  props: ['url', 'validateUrl', 'fileUrl', 'drawUrl', 'defaultPhoneCode', 'labelUrl', 'prohibitedUrl', 'showPictureLabel',
    'errorMsgStep1', 'errorMsgStep2', 'errorMsgProhibited', 'fixedImages', 'defaultCountry'],
  components: {
    'step-label': stepLabel,
    'custom-select': customSelect,
    'phone-select': phoneSelect,
    'custom-file': customFile,
  },
  data() {
    return {
      showStep: 1,
      form: initFormVars(this.defaultPhoneCode),
      vars: initBottleVars(),
      image_picture_url: null,
      image_bottle_lateral_url: null,
      availableCoupon: false,
      showMsgAvailableCoupon: false,
      showMsgTermsPrivacy: false,
      showMsgOffersJimbeam: false,
      showMsgOffersBeamsuntory: false,
      bottleProperties: bottleProperties,
      errorMsg: null,
      step3CouponValid: false,
      isMobile: window.innerWidth <= 768,
      clickSubmit: false,
      fixedImagesObject: JSON.parse(this.fixedImages),
    };
  },
  validations: {
    form: {
      name: {required},
      surname: {required},
      address1: {required},
      city: {required},
      postal_code: {required},
      email: {required, email},
      phone: {required},
      //phone_code: {required},
      terms: {
        sameAs: sameAs( () => true )
      },
      privacy_policy: {
        sameAs: sameAs( () => true )
      },
      offers_jimbeam: {required},
      offers_beamsuntory: {required}
    },
  },
  mounted() {
    const that = this;
    this.isMobile = window.innerWidth <= 768;
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
      this.form.processing_step = true;
      e.preventDefault();
      this.errorMsg = await validateStep(this.form, this.showStep, this);
      if (!this.errorMsg) {
        nextStepBottle(this);
      }
      else {
        this.$toasted.show(this.errorMsg);
        this.form.processing_step = false;
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
      this.validateSubmit();
      this.$v.$touch();

      if (this.$v.$invalid) {
        this.clickSubmit = true;
        return;
      } else {
        submitBottleForm(this);
      }
    },

    validateSubmit() {
      this.showMsgTermsPrivacy = this.step3ValidationTermsPrivacy();

      let open = jQuery("#step-3__dropdown-content-permission" ).hasClass('open');
      open = this.openTabContentPermission(open);
      this.showMsgOffersJimbeam = open ? this.step3ValidationOffersJimbeam() : false;
      this.showMsgOffersBeamsuntory = open ? this.step3ValidationOffersBeamsuntory() : false;
    },

    openTabContentPermission(open) {
      const conditionTerms = this.step3PersonalValidation() && (this.step3ValidationOffersJimbeam() || this.step3ValidationOffersBeamsuntory());
      if (!open && conditionTerms) {
        jQuery('.accordion-panel').each((index, item) => {
          jQuery(item).slideUp();
        });
        jQuery('.step-3__dropdown').each((index, item) => {
          jQuery(item).removeClass('open');
        });
        jQuery("#step-3__dropdown-content-permission .accordion-panel").slideToggle();
        jQuery("#step-3__dropdown-content-permission").addClass('open');
        window.scrollTo(0,0);
        return true;
      }
      else if (open && conditionTerms) return true;
      return false;
    },

    validateCoupon(e) {
      let coupon_code = this.form.coupon_code;
      if (coupon_code) {

        axios.get(this.validateUrl, {
          params: {
            coupon_code: coupon_code,
          },
        }).then(response => {
          let result = response.data.result;
          this.availableCoupon = result;
          this.showMsgAvailableCoupon = !result;
          this.step3CouponValid = !!result;
          if (result) openTabPersonalDetails();
        }).catch(function(error) {
          console.error('Error: ', error);
        });
      }
      else {
        this.availableCoupon = false;
        this.showMsgAvailableCoupon = true;
      }
    },

    validatePostalCode(newPostalCode) {
      // Not in use. Function to get Postal Codes from google
      if (newPostalCode != this.form.postal_code || newPostalCode == ''){
        return;
      }

      let that = this;
      let temp_postal_code = this.form.postal_code;

      var geocoder = new google.maps.Geocoder();
      let postal_code_check = {
        'address': this.defaultCountry,
        componentRestrictions: {
          postalCode: temp_postal_code,
          country: this.defaultCountry
        }
      };
      geocoder.geocode( postal_code_check, function(results, status) {
        if(temp_postal_code == that.form.postal_code) {
          // that.postalCodeValid = status == google.maps.GeocoderStatus.OK;
        }
      });
    },

    checkStep2Completed() {
      return checkStep2(this.form);
    },

    step3PersonalValidation() {
      return (this.form.name &&
        this.form.surname &&
        this.form.address1 &&
        this.form.postal_code &&
        this.form.email &&
        this.form.phone &&
        this.form.phone_code &&
        this.form.city &&
        this.form.terms &&
        this.form.privacy_policy);
    },

    // Validations for checkboxes and radios
    step3ValidationTermsPrivacy() {
      return !this.form.terms || !this.form.privacy_policy;
    },
    step3ValidationOffersJimbeam() {
      return !this.form.offers_jimbeam;
    },
    step3ValidationOffersBeamsuntory() {
      return !this.form.offers_beamsuntory;
    },

    // Validations on checkboxes and radios
    clickTermsPrivacy() {
      this.showMsgTermsPrivacy = this.clickSubmit && this.step3ValidationTermsPrivacy();
    },
    clickOffersJimbeam() {
      this.showMsgOffersJimbeam = this.step3ValidationOffersJimbeam();
    },
    clickOffersBeamsuntory() {
      this.showMsgOffersBeamsuntory = this.step3ValidationOffersBeamsuntory();
    },
    /**
      * When the location found
      * @param {Object} addressData Data of the found location
      * @param {Object} placeResultData PlaceResult object
      * @param {String} id Input container ID
      */
    placeSelected(addressData, placeResultData, id) {
      // Not in use. Function to get Postal Codes from google
      this.$v.form.city.$model = document.getElementById(id).value;
    },
  },
});
