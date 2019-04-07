<template>
  <form @submit.prevent="submitForm" @keydown="form.onKeydown($event)" v-if="settings.form">
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
      form: new Form(this.getFields())
    };
  },
  mounted() {
    var self = this;
    if (typeof this.settings.event !== "undefined") {
      this.$root.$on(this.settings.event, e => this.onFormDataEvent(e));
    }
  },
  created() {},
  methods: {
    onFormDataEvent(data) {
      if (typeof data.form !== "undefined") {
        this.settings.form.fields = data.form.fields;
        this.setForm();
      }
    },
    getFields() {
      let fields = {};
      this.settings.form.fields.forEach(field => {
        fields[field.name] = field.value;
      });

      return fields;
    },
    setForm() {
      this.form = new Form(this.getFields());
    },
    submitForm() {
      let request = null;
      let endpoint = this.settings.form.endpoint;
      switch (this.settings.form.method) {
        case "POST":
          request = this.form.post(endpoint);
          break;

        case "PUT":
          request = this.form.put(endpoint);
          break;

        default:
          request = this.form.post(endpoint);
          break;
      }

      request
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