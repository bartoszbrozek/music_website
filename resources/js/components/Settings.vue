<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <form @submit.prevent="updateSettings" @keydown="form.onKeydown($event)">
          <div class="form-group">
            <label for="pageTitle">Settings</label>
            <input
              v-model="form.pageTitle"
              type="text"
              name="pageTitle"
              class="form-control"
              :class="{ 'is-invalid': form.errors.has('pageTitle') }"
            >
            <has-error :form="form" field="pageTitle"></has-error>
          </div>
          <button :disabled="form.busy" type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      settings: {},
      form: new Form({
        pageTitle: ""
      })
    };
  },
  created() {
    this.loadSettings();
  },
  methods: {
    updateSettings() {
      this.form
        .post("/api/settings")
        .then(({ data }) => {
          Toast.fire({
            type: data.type,
            title: data.msg
          });
        })
        .catch(error => {
          Toast.fire({
            type: 'error',
            title: error.response.data.message
          });
        });
    },
    loadSettings() {
      axios
        .get("/api/settings")
        .then(({ data }) => this.form.fill(data.settings));
    }
  }
};
</script>
