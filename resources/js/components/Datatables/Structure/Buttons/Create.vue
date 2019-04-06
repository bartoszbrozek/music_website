<template>
  <div class="col-sm-4">
    <button
      class="btn btn-success float-right"
      data-toggle="modal"
      v-bind:data-target="'#' + settings.id"
    >
      <i class="fa fa-plus"></i> Create
    </button>
  </div>
</template>

<script>
export default {
  props: {
    settings: {
      type: Object,
      required: true
    }
  }
};
</script>