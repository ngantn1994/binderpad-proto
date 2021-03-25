<template>
  <div class="create-binder">
    <div class="form-item-box">
      <div class="form-item-label">
        Binder title
      </div>
      <div class="form-item-input form-item-input-single-line" contenteditable="true"
        id="binder-title"></div>
    </div>
    <div class="form-item-box">
      <div class="form-item-label">
        Binder Description
      </div>
      <div class="form-item-input form-item-input-area" id="binder-desc"
        contenteditable="true"></div>
    </div>
    <div class="form-item-box-last">
      <div class="form-submit">Create Binder (does not work for now)</div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CreateBinder',
};
</script>

<style scoped>
.create-binder {
  clear: both;
}
</style>
