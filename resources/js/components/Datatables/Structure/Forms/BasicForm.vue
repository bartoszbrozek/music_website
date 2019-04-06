<template>
  <form @submit.prevent="submitForm" @keydown="form.onKeydown($event)">
    <div class="form-group" v-for="field in settings.form.fields" v-bind:key="field.name">
      <!-- TEXT FIELD -->
      <div v-if="field.type === 'text' || field.type === 'password' || field.type === 'number'">
        <label for="title" v-html="field.title"></label>
        <input
          v-model="form[field.name]"
          :type="field.type"
          :name="field.name"
          class="form-control"
          :class="{ 'is-invalid': form.errors.has(field.name) }"
        >
        <has-error :form="form" :field="field.name"></has-error>
      </div>
      <!-- TEXTAREA FIELD -->
      <div v-else-if="field.type === 'textarea'">
        <label for="title" v-html="field.title"></label>
        <textarea
          v-model="form[field.name]"
          :type="field.type"
          :name="field.name"
          class="form-control"
          :class="{ 'is-invalid': form.errors.has(field.name) }"
        ></textarea>
        <has-error :form="form" :field="field.name"></has-error>
      </div>
    </div>

    <button :disabled="form.busy" type="submit" class="btn btn-primary">Confirm</button>
  </form>
</template>

<script>
export default {
  data() {
    return {
      form: {}
    };
  },
  created() {
    let fields = {};
    this.settings.form.fields.forEach(field => {
      fields[field.name] = "";
    });

    this.form = new Form(fields);
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

          $("#" + this.settings.id).modal("hide");
          this.$root.$emit("form-submitted-success");
        })
        .catch(error => {
          console.log(error);
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