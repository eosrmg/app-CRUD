<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref, } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Inertia } from '@inertiajs/inertia';
import Toaster from "@/components/ui/toast/Toaster.vue"
import { toast } from '@/components/ui/toast/use-toast';



interface Product {
    id: number;
    name: string;
    qty: number;
    price: number;
    description: string;
}


interface PageProps {
    products?: Product[];
    flash?: { success?: string };
    [key: string]: any; // Add index signature to satisfy the constraint
}

const { props } = usePage<PageProps>();
const products = ref<Product[]>(props.products || []);


const showToast = (message: string) => {
    toast({
        title: 'Product Status',
        description: message,
        duration: 4000,
        class: 'border border-green-500 font-lite text-md p-4 rounded',
    });
    setTimeout(() => {
        Inertia.replace(window.location.href); // Prevents adding this action to the browser's history
    }, 4000); // Delay the page reload to allow the toast to stay visible
};

if (props.flash?.success) {
    const alertDelete = props.flash.success as string;
    showToast(alertDelete);
}


const deleteProduct = (id: number) => {
    if (confirm('Are you sure you want to delete this product?')) {
        Inertia.delete(route('createproduct.destroy', { product: id }), {
            replace: true, // Prevents adding this action to the browser's history
            preserveScroll: true, // Prevents scrolling to top after deletion
           
        });
    }
};



</script>

<template>
    <Toaster />


    <Head title="Dashboard" />

    <div class="flex justify-center p-4">
        <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-6 w-full max-w-1xl">
            <h2 class="text-lg font-semibold text-center">Products</h2>


            <Link :href="route('app')"class="inline-flex items-center justify-center rounded-md bg-red-400 px-4 py-1 text-sm font-medium shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 w-auto" replace>
                
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m7 7l-7-7 7-7" />
                </svg>
            </Link>

            <div class="flex justify-end">
                <Link :href="route('createproduct')"
                    class="inline-flex items-center justify-center rounded-md bg-orange-500 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                Add New Product
                </Link>
            </div>

            
            <div class="mt-2">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead>ID</TableHead>
                            <TableHead>Name</TableHead>
                            <TableHead>Quantity</TableHead>
                            <TableHead>Price</TableHead>
                            <TableHead>Description</TableHead>
                            <TableHead>Actions</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="product in products" :key="product.id">
                            <TableCell>{{ product.id }}</TableCell>
                            <TableCell>{{ product.name }}</TableCell>
                            <TableCell>{{ product.qty }}</TableCell>
                            <TableCell>{{ product.price }}</TableCell>
                            <TableCell>{{ product.description }}</TableCell>
                            <TableCell>
                                <Link :href="route('createproduct.edit', { product: product.id })"
                                    class="text-blue-500 hover:underline" replace>
                                Edit
                                </Link>
                                <button @click="deleteProduct(product.id)" class="text-red-500 hover:underline ml-2">
                                    Delete
                                </button>

                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>

        </div>
    </div>

</template>
