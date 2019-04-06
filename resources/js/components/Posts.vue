<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <posts-datatable
          :tableTitle="tableTitle"
          :api-url="apiUrl"
          :fields="fields"
          :sort-order="sortOrder"
          :append-params="moreParams"
          :showFilterBar="showFilterBar"
          :showCreateButton="showCreateButton"
        ></posts-datatable>

        <form @submit.prevent="createPost" @keydown="form.onKeydown($event)">
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
              v-model="form.title"
              type="text"
              name="content"
              class="form-control"
              :class="{ 'is-invalid': form.errors.has('title') }"
            >
            <has-error :form="form" field="pageTitle"></has-error>
          </div>
          <button :disabled="form.busy" type="submit" class="btn btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import PostsDatatable from "./Datatables/GenericDatatable";
export default {
  components: {
    PostsDatatable
  },
  data() {
    return {
      posts: {},
      form: new Form({
        title: "",
        content: ""
      }),
      tableTitle: "Posts",
      apiUrl: "/api/posts",
      fields: [
        {
          name: "id",
          title: "ID",
          sortField: "id"
        },
        {
          name: "title",
          title: "Title",
          sortField: "title"
        },
        {
          name: "content",
          title: "Content",
          sortField: "content"
        },
        {
          name: "updated_at",
          title: "Updated At",
          sortField: "updated_at"
        },
        {
          name: "created_at",
          title: "Created At",
          sortField: "created_at"
        }
      ],
      sortOrder: [
        {
          field: "id",
          sortField: "id",
          direction: "asc"
        }
      ],
      moreParams: {},
      showFilterBar: true,
      showCreateButton: true
    };
  },
  methods: {
    createPost() {
      this.form
        .post("/api/posts")
        .then(({ data }) => {
          Toast.fire({
            type: data.type,
            title: data.msg
          });
        })
        .catch(error => {
          Toast.fire({
            type: "error",
            title: error.response.data.message
          });
        });
    }
  }
};
</script>
