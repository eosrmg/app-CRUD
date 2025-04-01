<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';




</script>

<template>
 <AppLayout>

    <Head title="CRUD-App"></Head>


    <div class="flex  flex-col items-center justify-start bg-[#FDFDFC] p-3 text-[#1b1b18] dark:bg-[#0a0a0a] lg:justify-start lg:p-3 w-full">
      

                <div class="flex flex-col gap-4 items-center">
                <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] text-center pb-4">CRUD App</h1>
                <p class="text-sm text-center text-[#1b1b18] dark:text-[#EDEDEC]">This is a simple CRUD application built
                    with
                    Shadcn, Vue 3, Inertia.js, and Laravel. It allows you to create, read, update, and delete products.
                </p>
               
               
                </div>

    </div>
</AppLayout>

</template>
