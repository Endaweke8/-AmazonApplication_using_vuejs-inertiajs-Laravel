<script setup>
import ProductComponent from '@/Components/ProductComponent.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';



</script>

<template>
    <Head title="Category" />

    <AuthenticatedLayout>
     <div class="w-full p-1 pt-2 mb-6">
        <div class="font-extrabold text-[27px]">
            {{ $page.props.category_name.name }}
        </div>
     </div>
     <div>
        1-{{ $page.props.category_by_id.length }} of our {{ $page.props.category_name.length }}
     </div>
     <div class="grid grid-cols-4 gap-1">
         <div v-for="product in $page.props.category_by_id" :key="product" class="mt-1">
          <ProductComponent :product="product" />
        </div>
     </div>
    </AuthenticatedLayout>
</template>
<style>

</style>