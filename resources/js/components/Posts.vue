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
          :createModalSettings="createModalSettings"
        ></posts-datatable>
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
          direction: "desc"
        }
      ],
      moreParams: {},
      showFilterBar: true,
      showCreateButton: true,
      createModalSettings: {
        id: "modal_create_new_post",
        title: "Create New Post",
        form: {
          submit() {
            console.log(666)
          }
        }
      }
    };
  },
  methods: {
    createPost() {

    }
  }
};
</script>
