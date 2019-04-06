<template>
  <form @submit.prevent="submitForm" @keydown="form.onKeydown($event)">
    <div class="form-group">
      <label for="title">Title</label>
      <input
        v-model="form.title"
        type="text"
        name="title"
        class="form-control"
        :class="{ 'is-invalid': form.errors.has('title') }"
      >
      <has-error :form="form" field="pageTitle"></has-error>
    </div>
    <div class="form-group">
      <label for="title">Content</label>
      <input
        v-model="form.content"
        type="text"
        name="content"
        class="form-control"
        :class="{ 'is-invalid': form.errors.has('title') }"
      >
      <has-error :form="form" field="pageTitle"></has-error>
    </div>
    <button :disabled="form.busy" type="submit" class="btn btn-primary">Confirm</button>
  </form>
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
        title: "",
        content: ""
      })
    };
  },
  methods: {
    submitForm() {
      this.form
        .post("/api/posts")
        .then(({ data }) => {
          Toast.fire({
            type: data.type,
            title: data.msg
          });

          $("#" + this.settings.id).modal('hide')
          this.$root.$emit('form-submitted-success')
        })
        .catch(error => {
            console.log(error)
          Toast.fire({
            type: "error",
            title: error.response.data.message
          });
        });
    }
  },
  props: {
    settings: {
      type: Object,
      required: true
    }
  }
};
</script>