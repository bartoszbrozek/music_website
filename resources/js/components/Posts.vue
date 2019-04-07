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
          :customActions="customActions"
          :model="model"
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
        },
        {
          name: "__slot:actions",
          title: "Actions",
          titleClass: "center aligned",
          dataClass: "center aligned"
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
      model: "Posts",
      customActions: [
        {
          id: "modal_show_post",
          contentData: {},
          action: function(id, _selfAction) {
            axios.get("/api/posts/" + id).then(({ data }) => {
              _selfAction.contentData = data;
            });
          },
          title: "Post Details",
          btnClass: "btn btn-sm btn-success",
          iconClass: "fa fa-eye",
          event: "before-data-loaded-show"
        },
        {
          id: "modal_edit_post",
          contentData: {},
          action: function(id, _selfAction) {
            _selfAction.form.endpoint = "/api/posts/" + id

            let result = $.ajax({
              type: "GET",
              url: "/api/posts/" + id,
              async: false
            }).responseText;

            var data = JSON.parse(result);
            _selfAction.form.fields.forEach((field, index) => {
              for (var propertyName in data) {
                let obj = data[propertyName];
                if (_selfAction.form.fields[index].name === propertyName) {
                  _selfAction.form.fields[index].value = data[propertyName];
                }
              }
            });
          },
          title: "Edit Post",
          btnClass: "btn btn-sm btn-warning",
          iconClass: "fa fa-edit",
          form: {
            endpoint: "",
            method: "PUT",
            fields: [
              {
                title: "Title",
                name: "title",
                type: "text",
                value: ""
              },
              {
                title: "Content",
                name: "content",
                type: "textarea",
                value: ""
              }
            ]
          },
          event: "before-data-loaded-show"
        }
      ],
      createModalSettings: {
        id: "modal_create_new_post",
        title: "Create New Post",
        form: {
          endpoint: "/api/posts",
          method: "POST",
          fields: [
            {
              title: "Title",
              name: "title",
              type: "text",
              value: ""
            },
            {
              title: "Content",
              name: "content",
              type: "textarea",
              value: ""
            }
          ]
        }
      }
    };
  }
};
</script>
