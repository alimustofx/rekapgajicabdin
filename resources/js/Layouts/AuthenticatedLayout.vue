<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';

import SidebarLink from '@/Components/SidebarLink.vue';
import NotificationBell from '@/Components/NotificationBell.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const page = usePage();
const user = page.props.auth.user;

const isAdmin = user.role !== 'OPERATOR';

const collapsed = ref(
    localStorage.getItem('sidebar_collapsed') === '1'
);

function toggleCollapse() {
    collapsed.value = !collapsed.value;

    localStorage.setItem(
        'sidebar_collapsed',
        collapsed.value ? '1' : '0'
    );
}

const mobileOpen = ref(false);
</script>

<template>
    <div class="min-h-screen bg-slate-50 flex">

        <!-- Mobile Overlay -->
        <div
            v-if="mobileOpen"
            @click="mobileOpen = false"
            class="fixed inset-0 bg-black/30 z-30 md:hidden"
        ></div>

        <!-- SIDEBAR -->
        <aside
            class="bg-white border-r border-slate-200 flex flex-col fixed md:static inset-y-0 left-0 z-40 transition-all duration-200"
            :class="[
                collapsed
                    ? 'md:w-[72px]'
                    : 'md:w-[240px]',

                mobileOpen
                    ? 'w-[240px]'
                    : 'w-0 md:w-auto overflow-hidden md:overflow-visible'
            ]"
        >

            <!-- Sidebar Header -->
            <div
                class="h-[72px] flex items-center px-4 border-b border-slate-100 gap-2"
            >
                <div
                    class="w-9 h-9 rounded-lg bg-blue-600 flex items-center justify-center text-white font-bold text-sm shrink-0"
                >
                    CD
                </div>

                <span
                    v-if="!collapsed"
                    class="font-semibold text-slate-900 truncate"
                >
                    Sistem Gaji
                </span>
            </div>

            <!-- Navigation -->
            <nav
                class="flex-1 overflow-y-auto p-3 space-y-1"
            >

                <!-- Dashboard -->
                <SidebarLink
                    :href="route('dashboard')"
                    :active="route().current('dashboard')"
                    :collapsed="collapsed"
                >
                    <template #icon>
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 12l9-9 9 9M5 10v10h5v-6h4v6h5V10"
                            />
                        </svg>
                    </template>

                    Dashboard
                </SidebarLink>

                <!-- Payroll Operator -->
                <SidebarLink
                    v-if="user.role === 'OPERATOR'"
                    :href="route('payroll.show')"
                    :active="route().current('payroll.show')"
                    :collapsed="collapsed"
                >
                    <template #icon>
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 6h18M3 12h18M3 18h18"
                            />
                        </svg>
                    </template>

                    Payroll
                </SidebarLink>

                <!-- ADMIN MENU -->
                <template v-if="isAdmin">

                    <!-- Data Master -->
                    <p
                        v-if="!collapsed"
                        class="text-[11px] font-semibold text-slate-400 uppercase px-3 pt-4 pb-1"
                    >
                        Data Master
                    </p>

                    <!-- Master Sekolah -->
                    <SidebarLink
                        :href="route('schools.index')"
                        :active="route().current('schools.index')"
                        :collapsed="collapsed"
                    >
                        <template #icon>
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 21V7l8-4 8 4v14M9 21v-6h6v6"
                                />
                            </svg>
                        </template>

                        Master Sekolah
                    </SidebarLink>

                    <!-- Periode -->
                    <SidebarLink
                        :href="route('periods.index')"
                        :active="route().current('periods.index')"
                        :collapsed="collapsed"
                    >
                        <template #icon>
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                                />
                            </svg>
                        </template>

                        Periode
                    </SidebarLink>

                    <!-- User -->
                    <SidebarLink
                        :href="route('users.index')"
                        :active="route().current('users.index')"
                        :collapsed="collapsed"
                    >
                        <template #icon>
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m5-5.13a4 4 0 100-8 4 4 0 000 8zm6 4a4 4 0 00-3-3.87"
                                />
                            </svg>
                        </template>

                        User
                    </SidebarLink>

                    <!-- Proses Gaji -->
                    <p
                        v-if="!collapsed"
                        class="text-[11px] font-semibold text-slate-400 uppercase px-3 pt-4 pb-1"
                    >
                        Proses Gaji
                    </p>

                    <!-- Import Gaji -->
                    <SidebarLink
                        :href="route('imports.index')"
                        :active="route().current('imports.index')"
                        :collapsed="collapsed"
                    >
                        <template #icon>
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 16V4m0 0L7 9m5-5l5 5M4 16v3a1 1 0 001 1h14a1 1 0 001-1v-3"
                                />
                            </svg>
                        </template>

                        Import Gaji
                    </SidebarLink>

                    <!-- Pencocokan Manual -->
                    <SidebarLink
                        :href="route('unmatched.index')"
                        :active="route().current('unmatched.index')"
                        :collapsed="collapsed"
                    >
                        <template #icon>
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12l2 2 4-4M4 6h16M4 18h16"
                                />
                            </svg>
                        </template>

                        Pencocokan Manual
                    </SidebarLink>

                    <!-- Perbaikan -->
                    <SidebarLink
                        :href="route('revisions.index')"
                        :active="route().current('revisions.index')"
                        :collapsed="collapsed"
                        :badge="page.props.openRevisionsCount"
                    >
                        <template #icon>
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.4-9.4a2 2 0 112.8 2.8L11 17H8v-3l8.6-8.6z"
                                />
                            </svg>
                        </template>

                        Perbaikan
                    </SidebarLink>

                    <!-- Payroll & Rekap -->
                    <p
                        v-if="!collapsed"
                        class="text-[11px] font-semibold text-slate-400 uppercase px-3 pt-4 pb-1"
                    >
                        Payroll & Rekap
                    </p>

                    <!-- Template Payroll -->
                    <SidebarLink
                        :href="route('payroll-templates.index')"
                        :active="route().current('payroll-templates.index')"
                        :collapsed="collapsed"
                    >
                        <template #icon>
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6M9 8h1M5 21h14a1 1 0 001-1V6.41a1 1 0 00-.3-.7l-3.41-3.4a1 1 0 00-.7-.3H5a1 1 0 00-1 1v17a1 1 0 001 1z"
                                />
                            </svg>
                        </template>

                        Template Payroll
                    </SidebarLink>

                    <!-- Rekap -->
                    <SidebarLink
                        :href="route('rekap.index')"
                        :active="route().current('rekap.index')"
                        :collapsed="collapsed"
                    >
                        <template #icon>
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 19V6m6 13V10m-11 9v-4"
                                />
                            </svg>
                        </template>

                        Rekap
                    </SidebarLink>

                </template>
            </nav>

            <!-- Collapse Button -->
            <div class="p-3 border-t border-slate-100">
                <button
                    @click="toggleCollapse"
                    class="hidden md:flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-500 hover:bg-slate-50 w-full"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="w-5 h-5 shrink-0"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            :d="
                                collapsed
                                    ? 'M9 5l7 7-7 7'
                                    : 'M15 5l-7 7 7 7'
                            "
                        />
                    </svg>

                    <span v-if="!collapsed">
                        Ciutkan Menu
                    </span>
                </button>
            </div>
        </aside>

        <!-- MAIN -->
        <div class="flex-1 flex flex-col min-w-0">

            <!-- Top Header -->
            <header
                class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 md:px-6 sticky top-0 z-20"
            >

                <!-- Mobile Menu -->
                <button
                    @click="mobileOpen = true"
                    class="md:hidden p-2 rounded-lg hover:bg-slate-100"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="w-5 h-5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                </button>

                <!-- Desktop Page Header -->
                <div class="hidden md:block">
                    <slot name="header" />
                </div>

                <!-- Right Side -->
                <div class="flex items-center gap-2 ml-auto">

                    <NotificationBell />

                    <Dropdown
                        align="right"
                        width="48"
                    >
                        <template #trigger>
                            <button
                                class="flex items-center gap-2 px-2 py-1.5 rounded-lg hover:bg-slate-50"
                            >
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-50 text-blue-700 flex items-center justify-center text-xs font-semibold"
                                >
                                    {{ user.name.charAt(0).toUpperCase() }}
                                </div>

                                <span
                                    class="text-sm text-slate-700 hidden sm:block"
                                >
                                    {{ user.name }}
                                </span>
                            </button>
                        </template>

                        <template #content>
                            <DropdownLink
                                :href="route('profile.edit')"
                            >
                                Profil
                            </DropdownLink>

                            <DropdownLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Keluar
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </div>
            </header>

            <!-- Mobile Page Header -->
            <div
                class="md:hidden px-4 pt-4"
            >
                <slot name="header" />
            </div>

            <!-- Page Content -->
            <main class="flex-1">
                <slot />
            </main>

        </div>
    </div>
</template>