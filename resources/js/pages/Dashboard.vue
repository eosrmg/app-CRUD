<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import axios from 'axios';
import { ref, watch, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import Toaster from "@/components/ui/toast/Toaster.vue"
import { toast } from '@/components/ui/toast/use-toast';
import { Skeleton } from '@/components/ui/skeleton';  // Make sure this component exists in your setup
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';

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

const loading = ref(true);  // New loading state

const fetchProducts = async () => {
    loading.value = true;  // Start loading
    try {
        
        const response = await axios.get('/products');
        products.value = response.data;  // Update the products list
    } catch (error) {
        console.error('Error fetching products:', error);
    } finally {
        await new Promise(resolve => setTimeout(resolve, 500));
        loading.value = false;  // Stop loading
    }
};


onMounted(() => {
    fetchProducts();  // Fetch products when component is mounted
});

const showToast = (message: string) => {
    toast({
        title: 'Product Status',
        description: message,
        duration: 3000,
        class: 'border border-green-500 font-lite text-md p-4 rounded',
    });

};

if (props.flash?.success) {
    const alert = props.flash.success as string;
    showToast(alert);
}


const deleteProduct = async (id: number) => {
    if (confirm('Are you sure you want to delete this product?')) {
        try {
            // Make the API request to delete the product
            await axios.delete(`/products/${id}`);

            // Remove the deleted product from the `products` array
            products.value = products.value.filter(product => product.id !== id);
         

            // Optionally, show a toast or success message
            showToast('Product deleted successfully!');
        } catch (error) {
            console.error('Error deleting product:', error);
            showToast('Error deleting product.');
        }
    }
};


</script>

<template>
    <AppLayout>
    <Toaster />


    <Head title="Dashboard" />

    <div class="flex justify-center p-4">
        <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-6 w-full max-w-1xl">
            <h2 class="text-lg font-semibold text-center">Products</h2>
            
            <div class="mt-2">

    <!-- Display the table only when data is fully loaded -->
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
                    <TableBody  v-if="!loading">
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

                         <!-- Skeleton Loader when loading -->
        <div v-if="loading">
            <div v-for="n in 5" :key="n" class="mb-4">
                <Skeleton class="h-7 w-full mb-4" />
            
 
            </div>
        </div>
            </div>

        </div>
    </div>
</AppLayout>
</template>
