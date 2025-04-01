<script setup lang="ts">
import {
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
} from '@/components/ui/sidebar'

import { type Component, ref } from 'vue'
import { Link } from '@inertiajs/vue3'  // Import Inertia Link

const props = defineProps<{
  teams: {
    name: string
    logo: Component
    url: string // Add URL property to the props
  }[]
}>()

const activeTeam = ref(props.teams[0])
</script>

<template>
  <SidebarMenu>
    <SidebarMenuItem>
      <!-- Use Inertia Link or <a> if you prefer -->
      <Link :href="activeTeam.url">
        <SidebarMenuButton size="lg" class="flex items-center gap-2 p-2">
          <div class="flex aspect-square size-8 items-center justify-center rounded-lg bg-sidebar-primary text-sidebar-primary-foreground">
            <component :is="activeTeam.logo" class="size-4" />
          </div>
          <div class="text-sm font-semibold truncate">{{ activeTeam.name }}</div>
        </SidebarMenuButton>
      </Link>
    </SidebarMenuItem>
  </SidebarMenu>
</template>

