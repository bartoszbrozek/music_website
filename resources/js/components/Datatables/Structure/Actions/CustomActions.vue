<template>
  <div class="custom-actions">
    <div v-for="action in this.customActions" v-bind:key="action.id">
      <button
        @click="itemAction(action, rowData)"
        :class="action.btnClass"
        data-toggle="modal"
        v-bind:data-target="'#' + action.id"
      >
        <i :class="action.iconClass"></i>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    rowData: {
      type: Object,
      required: true
    },
    rowIndex: {
      type: Number
    },
    model: {
      type: String,
      required: false
    },
    customActions: {
      type: Array,
      required: false
    },
  },
  methods: {
    itemAction(Action, data) {
      Action.action(data.rowData.id, Action);
      this.$root.$emit(Action.event, Action);
    }
  }
};
</script>
