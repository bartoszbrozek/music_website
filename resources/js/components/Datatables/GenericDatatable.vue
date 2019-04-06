<template>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header" v-if="tableTitle">
          <h3 class="card-title" v-html="tableTitle"></h3>
        </div>
        <div class="card-body">
          <div class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12 col-md-6"></div>
              <div class="col-sm-12 col-md-6"></div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="row md-3">
                  <filter-bar v-if="showFilterBar"></filter-bar>
                  <button-create v-if="showCreateButton" :settings="createModalSettings"></button-create>
                </div>
                <vuetable
                  ref="vuetable"
                  :api-url="apiUrl"
                  :fields="fields"
                  pagination-path
                  :per-page="10"
                  :sort-order="sortOrder"
                  :append-params="appendParams"
                  @vuetable:pagination-data="onPaginationData"
                ></vuetable>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <vuetable-pagination-bootstrap
                  ref="pagination"
                  @vuetable-pagination:change-page="onChangePage"
                ></vuetable-pagination-bootstrap>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <modal-basic :settings="createModalSettings"></modal-basic>
  </div>
</template>

<script>
import Vuetable from "vuetable-2/src/components/Vuetable";
import VuetablePaginationBootstrap from "./Structure/VuetablePaginationBootstrap";
import FilterBar from "./Structure/Filter";
import ButtonCreate from "./Structure/Buttons/Create";
import ModalBasic from "./Structure/Modals/BasicModal";

export default {
  components: {
    Vuetable,
    VuetablePaginationBootstrap,
    FilterBar,
    ButtonCreate,
    ModalBasic
  },
  props: {
    tableTitle: {
      type: String,
      required: true
    },
    apiUrl: {
      type: String,
      required: true
    },
    fields: {
      type: Array,
      required: true
    },
    sortOrder: {
      type: Array,
      default() {
        return [];
      }
    },
    appendParams: {
      type: Object,
      default() {
        return {};
      }
    },
    detailRowComponent: {
      type: String
    },
    showFilterBar: {
      type: Boolean,
      required: true
    },
    showCreateButton: {
      type: Boolean,
      required: true
    },
    createModalSettings: {
      type: Object,
      required: true
    }
  },
  data() {
    return {};
  },
  mounted() {
    this.$events.$on("filter-set", eventData => this.onFilterSet(eventData));
    this.$events.$on("filter-reset", e => this.onFilterReset());
    this.$root.$on("form-submitted-success", e => this.onFormSubmitted());
  },
  methods: {
    onPaginationData(paginationData) {
      this.$refs.pagination.setPaginationData(paginationData);
    },
    onChangePage(page) {
      this.$refs.vuetable.changePage(page);
    },
    onAction(action, data, index) {
      console.log("slot action: " + action, data.name, index);
    },
    onCellClicked(data, field, event) {
      console.log("cellClicked: ", field.name);
      this.$refs.vuetable.toggleDetailRow(data.id);
    },
    onFilterSet(filterText) {
      this.appendParams.filter = filterText;
      Vue.nextTick(() => this.$refs.vuetable.refresh());
    },
    onFilterReset() {
      delete this.appendParams.filter;
      Vue.nextTick(() => this.$refs.vuetable.refresh());
    },
    onFormSubmitted() {
      this.$refs.vuetable.refresh();
    }
  }
};
</script>