<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import ConfirmDialog from '@/Components/ConfirmDialog.vue';
import { ref } from 'vue';

const props = defineProps({
    submission: Object,
});

const confirmProcess = ref(false);

function proses() {
    confirmProcess.value = true;
}

function doProcess() {
    useForm({}).post(
        route('admin-changes.process', props.submission.id),
        {
            onSuccess: () => {
                confirmProcess.value = false;
            },
        }
    );
}

const statusLabel = {
    NO_CHANGE: 'Tidak Ada Perubahan',
    SUBMITTED: 'Sudah Lapor',
    PROCESSED: 'Sudah Diproses',
};

const statusClass = {
    NO_CHANGE:
        'bg-slate-100 text-slate-600 ring-1 ring-inset ring-slate-500/10',
    SUBMITTED:
        'bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-600/10',
    PROCESSED:
        'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/10',
};

const typeLabel = {
    PNS: 'PNS',
    PPPK: 'PPPK',
};
</script>

<template>
    <Head title="Detail Pengajuan Perubahan Gaji" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between gap-4">
                <div class="min-w-0">
                    <h2
                        class="text-xl font-bold tracking-tight text-slate-900 truncate"
                    >
                        Detail Pengajuan Perubahan Gaji
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 truncate">
                        {{ submission.school?.official_name }}
                    </p>
                </div>

                <div
                    class="hidden sm:flex items-center gap-2 rounded-xl border border-blue-100 bg-blue-50 px-3 py-2 shrink-0"
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
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 5a3 3 0 006 0"
                        />
                    </svg>

                    <span class="text-xs font-semibold text-[#28558f]">
                        {{ typeLabel[submission.type] ?? submission.type }}
                    </span>
                </div>
            </div>
        </template>

        <div class="min-h-full bg-slate-50/70 py-6 sm:py-8">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

                <!-- Mobile Type -->
                <div
                    class="sm:hidden flex items-center gap-3 rounded-2xl border border-blue-100 bg-white px-4 py-3 shadow-sm"
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
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 5a3 3 0 006 0"
                            />
                        </svg>
                    </div>

                    <div>
                        <p
                            class="text-[10px] font-semibold uppercase tracking-wider text-slate-400"
                        >
                            Jenis Pengajuan
                        </p>

                        <p class="text-sm font-semibold text-slate-800">
                            {{ typeLabel[submission.type] ?? submission.type }}
                        </p>
                    </div>
                </div>


                <!-- Submission Summary -->
                <div
                    class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
                >
                    <div
                        class="border-b border-slate-100 px-5 py-5 sm:px-6"
                    >
                        <div
                            class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
                        >
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#28558f]"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="h-5 w-5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 21h18M5 21V9l7-5 7 5v12"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            d="M9 21v-6h6v6"
                                        />
                                    </svg>
                                </div>

                                <div class="min-w-0">
                                    <h3
                                        class="text-base font-bold text-slate-900"
                                    >
                                        {{ submission.school?.official_name }}
                                    </h3>

                                    <p
                                        class="mt-1 text-xs text-slate-500"
                                    >
                                        Pengajuan perubahan gaji
                                        {{ typeLabel[submission.type] ?? submission.type }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-2">
                                <span
                                    class="inline-flex items-center rounded-lg px-2.5 py-1.5 text-[11px] font-semibold"
                                    :class="
                                        statusClass[submission.status]
                                        ?? 'bg-amber-50 text-amber-700'
                                    "
                                >
                                    <span
                                        class="mr-1.5 h-1.5 w-1.5 rounded-full bg-current opacity-70"
                                    ></span>

                                    {{
                                        statusLabel[submission.status]
                                        ?? submission.status
                                    }}
                                </span>

                                <button
                                    v-if="submission.status === 'SUBMITTED'"
                                    @click="proses"
                                    class="inline-flex items-center gap-1.5 rounded-lg bg-[#28558f] px-3 py-2 text-[11px] font-semibold text-white shadow-sm transition hover:bg-[#214875]"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="h-3.5 w-3.5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 12l4 4L19 6"
                                        />
                                    </svg>

                                    Tandai Sudah Diproses
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Information -->
                    <div
                        class="grid grid-cols-1 divide-y divide-slate-100 sm:grid-cols-3 sm:divide-x sm:divide-y-0"
                    >
                        <div class="px-5 py-4 sm:px-6">
                            <p
                                class="text-[10px] font-bold uppercase tracking-wider text-slate-400"
                            >
                                Jenis
                            </p>

                            <p
                                class="mt-1.5 text-sm font-semibold text-slate-800"
                            >
                                {{ typeLabel[submission.type] ?? submission.type }}
                            </p>
                        </div>

                        <div class="px-5 py-4 sm:px-6">
                            <p
                                class="text-[10px] font-bold uppercase tracking-wider text-slate-400"
                            >
                                Jumlah Pegawai
                            </p>

                            <p
                                class="mt-1.5 text-sm font-semibold text-slate-800"
                            >
                                {{ submission.items?.length ?? 0 }}
                                <span
                                    class="text-xs font-medium text-slate-400"
                                >
                                    pegawai
                                </span>
                            </p>
                        </div>

                        <div class="px-5 py-4 sm:px-6">
                            <p
                                class="text-[10px] font-bold uppercase tracking-wider text-slate-400"
                            >
                                Status
                            </p>

                            <p
                                class="mt-1.5 text-sm font-semibold text-slate-800"
                            >
                                {{
                                    statusLabel[submission.status]
                                    ?? submission.status
                                }}
                            </p>
                        </div>
                    </div>
                </div>


                <!-- No Change -->
                <div
                    v-if="submission.items.length === 0"
                    class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
                >
                    <div class="px-6 py-12 text-center">
                        <div
                            class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.7"
                                class="h-7 w-7 text-slate-400"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 12h14"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 5v14"
                                />
                            </svg>
                        </div>

                        <h4
                            class="mt-4 text-sm font-semibold text-slate-800"
                        >
                            Tidak Ada Perubahan
                        </h4>

                        <p
                            class="mx-auto mt-1 max-w-md text-xs leading-5 text-slate-500"
                        >
                            Operator sekolah telah mengonfirmasi bahwa tidak
                            terdapat perubahan data gaji untuk
                            {{ typeLabel[submission.type] ?? submission.type }}
                            pada periode ini.
                        </p>
                    </div>
                </div>


                <!-- Change Items -->
                <div
                    v-else
                    class="space-y-4"
                >
                    <div
                        class="flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between"
                    >
                        <div>
                            <h3 class="text-base font-bold text-slate-900">
                                Daftar Perubahan
                            </h3>

                            <p class="mt-1 text-xs text-slate-500">
                                Detail perubahan data dan dokumen SK setiap pegawai.
                            </p>
                        </div>

                        <span
                            class="inline-flex w-fit items-center rounded-lg bg-slate-100 px-2.5 py-1.5 text-[10px] font-semibold text-slate-500"
                        >
                            {{ submission.items.length }} pegawai
                        </span>
                    </div>


                    <!-- Employee Card -->
                    <div
                        v-for="(item, index) in submission.items"
                        :key="item.id"
                        class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
                    >
                        <!-- Employee Header -->
                        <div
                            class="border-b border-slate-100 px-5 py-5 sm:px-6"
                        >
                            <div
                                class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between"
                            >
                                <div class="flex items-start gap-3">
                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-sm font-bold text-[#28558f]"
                                    >
                                        {{ index + 1 }}
                                    </div>

                                    <div class="min-w-0">
                                        <p
                                            class="font-bold text-slate-900"
                                        >
                                            {{ item.nama }}
                                        </p>

                                        <p
                                            class="mt-1 text-xs text-slate-500"
                                        >
                                            NIP
                                            <span class="font-medium text-slate-700">
                                                {{ item.nip }}
                                            </span>

                                            <span class="mx-1 text-slate-300">
                                                —
                                            </span>

                                            {{ item.kategori }}
                                        </p>
                                    </div>
                                </div>

                                <a
                                    :href="
                                        route(
                                            'admin-changes.item.download',
                                            item.id
                                        )
                                    "
                                    class="inline-flex w-fit items-center gap-1.5 rounded-lg border border-blue-100 bg-blue-50 px-3 py-2 text-[11px] font-semibold text-[#28558f] transition hover:border-blue-200 hover:bg-blue-100"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="h-3.5 w-3.5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 3v12m0 0l-4-4m4 4l4-4M5 21h14"
                                        />
                                    </svg>

                                    Download SK
                                </a>
                            </div>
                        </div>


                        <!-- Old vs New -->
                        <div class="p-5 sm:p-6">
                            <div
                                class="grid grid-cols-1 gap-4 lg:grid-cols-2"
                            >
                                <!-- Lama -->
                                <div
                                    class="rounded-xl border border-slate-200 bg-slate-50/70 p-4"
                                >
                                    <div
                                        class="flex items-center gap-2 mb-4"
                                    >
                                        <div
                                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-200 text-slate-500"
                                        >
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                class="h-4 w-4"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M4 6h16M4 12h16M4 18h10"
                                                />
                                            </svg>
                                        </div>

                                        <div>
                                            <p
                                                class="text-[10px] font-bold uppercase tracking-wider text-slate-400"
                                            >
                                                Data Lama
                                            </p>

                                            <p
                                                class="text-xs font-semibold text-slate-700"
                                            >
                                                Sebelum perubahan
                                            </p>
                                        </div>
                                    </div>

                                    <div class="space-y-3 text-xs">
                                        <div
                                            class="flex items-center justify-between gap-4 border-b border-slate-200 pb-2"
                                        >
                                            <span class="text-slate-500">
                                                Golongan
                                            </span>

                                            <span
                                                class="font-semibold text-slate-800 text-right"
                                            >
                                                {{ item.gol_lama || '-' }}
                                            </span>
                                        </div>

                                        <div
                                            class="flex items-center justify-between gap-4 border-b border-slate-200 pb-2"
                                        >
                                            <span class="text-slate-500">
                                                Anak
                                            </span>

                                            <span
                                                class="font-semibold text-slate-800 text-right"
                                            >
                                                {{ item.anak_lama || '-' }}
                                            </span>
                                        </div>

                                        <div
                                            class="flex items-center justify-between gap-4 border-b border-slate-200 pb-2"
                                        >
                                            <span class="text-slate-500">
                                                Gaji Pokok
                                            </span>

                                            <span
                                                class="font-semibold text-slate-800 text-right"
                                            >
                                                {{ item.gaji_pokok_lama || '-' }}
                                            </span>
                                        </div>

                                        <div
                                            class="flex items-center justify-between gap-4 border-b border-slate-200 pb-2"
                                        >
                                            <span class="text-slate-500">
                                                Tunj. Struktural
                                            </span>

                                            <span
                                                class="font-semibold text-slate-800 text-right"
                                            >
                                                {{ item.tunj_struktural_lama || '-' }}
                                            </span>
                                        </div>

                                        <div
                                            class="flex items-center justify-between gap-4 border-b border-slate-200 pb-2"
                                        >
                                            <span class="text-slate-500">
                                                Tunj. Fungsional
                                            </span>

                                            <span
                                                class="font-semibold text-slate-800 text-right"
                                            >
                                                {{ item.tunj_fungsional_lama || '-' }}
                                            </span>
                                        </div>

                                        <div
                                            class="flex items-center justify-between gap-4"
                                        >
                                            <span class="text-slate-500">
                                                Masa Kerja
                                            </span>

                                            <span
                                                class="font-semibold text-slate-800 text-right"
                                            >
                                                {{ item.masa_kerja_lama || '-' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>


                                <!-- Baru -->
                                <div
                                    class="rounded-xl border border-emerald-100 bg-emerald-50/40 p-4"
                                >
                                    <div
                                        class="flex items-center gap-2 mb-4"
                                    >
                                        <div
                                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600"
                                        >
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                class="h-4 w-4"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M5 12l4 4L19 6"
                                                />
                                            </svg>
                                        </div>

                                        <div>
                                            <p
                                                class="text-[10px] font-bold uppercase tracking-wider text-emerald-600/70"
                                            >
                                                Data Baru
                                            </p>

                                            <p
                                                class="text-xs font-semibold text-emerald-800"
                                            >
                                                Setelah perubahan
                                            </p>
                                        </div>
                                    </div>

                                    <div class="space-y-3 text-xs">
                                        <div
                                            class="flex items-center justify-between gap-4 border-b border-emerald-100 pb-2"
                                        >
                                            <span class="text-slate-500">
                                                Golongan
                                            </span>

                                            <span
                                                class="font-semibold text-slate-800 text-right"
                                            >
                                                {{ item.gol_baru || '-' }}
                                            </span>
                                        </div>

                                        <div
                                            class="flex items-center justify-between gap-4 border-b border-emerald-100 pb-2"
                                        >
                                            <span class="text-slate-500">
                                                Anak
                                            </span>

                                            <span
                                                class="font-semibold text-slate-800 text-right"
                                            >
                                                {{ item.anak_baru || '-' }}
                                            </span>
                                        </div>

                                        <div
                                            class="flex items-center justify-between gap-4 border-b border-emerald-100 pb-2"
                                        >
                                            <span class="text-slate-500">
                                                Gaji Pokok
                                            </span>

                                            <span
                                                class="font-semibold text-emerald-700 text-right"
                                            >
                                                {{ item.gaji_pokok_baru || '-' }}
                                            </span>
                                        </div>

                                        <div
                                            class="flex items-center justify-between gap-4 border-b border-emerald-100 pb-2"
                                        >
                                            <span class="text-slate-500">
                                                Tunj. Struktural
                                            </span>

                                            <span
                                                class="font-semibold text-slate-800 text-right"
                                            >
                                                {{ item.tunj_struktural_baru || '-' }}
                                            </span>
                                        </div>

                                        <div
                                            class="flex items-center justify-between gap-4 border-b border-emerald-100 pb-2"
                                        >
                                            <span class="text-slate-500">
                                                Tunj. Fungsional
                                            </span>

                                            <span
                                                class="font-semibold text-slate-800 text-right"
                                            >
                                                {{ item.tunj_fungsional_baru || '-' }}
                                            </span>
                                        </div>

                                        <div
                                            class="flex items-center justify-between gap-4"
                                        >
                                            <span class="text-slate-500">
                                                Masa Kerja
                                            </span>

                                            <span
                                                class="font-semibold text-slate-800 text-right"
                                            >
                                                {{ item.masa_kerja_baru || '-' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Status Information -->
                <div
                    class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                >
                    <div class="flex items-start gap-3">
                        <div
                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-slate-100"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="h-4 w-4 text-slate-500"
                            >
                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9"
                                />
                                <path
                                    stroke-linecap="round"
                                    d="M12 11v5M12 8h.01"
                                />
                            </svg>
                        </div>

                        <div>
                            <p
                                class="text-sm font-semibold text-slate-800"
                            >
                                Informasi Status
                            </p>

                            <p
                                v-if="submission.status === 'SUBMITTED'"
                                class="mt-1 text-xs leading-5 text-slate-500"
                            >
                                Pengajuan telah dikirim oleh operator dan
                                menunggu diproses oleh admin.
                            </p>

                            <p
                                v-else-if="submission.status === 'PROCESSED'"
                                class="mt-1 text-xs leading-5 text-slate-500"
                            >
                                Pengajuan telah ditandai selesai diproses oleh
                                admin.
                            </p>

                            <p
                                v-else-if="submission.status === 'NO_CHANGE'"
                                class="mt-1 text-xs leading-5 text-slate-500"
                            >
                                Sekolah telah mengonfirmasi tidak ada perubahan
                                data gaji.
                            </p>

                            <p
                                v-else
                                class="mt-1 text-xs leading-5 text-slate-500"
                            >
                                Status pengajuan saat ini:
                                {{ submission.status }}.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <ConfirmDialog
            :show="confirmProcess"
            title="Konfirmasi Proses"
            message="Apakah Anda yakin pengajuan ini sudah diproses?"
            confirmText="Ya, Tandai Sudah Diproses"
            @confirm="doProcess"
            @cancel="confirmProcess = false"
        />
    </AuthenticatedLayout>
</template>