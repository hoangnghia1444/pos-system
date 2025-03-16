<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

const props = usePage().props.value || {}; // Giá trị mặc định cho props
const orders = props.orders || { data: [], prev_page_url: null, next_page_url: null }; // Giá trị mặc định cho orders

console.log('Orders:', orders); // Kiểm tra dữ liệu orders

// Điều hướng phân trang
const goToPage = (url) => {
  if (url) Inertia.get(url);  
};

// Hàm xóa đơn hàng
const deleteOrder = (orderId) => {
  if (confirm("Are you sure you want to delete this order?")) {
    Inertia.delete(`/orders/${orderId}`);
  }
};
</script>

<template>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Orders</h1>
    <table class="min-w-full table-auto border-collapse">
      <thead>
        <tr>
          <th class="px-4 py-2 border">Order ID</th>
          <th class="px-4 py-2 border">Table</th>
          <th class="px-4 py-2 border">Total Amount</th>
          <th class="px-4 py-2 border">Status</th>
          <th class="px-4 py-2 border">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order in orders.data" :key="order.id">
          <td class="border px-4 py-2">{{ order.id }}</td>
          <td class="border px-4 py-2">
            <!-- Kiểm tra null trước khi hiển thị table_number -->
            <span v-if="order.dining_table">
              {{ order.dining_table.table_number }}
            </span>
            <span v-else>
              No table
            </span>
          </td>
          <td class="border px-4 py-2">{{ order.total_amount }}</td>
          <td class="border px-4 py-2">{{ order.status }}</td>
          <td class="border px-4 py-2">
            <Link :href="`/orders/${order.id}/edit`" class="text-blue-500">Edit</Link>
            <button @click="deleteOrder(order.id)" class="ml-2 text-red-500">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination Controls -->
    <div class="mt-4 flex justify-between">
      <button
        v-if="orders.prev_page_url"
        @click="goToPage(orders.prev_page_url)"
        class="px-4 py-2 bg-gray-300"
      >
        Prev
      </button>
      <button
        v-if="orders.next_page_url"
        @click="goToPage(orders.next_page_url)"
        class="px-4 py-2 bg-gray-300"
      >
        Next
      </button>
    </div>
  </div>
</template>