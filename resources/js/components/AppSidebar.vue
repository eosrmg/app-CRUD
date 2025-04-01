<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { ZiggyVue } from 'ziggy-js';
import { computed, } from 'vue';

import {
  Sidebar,
  SidebarContent,
  SidebarGroup,
  SidebarGroupContent,
  SidebarGroupLabel,
  SidebarHeader,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
  type SidebarProps,
  SidebarRail,
} from '@/components/ui/sidebar'
import {
  AudioWaveform,
  Blocks,
  Calendar,
  Command,
  Home,
  Inbox,
  MessageCircleQuestion,
  Search,
  Settings2,
  Sparkles,
  Trash2,
} from 'lucide-vue-next'

import LogoField from './LogoField.vue';

// Define your props with defaults
const props = withDefaults(defineProps<SidebarProps>(), {
  collapsible: 'icon' // Default value for the 'collapsible' prop

})

const isCollapsed = computed(() => props.collapsible === 'icon')


const currentRoute = computed(() => {
    return route().current() || null;
});


const data = {

  teams: [
    {
      name: 'CRUD APP',
      logo: Sparkles,
      url: "/"
      
    },
  ],

  navMain: [
    {
      
      title: 'Products Data Base',
      items: [
        { title: 'Products', routeName: 'dashboard', Icon: Command, },
        { title: 'Create Product', routeName: 'createproduct', Icon: Blocks },
      ],
    },


  ],
}



</script>
<template>
  <Sidebar v-bind="props" >
    <SidebarHeader>
      <LogoField :teams="data.teams" />
    </SidebarHeader>
    <SidebarContent>
      <SidebarGroup v-for="item in data.navMain" :key="item.title">
        <SidebarGroupLabel v-if="isCollapsed">{{ item.title }}</SidebarGroupLabel>
        <SidebarGroupContent>
          <SidebarMenu>
            <SidebarMenuItem v-for="childItem in item.items" :key="childItem.title">
              <SidebarMenuButton as-child>
                <Link
                  :href="route(childItem.routeName)"
                  class="flex items-center gap-2"
                  :class="{ 'bg-blue-500 text-white': currentRoute === childItem.routeName }"
                  
                >
                  <!-- Render Icon if it's provided -->
                  <component :is="childItem.Icon" class="w-5 h-5" />
                  <!-- Render title only when not collapsed -->
                  <span v-if="isCollapsed">{{ childItem.title }}</span>
                </Link>
              </SidebarMenuButton>
            </SidebarMenuItem>
          </SidebarMenu>
        </SidebarGroupContent>
      </SidebarGroup>
    </SidebarContent>
    <SidebarRail />
  </Sidebar>
</template>


