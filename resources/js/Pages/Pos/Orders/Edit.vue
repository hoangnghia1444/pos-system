<template>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Order #{{ order.id }}</h1>
    <form @submit.prevent="submitForm">
      <div class="mb-4">
        <label class="block mb-1">Select Dining Table</label>
        <select v-model="form.dining_table_id" class="border p-2 w-full">
          <option value="">-- Choose Table --</option>
          <option v-for="table in diningTables" :key="table.id" :value="table.id">
            {{ table.table_number }} (Capacity: {{ table.capacity }})
          </option>
        </select>
      </div>

      <div class="mb-4">
        <h2 class="font-bold mb-2">Order Items</h2>
        <div
          v-for="(item, index) in form.items"
          :key="index"
          class="mb-2 border p-2"
        >
          <label class="block mb-1">Select Menu Item</label>
          <select v-model="item.menu_item_id" class="border p-2 w-full mb-2">
            <option value="">-- Select Menu Item --</option>
            <option v-for="menu in menuItems" :key="menu.id" :value="menu.id">
              {{ menu.name }} ({{ menu.price }} VND)
            </option>
          </select>
          <label class="block mb-1">Quantity</label>
          <input
            type="number"
            v-model="item.quantity"
            min="1"
            class="border p-2 w-full"
          />
          <button
            type="button"
            @click="removeItem(index)"
            class="text-red-500 mt-2"
          >
            Remove
          </button>
        </div>
        <button
          type="button"
          @click="addItem"
          class="bg-blue-500 text-white px-4 py-2"
        >
          Add Item
        </button>
      </div>

      <button type="submit" class="bg-green-500 text-white px-4 py-2">
        Update Order
      </button>
    </form>
  </div>
</template>

<script setup>
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/vue3';

const { order, diningTables, menuItems } = usePage().props.value;

const form = reactive({
  dining_table_id: order.dining_table.id,
  items: order.order_items.map(item => ({
    menu_item_id: item.menu_item.id,
    quantity: item.quantity,
  })),
});


const addItem = () => {
  form.items.push({ menu_item_id: '', quantity: 1 });
};


const removeItem = (index) => {
  form.items.splice(index, 1);
};

const submitForm = () => {
  Inertia.put(`/orders/${order.id}`, form);
};
</script>
