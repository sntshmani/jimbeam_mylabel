import { Spinner } from 'spin.js';

export default {
  name: 'customFile',
  template:
    `
      <div class="File" @click="handleClick" v-bind:class="{'with-image': currentImage}">
          <div class="File__icon"></div>
          <div class="File__picture" v-if="currentImage">
            <img :src="currentImage" alt="" />
          </div>
          <div class="File__placeholder" v-if="!currentImage">{{ placeholder }}</div>
          <input type="file" class="File__file" name="image_picture" accept="image/png, image/jpeg" data-max-size="1048576"
                 required @change="uploadImage($event)" hidden ref="fileInput"/>
        </div>
      </div>
 `,
  props: ['handleChange', 'placeholder', 'errorMsgFile'],
  data() {
    return {
      currentImage: this.$parent.image_picture_url,
      spinner: new Spinner({}),
      errorMsg : this.errorMsgFile,
    };
  },
  methods: {
    onChange(e) {
      this.handleChange(e.target.value);
    },
    showLoader() {
      document.getElementsByClassName('File')[0].style.visibility = 'hidden';
      const target = document.getElementsByClassName('step-2__wrapper-file')[0];
      this.spinner.spin(target);
    },
    hideLoader() {
      this.spinner.stop();
      document.getElementsByClassName('File')[0].style.visibility = 'visible';
    },

    allowedImageSize(image) {
      const image_picture = document.getElementsByName('image_picture');
      const max_size = image_picture[0].getAttribute('data-max-size');
      const image_size = image.size;
      return max_size >= image_size;
    },

    async uploadImage() {
      const image = event.target.files[0];
      const allowed_size = this.allowedImageSize(image);
      if (!allowed_size) {
        // Show msg;
        this.$toasted.show(this.errorMsg);
        return;
      }

      this.showLoader();
      await this.$parent.uploadDraw(image);
      this.hideLoader();
    },
    changeImageUrl(image_url) {
      this.currentImage = image_url;
    },
    handleClick() {
      this.$refs['fileInput'].click();
    },
  },
  created: function() {
    this.$parent.$on('changeImageUrl', this.changeImageUrl);
  },
};
