<template>
  <div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Restaurant POS Dashboard</h1>
    <div>
      <Link href="/orders" class="px-4 py-2 bg-blue-500 text-white mr-4">View Orders</Link>
      <Link href="/orders/create" class="px-4 py-2 bg-green-500 text-white">New Order</Link>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
