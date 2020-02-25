function showAgeGate() {
  const isLogin = window.isLogin;
  const checked = window.$cookies.get('ageGatePassed');

  if (checked) jQuery('body').removeClass('no-scroll');
  else jQuery('body').addClass('no-scroll');

  return !checked && !isLogin;
}

function initAgeFormVars() {
  return {
    year: null,
    month: null,
    day: null,
    remember: false,
    country: null,
  };
}

function getKeyByValue(object, value) {
  return Object.keys(object).find(key => object[key] === value);
}

function getValueArrayArrays(object, value, propertySearch, propertyReturn) {
  let key_value = '';
  jQuery.each( object, function( key, val ) {
    if (val[propertySearch] === value) key_value = val[propertyReturn];
  });

  return key_value;
}

function closeTabsStep3() {
  jQuery('.accordion-panel').each((index, item) => {
    jQuery(item).slideUp();
  });
  jQuery('.step-3__dropdown').each((index, item) => {
    jQuery(item).removeClass('open');
  });
}

export { initAgeFormVars, getKeyByValue, showAgeGate, getValueArrayArrays, closeTabsStep3 };
