<template>
  <div class="public-binder-wrapper">
    <div class="title-box" @click="toggleDescBox()">
      {{binder.title}}
      <ArrowIcon :class="{ 'arrow-icon': true, 'rotate180': isDescOpen }"/>
    </div>
    <div :class="{ 'desc-box': true, 'hidden-item': !isDescOpen }"
      v-html="binder.desc"></div>
  </div>
</template>

<script>
import ArrowIcon from '../assets/icons/icon_arrow01.svg';

export default {
  name: 'PublicBinder',
  components: {
    ArrowIcon,
  },
  props: {
    binder: {
      type: Object,
      required: true,
      validator(value) {
        return 'title' in value && 'desc' in value;
      },
    },
  },
  methods: {
    toggleDescBox() {
      this.isDescOpen = !this.isDescOpen;
    },
  },
  data() {
    return {
      isDescOpen: false,
    };
  },
};
</script>

<style scoped>
.public-binder-wrapper {
  width: 100%;
  background-color: #FFF;
  box-shadow: 0px 2px 1px -1px rgb(0 0 0 / 20%), 0px 1px 1px 0px rgb(0 0 0 / 14%),
    0px 1px 3px 0px rgb(0 0 0 / 12%);
  box-sizing: border-box;
  position: relative;
}
.title-box {
  height: 30px;
  line-height: 30px;
  text-align: left;
  width: calc(100% - 30px);
  padding: 10px;
  padding-left: 20px;
  font-weight: bold;
  cursor: pointer;
}
.desc-box {
  border-top: 1px solid #b3b3b3;
  padding: 10px;
  padding-left: 20px;
  width: 100%;
  box-sizing: border-box;
  text-align: left;
}
.arrow-icon {
  width: 15px;
  height: auto;
  float: right;
  padding-top: 10px;
  padding-bottom: 10px;
  transition: 200ms all ease-in-out;
}
.rotate180 {
  transform: rotate(180deg);
  filter: brightness(0);
}
.hidden-item {
  display: none;
}
</style>
