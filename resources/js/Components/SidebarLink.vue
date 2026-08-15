<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: String,
    active: Boolean,
    collapsed: Boolean,
    badge: {
        type: Number,
        default: 0,
    },
});
</script>

<template>
    <Link
        :href="href"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors relative"
        :class="
            active
                ? 'bg-blue-50 text-blue-600'
                : 'text-slate-600 hover:bg-slate-50'
        "
    >
        <span class="shrink-0 w-5 h-5">
            <slot name="icon" />
        </span>

        <span
            v-if="!collapsed"
            class="flex-1 truncate"
        >
            <slot />
        </span>

        <span
            v-if="!collapsed && badge > 0"
            class="bg-red-500 text-white text-[10px] rounded-full px-1.5 py-0.5"
        >
            {{ badge }}
        </span>

        <span
            v-if="collapsed && badge > 0"
            class="absolute top-1 right-1 bg-red-500 text-white text-[10px] rounded-full w-4 h-4 flex items-center justify-center"
        >
            {{ badge }}
        </span>
    </Link>
</template>