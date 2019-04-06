<template>
  <div class="dataTables_paginate paging_simple_numbers">
    <ul class="pagination">
      <li :class="{'disabled': isOnFirstPage}" class="paginate_button page-item previous page-link">
        <a href @click.prevent="loadPage('prev')">
          <span>Previous</span>
        </a>
      </li>

      <template v-if="notEnoughPages">
        <li
          v-for="n in totalPage"
          v-bind:key="n"
          :class="{'active': isCurrentPage(n)}"
          class="paginate_button page-item"
        >
          <a @click.prevent="loadPage(n)" v-html="n" class="page-link"></a>
        </li>
      </template>
      <template v-else>
        <li
          v-for="n in windowSize"
          v-bind:key="n"
          :class="{'active': isCurrentPage(windowStart+n-1)}"
          class="paginate_button page-item"
        >
          <a @click.prevent="loadPage(windowStart+n-1)" v-html="windowStart+n-1" class="page-link"></a>
        </li>
      </template>

      <li :class="{'disabled': isOnLastPage}" class="paginate_button page-item next page-link">
        <a href @click.prevent="loadPage('next')">
          <span>Next</span>
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
import VuetablePaginationMixin from "vuetable-2/src/components/VuetablePaginationMixin";
export default {
  mixins: [VuetablePaginationMixin]
};
</script>