import axios from "axios";

import {checkBlackList, getImageLabel,} from './bottleAPIFunctions';
import {closeTabsStep3} from "./functions";

function bottleProperties() {
  return {
    title: null,
    imgLabel: null,
    imgNormal: null,
    imgLateral: null,
  }
}

async function validateStep(form, step, varThis) {
  let errorMsg = null;
  if (step === 1) {
    let bottle = form.bottle;
    if (!bottle) errorMsg = varThis.errorMsgStep1;
    else {
      const image_result = await getImageLabel(bottle, varThis.labelUrl);
      varThis.vars.image_label_url = image_result.desktop;
      varThis.vars.image_label_responsive_url = image_result.responsive;
      varThis.vars.image_label_responsive_half_url = image_result.responsive_half;
    }
  }
  else if (step === 2) {
    let image_picture = form.image_picture;
    let image_subhead = form.image_subhead;
    let image_label = form.image_label;
    let step2_legal = form.step2_legal;
    if (varThis.showPictureLabel === 1) {
      if (!image_picture || !image_subhead || !image_label || !step2_legal) errorMsg = varThis.errorMsgStep2;
    }
    else {
      if (!image_subhead || !image_label || !step2_legal) errorMsg = varThis.errorMsgStep2;
    }

    if  (!errorMsg) {
      // Check prohibited word if form is completed
      const prohibited = await checkBlackList(form.image_label, varThis.prohibitedUrl);
      if (prohibited) return varThis.errorMsgProhibited;
    }
  }

  return errorMsg;
}

function nextStepBottle(varThis) {
  varThis.showStep++;
  if (varThis.showStep === 3) {
    varThis.image_bottle_lateral_url = imageLateralUrl(varThis.form, varThis.fixedImagesObject);
  }
  varThis.$emit('changeLabel', varThis.showStep);
  varThis.form.processing_step = false;
}

function submitBottleForm(varThis) {
  jQuery('#btn-submit').attr("disabled", true);
  event.preventDefault();
  submit(varThis.form, varThis.url);
}

function submit(form, url) {
  axios.post(url, form).then(response => {
    window.location.href = response.data.url;
  }).catch(function(error) {
    jQuery('#btn-submit').removeAttr("disabled");
    console.error('Error: ', error);
  });
}

function initFormVars(defaultPhoneCode) {
  return {
    bottle: null,
    image_picture: null,
    image_subhead: null,
    image_subhead_value: null,
    image_label: null,
    step2_legal: null,
    coupon_code: null,
    name: null,
    surname: null,
    address1: null,
    address2: null,
    address3: null,
    city: null,
    postal_code: null,
    email: null,
    phone: null,
    phone_code: defaultPhoneCode,
    terms: false,
    privacy_policy: false,
    offers_jimbeam: '',
    offers_beamsuntory: '',
    processing_step: false
  };
}

function initPrivateFormVars() {
  return {
    bottle: null,
    image_picture: null,
    image_subhead: null,
    image_subhead_value: null,
    image_label: null,
    email: null,
  };
}

function initBottleVars() {
  return {
    image_label_url: null,
    image_label_responsive_url: null,
    image_label_responsive_half_url: null,
    image_subhead_step3: null
  }
}

function checkStep2(form) {
  return (form.image_picture &&
    form.image_subhead &&
    form.image_label && form.step2_legal);
}

function imageLateralUrl(form, fixedImagesObject) {
  const imageLabel = form.image_picture ? '' : '_without_picture';
  const varBottle = 'bottle_step3_lateral_' + form.bottle + imageLabel;

  return fixedImagesObject[varBottle];
}

function openTabPersonalDetails() {
  closeTabsStep3();

  jQuery("#step-3__dropdown-personal-details .accordion-panel").slideToggle();
  jQuery("#step-3__dropdown-personal-details").addClass('open');
}

export { bottleProperties, validateStep, submit, submitBottleForm, initFormVars, initPrivateFormVars, initBottleVars, checkStep2, imageLateralUrl, nextStepBottle, openTabPersonalDetails };
