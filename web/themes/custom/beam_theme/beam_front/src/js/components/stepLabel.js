export default {
  name: 'stepLabel',
  props: ['step1', 'step2', 'step3'],
  template: '<span class="Custom-bottle__title">{{stepLabel}}</span>',
  data() {
    return {
      stepLabel: this.step1
    }
  },
  methods: {
    setLabel: function (id) {
      if (id === 2) this.stepLabel = this.step2;
      else if (id === 3) this.stepLabel = this.step3;
    }
  },
  created: function () {
    this.$parent.$on('changeLabel', this.setLabel);
  },
}
