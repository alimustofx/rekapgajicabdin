<script setup>
import { usePage, router } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';

const page = usePage();
const open = ref(false);
const root = ref(null);

function handleClickOutside(e) {
    if (root.value && !root.value.contains(e.target)) {
        open.value = false;
    }
}

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside);
});

function toggle() {
    open.value = !open.value;
}

function bacaSemua() {
    router.post(
        route('notifications.read-all'),
        {},
        {
            preserveScroll: true,
        }
    );
}
</script>

<template>
    <div class="relative" ref="root">
        <!-- Notification Button -->
        <button
            @click="toggle"
            class="group relative flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 shadow-sm transition-all duration-200 hover:border-slate-300 hover:bg-slate-50 hover:text-slate-700 hover:shadow"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-[19px] w-[19px] transition-transform duration-200 group-hover:scale-105"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                />
            </svg>

            <!-- Unread Badge -->
            <span
                v-if="page.props.notifications.unread_count > 0"
                class="absolute -right-1 -top-1 flex min-h-[18px] min-w-[18px] items-center justify-center rounded-full border-2 border-white bg-red-500 px-1 text-[9px] font-bold leading-none text-white shadow-sm"
            >
                {{ page.props.notifications.unread_count }}
            </span>
        </button>

        <!-- Dropdown -->
        <Transition
            enter-active-class="transition duration-150 ease-out"
            enter-from-class="translate-y-1 opacity-0 scale-[0.98]"
            enter-to-class="translate-y-0 opacity-100 scale-100"
            leave-active-class="transition duration-100 ease-in"
            leave-from-class="translate-y-0 opacity-100 scale-100"
            leave-to-class="translate-y-1 opacity-0 scale-[0.98]"
        >
            <div
                v-if="open"
                class="absolute right-0 z-50 mt-3 w-[360px] overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-[0_15px_45px_-15px_rgba(15,23,42,0.25)]"
            >
                <!-- Header -->
                <div
                    class="flex items-center justify-between border-b border-slate-100 bg-white px-5 py-4"
                >
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-600"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4.5 w-4.5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-slate-900">
                                Notifikasi
                            </h3>

                            <p
                                v-if="page.props.notifications.unread_count > 0"
                                class="mt-0.5 text-[11px] text-slate-400"
                            >
                                {{ page.props.notifications.unread_count }}
                                notifikasi belum dibaca
                            </p>

                            <p
                                v-else
                                class="mt-0.5 text-[11px] text-slate-400"
                            >
                                Semua sudah dibaca
                            </p>
                        </div>
                    </div>

                    <button
                        @click="bacaSemua"
                        class="rounded-lg px-2.5 py-1.5 text-[11px] font-medium text-blue-600 transition hover:bg-blue-50 hover:text-blue-700"
                    >
                        Tandai semua
                    </button>
                </div>

                <!-- Notification List -->
                <div class="max-h-[380px] overflow-y-auto">
                    <!-- Empty State -->
                    <div
                        v-if="page.props.notifications.items.length === 0"
                        class="flex flex-col items-center justify-center px-6 py-12"
                    >
                        <div
                            class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5"
                                />
                            </svg>
                        </div>

                        <p class="text-sm font-medium text-slate-600">
                            Tidak ada notifikasi
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            Notifikasi baru akan muncul di sini
                        </p>
                    </div>

                    <!-- Items -->
                    <div
                        v-for="n in page.props.notifications.items"
                        :key="n.id"
                        class="group relative flex gap-3 border-b border-slate-100 px-5 py-4 transition-colors last:border-0"
                        :class="
                            !n.read_at
                                ? 'bg-blue-50/60 hover:bg-blue-50'
                                : 'bg-white hover:bg-slate-50'
                        "
                    >
                        <!-- Unread Indicator -->
                        <div class="pt-1.5">
                            <span
                                class="block h-2 w-2 rounded-full"
                                :class="
                                    !n.read_at
                                        ? 'bg-blue-500'
                                        : 'bg-slate-200'
                                "
                            ></span>
                        </div>

                        <!-- Content -->
                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-3">
                                <p
                                    class="text-sm leading-5"
                                    :class="
                                        !n.read_at
                                            ? 'font-semibold text-slate-900'
                                            : 'font-medium text-slate-700'
                                    "
                                >
                                    {{ n.title }}
                                </p>
                            </div>

                            <p
                                class="mt-1 text-xs leading-5 text-slate-500"
                            >
                                {{ n.message }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div
                    v-if="page.props.notifications.items.length > 0"
                    class="border-t border-slate-100 bg-slate-50/70 px-5 py-2.5"
                >
                    <p class="text-center text-[10px] font-medium uppercase tracking-wide text-slate-400">
                        Notifikasi terbaru
                    </p>
                </div>
            </div>
        </Transition>
    </div>
</template>