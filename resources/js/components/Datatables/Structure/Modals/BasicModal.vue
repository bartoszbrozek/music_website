<template>
  <div class="modal" tabindex="-1" role="dialog" v-bind:id="settings.id">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" v-html="settings.title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p v-if="settings.contentText" v-html="settings.contentText"></p>
          <form-basic :settings="settings"></form-basic>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import FormBasic from "./../Forms/BasicForm"

export default {
    components: {
        FormBasic
    },
  props: {
    settings: {
      type: Object,
      required: true
    }
  }
};
</script>