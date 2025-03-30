<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { usePage, useForm } from '@inertiajs/vue3';


import { Button } from '@/components/ui/button';
import {
    FormControl,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from '@/components/ui/form';
import { Input } from '@/components/ui/input';





interface Product {
    id: number;
    name: string;
    qty: number;
    price: number;
    description: string;
}

const { props } = usePage<{ product?: Product }>();

const form = useForm({
    name: '',
    qty: '',
    price: '',
    description: ''
});

// Check if we're editing or creating
const isEdit = props.product !== undefined;

if (isEdit) {
    // Pre-fill form fields if editing
    form.name = props.product?.name || '';
    form.qty = props.product?.qty !== undefined ? String(props.product.qty) : '';
    form.price = props.product?.price !== undefined ? String(props.product.price) : '';
    form.description = props.product?.description || '';
}

const submitForm = () => {
    if (isEdit) {
        form.put(route('createproduct.update', { product: props.product?.id }), {
            replace: true  // This prevents adding a new entry to the browser history
        });
    } else {
        form.post(route('createproduct'), {
            replace: true  // Add this option here to prevent history entry
        });
    }
};





</script>

<template>

    <Head title="Create/Edit Product" />
    <div class="flex justify-center p-4">
        <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-6 w-full max-w-3xl">

            <Link :href="route('dashboard')" class="inline-flex items-center justify-center rounded-md bg-red-400 px-4 py-1 text-sm font-medium shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 w-auto" replace>
                
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m7 7l-7-7 7-7" />
                </svg>
            </Link>

            <h1 class="text-center pb-9">{{ isEdit ? 'Edit' : 'Create' }} Product</h1>

          

            <form @submit.prevent="submitForm" class="space-y-4">
                <!-- Product Name -->
                <FormField name="name">
                    <FormItem>
                        <FormLabel>Product Name:</FormLabel>
                        <FormControl>
                            <Input id="name" type="text" placeholder="Product Name" v-model="form.name" required />
                        </FormControl>
                        <FormMessage />
                    </FormItem>
                </FormField>

                <!-- Quantity -->
                <FormField  name="qty">
                    <FormItem>
                        <FormLabel>Quantity:</FormLabel>
                        <FormControl>
                            <Input id="qty" type="number" placeholder="Quantity" v-model="form.qty" required />
                        </FormControl>
                        <FormMessage />
                    </FormItem>
                </FormField>

                <!-- Price -->
                <FormField  name="price">
                    <FormItem>
                        <FormLabel>Price:</FormLabel>
                        <FormControl>
                            <Input id="price" type="number" placeholder="Price" step="0.01" v-model="form.price"
                                required />
                        </FormControl>
                        <FormMessage />
                    </FormItem>
                </FormField>

                <!-- Description -->
                <FormField name="description">
                    <FormItem>
                        <FormLabel>Description:</FormLabel>
                        <FormControl>
                            <Input id="description" type="text" placeholder="Description" v-model="form.description" />
                        </FormControl>
                        <FormMessage />
                    </FormItem>
                </FormField>

                <!-- Submit Button -->
                <div>
                    <Button type="submit" class="sh-button">{{ isEdit ? 'Update' : 'Add' }} Product</Button>
                </div>
            </form>
        </div>

    </div>

</template>
