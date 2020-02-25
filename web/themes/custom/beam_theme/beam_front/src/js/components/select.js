export default {
  name: 'customSelect',
  template:
    `
      <div class="Select">
        <div class="Select__desktop">
          <div class="desktop-select__value" @click="showDropdown = !showDropdown">{{currentValue}}</div>
          <div class="Select__desktop__dropdown" v-bind:class="{open: showDropdown}">
            <div class="Select__option" v-for="item in options" @click="currentValue = item.value; showDropdown = false; handleChange(item.key); changeValue(item.value)"
             v-bind:class="{active: item.key === currentKey}">
              {{ item.value }}
            </div>
          </div>
        </div>
        <select class="Select__native" @change="onChange($event)">
          <option value="" selected disabled>{{defaultValue}}</option>      
          <option v-for="item in options" :value="item.key">{{ item.value }}</option>
        </select>
      </div>
 `,
  props: ['defaultValue', 'selectOptions', 'handleChange'],
  data() {
    let imageSubhead = this.$parent.form.image_subhead;
    let imageSubheadValue = this.$parent.form.image_subhead_value;
    return {
      currentKey: imageSubhead,
      currentValue: imageSubhead !== null ? imageSubheadValue : this.defaultValue,
      options: JSON.parse(this.selectOptions),
      showDropdown: false,
    };
  },
  methods: {
    changeValue(value) {
      const key_value = this.findKey(this.options, value);

      this.$parent.form.image_subhead_value = value;
      this.$parent.vars.image_subhead_step3 = key_value === 'blank' ? '' : value;
    },

    onChange(e) {
      this.handleChange(e.target.value);
    },

    findKey(object, value) {
      let key_value = '';
      jQuery.each( object, function( key, val ) {
        if (val.value === value) key_value = val.key;
      });
      return key_value;
    },
  },
}
