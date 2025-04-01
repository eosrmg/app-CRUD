<script lang="ts">
export const iframeHeight = '800px'
export const description = 'A simple sidebar with navigation grouped by section.'
</script>

<script setup lang="ts">
import AppSidebar from '@/components/AppSidebar.vue'
import { useAppearance } from '@/composables/useAppearance';
import { ref } from 'vue';

import {
  SidebarInset,
  SidebarProvider,
  SidebarTrigger,
} from '@/components/ui/sidebar'

const { updateAppearance, isDark } = useAppearance();



</script>

<template>
    <SidebarProvider>
      <AppSidebar />
    

      <SidebarInset>
        <header class="flex h-16 shrink-0 items-center gap-2 border-b px-4">
          <SidebarTrigger class="-ml-1" />

          <div class="ml-auto">
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
                </div>
        </header>
        
  
        <!-- Slot will render the page's content (Index.vue, Dashboard.vue, etc.) -->
        <slot />
      </SidebarInset>
    </SidebarProvider>
  </template>
  