// filepath: c:\Users\ADMIN\pos-system\resources\js\Pages\Pos\Orders\Create.vue
<script setup>
import { ref } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';

const props = usePage().props.value || {}; // Giá trị mặc định cho props
const diningTables = ref(props.diningTables || []); // Giá trị mặc định cho diningTables
const menuItems = ref(props.menuItems || []); // Giá trị mặc định cho menuItems

console.log('Dining Tables:', diningTables.value); // Kiểm tra dữ liệu diningTables
console.log('Menu Items:', menuItems.value); // Kiểm tra dữ liệu menuItems

const form = useForm({
  dining_table_id: '',
  items: [],
});

const handleSubmit = () => {
  if (!form.dining_table_id) {
    alert('Please select a dining table');
    return;
  }

  if (form.items.length === 0) {
    alert('Please select at least one menu item');
    return;
  }

  form.post('/orders', {
    onSuccess: () => {
      alert('Order created successfully!');
    },
    onError: (errors) => {
      console.error('Form submission errors:', errors);
    },
  });
};
</script>

<template>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Create Order</h1>
    
    <!-- Debug info -->
    <div class="mb-4 p-2 bg-gray-100" v-if="!diningTables.length || !menuItems.length">
      <p class="text-red-500">Warning: No data loaded</p>
      <p v-if="!diningTables.length">No dining tables available</p>
      <p v-if="!menuItems.length">No menu items available</p>
    </div>

    <form @submit.prevent="handleSubmit">
      <div class="mb-4">
        <label for="dining_table" class="block text-gray-700 font-bold mb-2">Dining Table</label>
        <select 
          v-model="form.dining_table_id" 
          id="dining_table" 
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >
          <option value="" disabled selected>Select a table</option>
          <option v-for="table in diningTables" :key="table.id" :value="table.id">
            Table {{ table.table_number }}
          </option>
        </select>
        <div v-if="form.errors.dining_table_id" class="text-red-500 text-sm mt-1">
          {{ form.errors.dining_table_id }}
        </div>
      </div>

      <div class="mb-4">
        <label for="menu_items" class="block text-gray-700 font-bold mb-2">Menu Items</label>
        <select 
          v-model="form.items" 
          id="menu_items" 
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
          multiple
          size="5"
        >
          <option v-for="item in menuItems" :key="item.id" :value="item.id">
            {{ item.name }} - ${{ item.price }}
          </option>
        </select>
        <div v-if="form.errors.items" class="text-red-500 text-sm mt-1">
          {{ form.errors.items }}
        </div>
      </div>

      <button 
        type="submit" 
        class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
      >
        Create Order
      </button>
    </form>
  </div>
</template>