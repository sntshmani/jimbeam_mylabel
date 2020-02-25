import {getKeyByValue} from "../includes/functions";

export default {
  name: 'phoneSelect',
  template:
    `
      <div class="Select">
        <div class="Select__desktop">
          <div class="desktop-select__value">{{initValue}}</div>
          <div class="Select__desktop__dropdown" v-bind:class="{open: showDropdown}">
            <div class="Select__option" v-for="value, country in options" @click="initValue = getValue(value, country); showDropdown = false; handleChange(value);"
             v-bind:class="{active: value === phoneValue}">
              {{ value }} ({{ country }})
            </div>
          </div>
        </div>
        <select class="Select__native" @change="onChange($event)">
          <option v-for="value, country in options" :value="value">{{ value }} ({{ country}})</option>         
        </select>
      </div>
 `,
props: ['defaultValue', 'selectOptions', 'handleChange'],
  data() {
    let selectOptions = JSON.parse(this.selectOptions);
    let phoneCode = this.$parent.form.phone_code !== null ? this.$parent.form.phone_code : this.defaultValue;
    let country = getKeyByValue(selectOptions, phoneCode);

    return {
      phoneValue: phoneCode,
      initValue: phoneCode !== '' ? phoneCode  + ' (' + country + ')' : '- Choose -',
      options: selectOptions,
      showDropdown: false,
    };
  },
  methods: {
    onChange(e) {
      this.handleChange(e.target.value);
    },
    getValue(value, country) {
      return value + ' (' + country + ')';
    }
  },
}


