<template>
  <div class="public-binder-wrapper">
    {{binder.title}}
  </div>
</template>

<script>
export default {
  name: 'PublicBinder',
  props: {
    binder: {
      type: Object,
      required: true,
      validator(value) {
        return 'title' in value && 'desc' in value;
      },
    },
  },
};
</script>

<style scoped>
.public-binder-wrapper {
  width: 100%;
  padding: 10px;
  background-color: #FFF;
  box-shadow: 0px 2px 1px -1px rgb(0 0 0 / 20%), 0px 1px 1px 0px rgb(0 0 0 / 14%),
    0px 1px 3px 0px rgb(0 0 0 / 12%);
  box-sizing: border-box;
  position: relative;
}
</style>
