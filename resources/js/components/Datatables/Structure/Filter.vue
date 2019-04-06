<template>
  <div class="col-sm-8">
    <div class="filter-bar input-group ">
      <input
        type="text"
        v-model="filterText"
        class="form-control"
        @keyup.enter="doFilter"
        placeholder="Search..."
      >
      <div class="input-group-prepend">
        <button class="btn btn-primary" @click="doFilter">Search</button>
        <button class="btn btn-warning" @click="resetFilter">Reset</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      filterText: ""
    };
  },
  methods: {
    doFilter() {
      this.$events.fire("filter-set", this.filterText);
    },
    resetFilter() {
      this.filterText = "";
      this.$events.fire("filter-reset");
    }
  }
};
</script>