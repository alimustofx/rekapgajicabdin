<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ConfirmDialog from '@/Components/ConfirmDialog.vue';
import { ref } from 'vue';

defineProps({
    period: Object,
    pns: Object,
    pppk: Object,
});

const confirmType = ref(null);

function noChange(type) {
    confirmType.value = type;
}

function doNoChange() {
    router.post(
        route('change-submissions.no-change', confirmType.value)
    );

    confirmType.value = null;
}

const label = {
    NO_CHANGE: 'Tidak Ada Perubahan',
    SUBMITTED: 'Sudah Dilaporkan',
    PROCESSED: 'Sudah Diproses Cabdin',
};
</script>

<template>
    <Head title="Pengajuan Perubahan Gaji" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h2
                        class="text-xl font-bold tracking-tight text-slate-900"
                    >
                        Pengajuan Perubahan Gaji
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Laporkan perubahan data gaji pegawai sebelum diproses
                        oleh Cabang Dinas.
                    </p>
                </div>

                <div
                    v-if="period"
                    class="hidden sm:flex items-center gap-2 rounded-xl border border-blue-100 bg-blue-50 px-3.5 py-2"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="w-4 h-4 text-[#28558f]"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8 2v4M16 2v4M3.5 9h17"
                        />
                        <rect
                            x="3.5"
                            y="4"
                            width="17"
                            height="17"
                            rx="2.5"
                        />
                    </svg>

                    <span class="text-xs font-semibold text-[#28558f]">
                        {{ period.label }}
                    </span>
                </div>
            </div>
        </template>

        <div class="min-h-full bg-slate-50/70 py-6 sm:py-8">
            <div
                class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8"
            >

                <!-- Mobile Period -->
                <div
                    v-if="period"
                    class="sm:hidden mb-5 flex items-center gap-3 rounded-2xl border border-blue-100 bg-white px-4 py-3 shadow-sm"
                >
                    <div
                        class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center shrink-0"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="w-4 h-4 text-[#28558f]"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 2v4M16 2v4M3.5 9h17"
                            />
                            <rect
                                x="3.5"
                                y="4"
                                width="17"
                                height="17"
                                rx="2.5"
                            />
                        </svg>
                    </div>

                    <div>
                        <p
                            class="text-[10px] font-semibold uppercase tracking-wider text-slate-400"
                        >
                            Periode Aktif
                        </p>

                        <p
                            class="text-sm font-semibold text-slate-800"
                        >
                            {{ period.label }}
                        </p>
                    </div>
                </div>

                <!-- Intro -->
                <div class="mb-6">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-50 border border-amber-100 text-amber-700 text-xs font-semibold"
                    >
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-amber-500"
                        ></span>

                        Pelaporan Perubahan
                    </div>

                    <h1
                        class="mt-3 text-2xl sm:text-3xl font-bold tracking-tight text-slate-950"
                    >
                        Perubahan Data Gaji
                    </h1>

                    <p
                        class="mt-2 text-sm leading-6 text-slate-500 max-w-2xl"
                    >
                        Laporkan perubahan data gaji pegawai seperti kenaikan
                        pangkat, gaji berkala, perubahan tunjangan, atau
                        perubahan data lainnya kepada Cabang Dinas.
                    </p>
                </div>

                <!-- Period Information -->
                <div
                    class="mb-6 rounded-2xl border border-blue-100 bg-blue-50/70 px-5 py-4 sm:px-6"
                >
                    <div class="flex items-start gap-3">
                        <div
                            class="w-9 h-9 rounded-xl bg-white border border-blue-100 flex items-center justify-center shrink-0"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="w-5 h-5 text-[#28558f]"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 8v4l2.5 2.5"
                                />
                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9"
                                />
                            </svg>
                        </div>

                        <div>
                            <p
                                class="text-sm font-semibold text-slate-800"
                            >
                                Periode Pengajuan
                            </p>

                            <p
                                class="mt-0.5 text-xs leading-5 text-slate-500"
                            >
                                {{ period?.label ?? 'Belum Ada Periode' }}
                                — Pastikan perubahan data dilaporkan sebelum
                                proses ZIP gaji dilakukan oleh Cabdin.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Submission Cards -->
                <div class="space-y-4">

                    <!-- PNS -->
                    <div
                        class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition-all duration-200 hover:shadow-md"
                    >
                        <div
                            class="absolute -right-8 -top-8 h-28 w-28 rounded-full bg-blue-50"
                        ></div>

                        <div class="relative p-5 sm:p-6">
                            <div
                                class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5"
                            >
                                <!-- Left -->
                                <div
                                    class="flex items-start gap-4 min-w-0"
                                >
                                    <div
                                        class="w-11 h-11 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="w-5 h-5 text-[#28558f]"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                                            />
                                            <circle
                                                cx="9"
                                                cy="7"
                                                r="4"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                            />
                                        </svg>
                                    </div>

                                    <div class="min-w-0">
                                        <div
                                            class="flex flex-wrap items-center gap-2"
                                        >
                                            <h3
                                                class="text-base font-bold text-slate-900"
                                            >
                                                PNS
                                            </h3>

                                            <span
                                                v-if="pns"
                                                class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-1.5 text-[10px] font-semibold"
                                                :class="
                                                    pns.status === 'NO_CHANGE'
                                                        ? 'bg-slate-100 text-slate-500 ring-1 ring-inset ring-slate-500/10'
                                                        : pns.status === 'PROCESSED'
                                                            ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/10'
                                                            : 'bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-600/10'
                                                "
                                            >
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full bg-current opacity-70"
                                                ></span>

                                                {{
                                                    label[pns.status] ??
                                                    pns.status
                                                }}
                                            </span>

                                            <span
                                                v-else
                                                class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-2.5 py-1.5 text-[10px] font-semibold text-amber-700 ring-1 ring-inset ring-amber-600/10"
                                            >
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full bg-current opacity-70"
                                                ></span>

                                                Belum Dilaporkan
                                            </span>
                                        </div>

                                        <p
                                            class="mt-1.5 text-xs leading-5 text-slate-500"
                                        >
                                            Perubahan data gaji pegawai
                                            berstatus PNS.
                                        </p>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div
                                    v-if="!pns"
                                    class="flex flex-col sm:flex-row gap-2 lg:shrink-0"
                                >
                                    <button
                                        @click="noChange('PNS')"
                                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-600 hover:text-slate-800 px-4 py-2.5 text-xs font-semibold transition-colors"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="w-4 h-4"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 12h14"
                                            />
                                        </svg>

                                        Tidak Ada Perubahan
                                    </button>

                                    <Link
                                        :href="
                                            route(
                                                'change-submissions.create',
                                                'PNS'
                                            )
                                        "
                                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#28558f] hover:bg-[#1f4678] text-white px-4 py-2.5 text-xs font-semibold shadow-sm hover:shadow-md transition-all duration-200"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="w-4 h-4"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 5v14M5 12h14"
                                            />
                                        </svg>

                                        Lapor Perubahan
                                    </Link>
                                </div>

                                <div
                                    v-else
                                    class="hidden sm:flex items-center gap-2 text-xs text-slate-400"
                                >
                                    <span
                                        class="w-1.5 h-1.5 rounded-full bg-emerald-500"
                                    ></span>

                                    Pengajuan sudah tercatat
                                </div>
                            </div>

                            <div
                                class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between"
                            >
                                <span
                                    class="text-[11px] text-slate-400"
                                >
                                    Data perubahan PNS diproses berdasarkan
                                    periode aktif.
                                </span>

                                <span
                                    class="text-[10px] font-bold uppercase tracking-wider text-slate-300"
                                >
                                    PNS
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- PPPK -->
                    <div
                        class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition-all duration-200 hover:shadow-md"
                    >
                        <div
                            class="absolute -right-8 -top-8 h-28 w-28 rounded-full bg-indigo-50"
                        ></div>

                        <div class="relative p-5 sm:p-6">
                            <div
                                class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5"
                            >
                                <!-- Left -->
                                <div
                                    class="flex items-start gap-4 min-w-0"
                                >
                                    <div
                                        class="w-11 h-11 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center shrink-0"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="w-5 h-5 text-indigo-600"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                                            />
                                            <circle
                                                cx="9"
                                                cy="7"
                                                r="4"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                            />
                                        </svg>
                                    </div>

                                    <div class="min-w-0">
                                        <div
                                            class="flex flex-wrap items-center gap-2"
                                        >
                                            <h3
                                                class="text-base font-bold text-slate-900"
                                            >
                                                PPPK
                                            </h3>

                                            <span
                                                v-if="pppk"
                                                class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-1.5 text-[10px] font-semibold"
                                                :class="
                                                    pppk.status === 'NO_CHANGE'
                                                        ? 'bg-slate-100 text-slate-500 ring-1 ring-inset ring-slate-500/10'
                                                        : pppk.status === 'PROCESSED'
                                                            ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/10'
                                                            : 'bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-600/10'
                                                "
                                            >
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full bg-current opacity-70"
                                                ></span>

                                                {{
                                                    label[pppk.status] ??
                                                    pppk.status
                                                }}
                                            </span>

                                            <span
                                                v-else
                                                class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-2.5 py-1.5 text-[10px] font-semibold text-amber-700 ring-1 ring-inset ring-amber-600/10"
                                            >
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full bg-current opacity-70"
                                                ></span>

                                                Belum Dilaporkan
                                            </span>
                                        </div>

                                        <p
                                            class="mt-1.5 text-xs leading-5 text-slate-500"
                                        >
                                            Perubahan data gaji pegawai
                                            berstatus PPPK.
                                        </p>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div
                                    v-if="!pppk"
                                    class="flex flex-col sm:flex-row gap-2 lg:shrink-0"
                                >
                                    <button
                                        @click="noChange('PPPK')"
                                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-600 hover:text-slate-800 px-4 py-2.5 text-xs font-semibold transition-colors"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="w-4 h-4"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 12h14"
                                            />
                                        </svg>

                                        Tidak Ada Perubahan
                                    </button>

                                    <Link
                                        :href="
                                            route(
                                                'change-submissions.create',
                                                'PPPK'
                                            )
                                        "
                                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#28558f] hover:bg-[#1f4678] text-white px-4 py-2.5 text-xs font-semibold shadow-sm hover:shadow-md transition-all duration-200"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="w-4 h-4"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 5v14M5 12h14"
                                            />
                                        </svg>

                                        Lapor Perubahan
                                    </Link>
                                </div>

                                <div
                                    v-else
                                    class="hidden sm:flex items-center gap-2 text-xs text-slate-400"
                                >
                                    <span
                                        class="w-1.5 h-1.5 rounded-full bg-emerald-500"
                                    ></span>

                                    Pengajuan sudah tercatat
                                </div>
                            </div>

                            <div
                                class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between"
                            >
                                <span
                                    class="text-[11px] text-slate-400"
                                >
                                    Data perubahan PPPK diproses berdasarkan
                                    periode aktif.
                                </span>

                                <span
                                    class="text-[10px] font-bold uppercase tracking-wider text-slate-300"
                                >
                                    PPPK
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Information / Security Note -->
                <div
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
                        Pastikan setiap perubahan data diisi berdasarkan
                        dokumen resmi. Pengajuan yang sudah dikirim akan
                        diteruskan kepada Cabang Dinas untuk diproses.
                    </p>
                </div>

            </div>
        </div>
        <ConfirmDialog
            :show="!!confirmType"
            title="Konfirmasi"
            :message="`Konfirmasi tidak ada perubahan gaji ${confirmType} bulan ini?`"
            @confirm="doNoChange"
            @cancel="confirmType = null"
        />
    </AuthenticatedLayout>
</template>