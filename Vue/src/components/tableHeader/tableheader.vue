<template>
  <th
    @click="$emit('click')"
    class="border-b p-2 text-left bg-gray-100"
    :class="[sortField === field ? 'bg-blue-50' : '']"
  >
    <div class="flex items-center justify-between">
      <slot></slot>
      <div v-if="sortField === field" class="ml-2">
        <svg
          v-if="sortDirection === 'asc'"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-6 h-6"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M3 4.5h14.25M3 9h9.75M3 13.5h5.25m5.25-.75L17.25 9m0 0L21 12.75M17.25 9v12"
          />
        </svg>

        <svg
          v-else
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-6 h-6"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0-3.75-3.75M17.25 21 21 17.25"
          />
        </svg>
      </div>
    </div>
    <!-- </div> -->
  </th>
</template>

<script setup>
const { sortField, sortDirection, field } = defineProps({
  sortField: String,
  field: String,
  sortDirection: String,
});

const click = defineEmits(["click"]);
</script>

<style scoped>
th {
  font-size: 14px !important;
}
</style>
