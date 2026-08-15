<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    requests: Array,
});
</script>

<template>
    <Head title="Permintaan Perbaikan" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold tracking-tight text-slate-900">
                        Permintaan Perbaikan
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Tinjau dan tindak lanjuti permintaan perbaikan dokumen
                        dari operator sekolah.
                    </p>
                </div>

                <div
                    v-if="requests.length > 0"
                    class="hidden sm:flex items-center gap-2 rounded-xl bg-amber-50 border border-amber-100 px-3.5 py-2"
                >
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>

                    <span class="text-sm font-semibold text-amber-700">
                        {{ requests.length }} menunggu
                    </span>
                </div>
            </div>
        </template>

        <div class="min-h-[calc(100vh-65px)] bg-slate-50/70">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">

                <!-- Intro -->
                <div class="mb-6">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-50 border border-amber-100 text-amber-700 text-xs font-semibold"
                    >
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-amber-500"
                        ></span>

                        Membutuhkan Tindakan
                    </div>

                    <h1
                        class="mt-3 text-2xl sm:text-3xl font-bold tracking-tight text-slate-950"
                    >
                        Daftar Permintaan Perbaikan
                    </h1>

                    <p
                        class="mt-2 text-sm leading-6 text-slate-500 max-w-2xl"
                    >
                        Periksa permintaan dari sekolah dan lakukan verifikasi
                        sebelum dokumen dapat diproses kembali.
                    </p>
                </div>

                <!-- Empty State -->
                <div
                    v-if="requests.length === 0"
                    class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden"
                >
                    <div
                        class="flex flex-col items-center justify-center text-center px-6 py-16 sm:py-20"
                    >
                        <div
                            class="w-16 h-16 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="w-8 h-8 text-emerald-600"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                        </div>

                        <h3
                            class="mt-5 text-base font-bold text-slate-900"
                        >
                            Tidak ada permintaan perbaikan
                        </h3>

                        <p
                            class="mt-2 text-sm leading-6 text-slate-500 max-w-md"
                        >
                            Semua permintaan sudah ditindaklanjuti. Saat ini
                            tidak ada dokumen yang menunggu perbaikan.
                        </p>
                    </div>
                </div>

                <!-- Request List -->
                <div v-else class="space-y-4">

                    <Link
                        v-for="(r, index) in requests"
                        :key="r.id"
                        :href="route('revisions.show', r.id)"
                        class="group block bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md hover:border-blue-200 transition-all duration-200 overflow-hidden"
                    >
                        <div class="p-5 sm:p-6">

                            <div
                                class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4"
                            >

                                <!-- Left -->
                                <div
                                    class="flex items-start gap-4 min-w-0"
                                >
                                    <!-- Number -->
                                    <div
                                        class="w-11 h-11 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center shrink-0 group-hover:bg-blue-50 group-hover:border-blue-100 transition-colors"
                                    >
                                        <span
                                            class="text-sm font-bold text-slate-500 group-hover:text-[#28558f]"
                                        >
                                            {{
                                                String(index + 1).padStart(
                                                    2,
                                                    '0'
                                                )
                                            }}
                                        </span>
                                    </div>

                                    <div class="min-w-0">
                                        <!-- School + Type -->
                                        <div
                                            class="flex flex-wrap items-center gap-2"
                                        >
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-blue-50 border border-blue-100 text-[11px] font-semibold text-[#28558f]"
                                            >
                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                    class="w-3.5 h-3.5"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-4h6v4M9 10h.01M12 10h.01M15 10h.01M9 13h.01M12 13h.01M15 13h.01"
                                                    />
                                                </svg>

                                                {{ r.type }}
                                            </span>

                                            <span
                                                class="text-xs text-slate-400"
                                            >
                                                Permintaan #{{ r.id }}
                                            </span>
                                        </div>

                                        <h3
                                            class="mt-2 text-sm sm:text-base font-bold text-slate-900 group-hover:text-[#28558f] transition-colors"
                                        >
                                            {{ r.school.official_name }}
                                        </h3>

                                        <!-- Category -->
                                        <div
                                            class="mt-2 flex items-start gap-2"
                                        >
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                class="w-4 h-4 text-slate-400 shrink-0 mt-0.5"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M9 12h6m-6 4h4M7 3h7l4 4v14H7V3z"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M14 3v5h5"
                                                />
                                            </svg>

                                            <p
                                                class="text-sm text-slate-600"
                                            >
                                                <span class="font-semibold text-slate-700">
                                                    {{ r.category }}
                                                </span>

                                                <span class="text-slate-400">
                                                    —
                                                </span>

                                                {{ r.description }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right -->
                                <div
                                    class="flex items-center justify-between sm:justify-end gap-3 sm:shrink-0"
                                >
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-amber-50 border border-amber-100 text-xs font-semibold text-amber-700"
                                    >
                                        <span
                                            class="w-1.5 h-1.5 rounded-full bg-amber-500"
                                        ></span>

                                        Menunggu
                                    </span>

                                    <div
                                        class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-slate-400 group-hover:border-blue-200 group-hover:text-[#28558f] transition-colors"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            class="w-4 h-4"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 12h14m-6-6l6 6-6 6"
                                            />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Bottom Hint -->
                            <div
                                class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between"
                            >
                                <span class="text-xs text-slate-400">
                                    Klik untuk melihat detail permintaan
                                </span>

                                <span
                                    class="text-xs font-semibold text-[#28558f] opacity-0 group-hover:opacity-100 transition-opacity"
                                >
                                    Lihat detail
                                </span>
                            </div>

                        </div>
                    </Link>

                </div>

                <!-- Security / Info -->
                <div
                    v-if="requests.length > 0"
                    class="mt-6 flex items-start gap-3 px-1"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="w-4 h-4 text-slate-400 shrink-0 mt-0.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3l7 3v5c0 4.5-2.8 7.7-7 10-4.2-2.3-7-5.5-7-10V6l7-3z"
                        />
                    </svg>

                    <p class="text-xs leading-5 text-slate-400">
                        Pastikan setiap permintaan diperiksa berdasarkan
                        dokumen dan keterangan yang diberikan sebelum
                        dilakukan verifikasi.
                    </p>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>