export default {
  name: 'cityAutocomplete',
  template:
    `
        <input type="text" name="city" :placeholder="placeholder" :data-country="defaultCountry" v-on:keyup="autocompleteCity($event)" required/>
 `,
props: ['placeholder', 'defaultCountry'],
  methods: {
    autocompleteCity(e) {
      const name = e.currentTarget.name;
      jQuery('input[name="' + name + '"]').cityAutocomplete();
    },
  },
}


