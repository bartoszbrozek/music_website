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
          <form-basic :settings="settings" v-if="settings.form"></form-basic>

          <div v-if="settings.contentData">
            <div v-for="(value, propertyName) in settings.contentData" v-bind:key="propertyName" class="row">
              <div class="col-sm-12">
                <h4 v-html="propertyName"></h4>
              </div>
              <div class="col-sm-12">
                <p v-html="value"></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import FormBasic from "./../Forms/BasicForm";

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