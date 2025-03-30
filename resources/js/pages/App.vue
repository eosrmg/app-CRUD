<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import { useAppearance } from '@/composables/useAppearance';

const { appearance, updateAppearance, isDark } = useAppearance();



</script>

<template>
 

    <Head title="CRUD-App"></Head>


    <div class="flex min-h-screen flex-col items-center justify-start bg-[#FDFDFC] p-3 text-[#1b1b18] dark:bg-[#0a0a0a] lg:justify-start lg:p-3 w-full">
        
        <header class="not-has-[nav]:hidden mb-6 w-full max-w-[335px] text-sm lg:max-w-5xl">
            <nav class="flex items-center justify-between gap-4">

                <div class="flex items-center gap-4">
                    <Avatar>
                        <AvatarImage src="https://github.com/unovue.png" alt="@unovue" />
                        <AvatarFallback>CN</AvatarFallback>
                    </Avatar>
                    <h1 class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]" type="button">Products DB app
                    </h1>
                </div>



                <button @click="updateAppearance(isDark ? 'light' : 'dark')"
                    class="rounded-full bg-gray-200 p-2 dark:bg-gray-700" aria-label="Toggle Theme">

                    <!-- Dark Mode Icon -->
                    <svg v-if="isDark" class="h-5 w-5 text-gray-800 dark:text-gray-200" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path d="M10 2a8 8 0 108 8 6 6 0 01-8-8z" />
                    </svg>

                    <!-- Light Mode Icon -->
                    <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-500 dark:text-orange-400"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M10 15a5 5 0 100-10 5 5 0 000 10zm0-12a1 1 0 011-1h0a1 1 0 01-1 1zm0 14a1 1 0 011 1h0a1 1 0 01-1-1zm6-6a1 1 0 011-1h0a1 1 0 01-1 1zm-12 0a1 1 0 01-1-1h0a1 1 0 011 1zm8.66-5.66a1.2 1.2 0 011.7 0h0a1.2 1.2 0 01-1.7 0zm-9.32 9.32a1.2 1.2 0 011.7 0h0a1.2 1.2 0 01-1.7 0zm9.32 0a1.2 1.2 0 011.7 0h0a1.2 1.2 0 01-1.7 0zm-9.32-9.32a1.2 1.2 0 011.7 0h0a1.2 1.2 0 01-1.7 0z" />
                    </svg>

                </button>





            </nav>
        </header>

        <div
        class="flex w-full max-w-[335px] flex-col-reverse overflow-hidden rounded-lg lg:max-w-5xl lg:flex-row lg:items-center lg:justify-center">
        <main
            class="flex w-full max-w-[335px] flex-col-reverse overflow-hidden rounded-lg lg:max-w-5xl lg:flex-row lg:items-center lg:justify-center">
            <div
                class="flex-1 rounded-bl-lg rounded-br-lg bg-white p-6 pb-12 text-[13px] leading-[20px] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:bg-[#161615] dark:text-[#EDEDEC] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] lg:rounded-br-none lg:rounded-tl-lg lg:p-20 lg:text-center">

                <div class="flex flex-col gap-4 items-center">
                <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] text-center pb-4">CRUD App</h1>
                <p class="text-sm text-center text-[#1b1b18] dark:text-[#EDEDEC]">This is a simple CRUD application built
                    with
                    Shadcn, Vue 3, Inertia.js, and Laravel. It allows you to create, read, update, and delete products.
                </p>
                <div class="flex justify-center">
                <Link :href="route('dashboard') "
                    class="inline-flex items-center justify-center rounded-md bg-mint-700 px-6 py-2 text-sm font-medium text-white shadow-sm hover:bg-mint-400 focus:outline-none focus:ring-2 focus:ring-mint-500 focus:ring-offset-2 w-auto" replace>
                Go to Products
                </Link>
                </div>
                </div>

            </div>

            </main>
        </div>
    </div>
 

</template>
