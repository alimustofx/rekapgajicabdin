<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    period: Object,
    rows: Array,
});

const label = {
    NO_CHANGE: 'Tidak Ada Perubahan',
    SUBMITTED: 'Sudah Lapor',
    PROCESSED: 'Sudah Diproses',
};

const color = (submission) => {
    const status = submission?.status;

    return {
        NO_CHANGE:
            'bg-slate-100 text-slate-600 ring-1 ring-inset ring-slate-500/10',

        SUBMITTED:
            'bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-600/10',

        PROCESSED:
            'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/10',
    }[status] ?? 'bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-600/10';
};

const statusLabel = (submission) => {
    if (!submission) {
        return 'Belum Lapor';
    }

    return label[submission.status] ?? submission.status;
};

const statusColor = (submission) => {
    if (!submission) {
        return 'bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-600/10';
    }

    return color(submission);
};

const totalSchools = () => {
    return props.rows?.length ?? 0;
};

const totalPnsReported = () => {
    return (
        props.rows?.filter(
            (row) =>
                row.pns &&
                ['SUBMITTED', 'PROCESSED'].includes(row.pns.status)
        ).length ?? 0
    );
};

const totalPppkReported = () => {
    return (
        props.rows?.filter(
            (row) =>
                row.pppk &&
                ['SUBMITTED', 'PROCESSED'].includes(row.pppk.status)
        ).length ?? 0
    );
};

const totalProcessed = () => {
    return (
        props.rows?.reduce((total, row) => {
            return (
                total +
                (row.pns?.status === 'PROCESSED' ? 1 : 0) +
                (row.pppk?.status === 'PROCESSED' ? 1 : 0)
            );
        }, 0) ?? 0
    );
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
                        Monitoring laporan perubahan gaji PNS dan PPPK seluruh
                        sekolah.
                    </p>
                </div>

                <!-- Desktop Period -->
                <div
                    class="hidden sm:flex items-center gap-2 rounded-xl border border-blue-100 bg-blue-50 px-3 py-2"
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
                        {{ period?.label ?? 'Belum Ada Periode' }}
                    </span>
                </div>
            </div>
        </template>

        <div class="min-h-full bg-slate-50/70 py-6 sm:py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Mobile Period -->
                <div
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

                        <p class="text-sm font-semibold text-slate-800">
                            {{ period?.label ?? 'Belum Ada Periode' }}
                        </p>
                    </div>
                </div>

                <!-- Summary -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

                    <!-- Total Sekolah -->
                    <div
                        class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                    >
                        <div
                            class="absolute -right-5 -top-5 h-24 w-24 rounded-full bg-blue-50"
                        ></div>

                        <div class="relative">
                            <div
                                class="flex items-center justify-between"
                            >
                                <div
                                    class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center"
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
                                            d="M3 21h18M5 21V9l7-5 7 5v12M9 21v-6h6v6M8 10h.01M12 10h.01M16 10h.01"
                                        />
                                    </svg>
                                </div>

                                <span
                                    class="text-[10px] font-bold uppercase tracking-wider text-slate-400"
                                >
                                    Sekolah
                                </span>
                            </div>

                            <p
                                class="mt-5 text-2xl font-bold text-slate-900"
                            >
                                {{ totalSchools() }}
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                Total sekolah dalam periode
                            </p>
                        </div>
                    </div>

                    <!-- PNS -->
                    <div
                        class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                    >
                        <div
                            class="absolute -right-5 -top-5 h-24 w-24 rounded-full bg-blue-50"
                        ></div>

                        <div class="relative">
                            <div
                                class="flex items-center justify-between"
                            >
                                <div
                                    class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center"
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

                                <span
                                    class="text-[10px] font-bold uppercase tracking-wider text-slate-400"
                                >
                                    PNS
                                </span>
                            </div>

                            <p
                                class="mt-5 text-2xl font-bold text-slate-900"
                            >
                                {{ totalPnsReported() }}

                                <span
                                    class="text-sm font-medium text-slate-400"
                                >
                                    / {{ totalSchools() }}
                                </span>
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                Sekolah sudah melaporkan PNS
                            </p>
                        </div>
                    </div>

                    <!-- PPPK -->
                    <div
                        class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                    >
                        <div
                            class="absolute -right-5 -top-5 h-24 w-24 rounded-full bg-blue-50"
                        ></div>

                        <div class="relative">
                            <div
                                class="flex items-center justify-between"
                            >
                                <div
                                    class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center"
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
                                            d="M17 20h5v-2a4 4 0 00-4-4h-1"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 20H2v-2a4 4 0 014-4h3"
                                        />

                                        <circle
                                            cx="12"
                                            cy="7"
                                            r="4"
                                        />
                                    </svg>
                                </div>

                                <span
                                    class="text-[10px] font-bold uppercase tracking-wider text-slate-400"
                                >
                                    PPPK
                                </span>
                            </div>

                            <p
                                class="mt-5 text-2xl font-bold text-slate-900"
                            >
                                {{ totalPppkReported() }}

                                <span
                                    class="text-sm font-medium text-slate-400"
                                >
                                    / {{ totalSchools() }}
                                </span>
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                Sekolah sudah melaporkan PPPK
                            </p>
                        </div>
                    </div>

                    <!-- Processed -->
                    <div
                        class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                    >
                        <div
                            class="absolute -right-5 -top-5 h-24 w-24 rounded-full bg-emerald-50"
                        ></div>

                        <div class="relative">
                            <div
                                class="flex items-center justify-between"
                            >
                                <div
                                    class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="w-5 h-5 text-emerald-600"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 12l4 4L19 6"
                                        />
                                    </svg>
                                </div>

                                <span
                                    class="text-[10px] font-bold uppercase tracking-wider text-slate-400"
                                >
                                    Diproses
                                </span>
                            </div>

                            <p
                                class="mt-5 text-2xl font-bold text-slate-900"
                            >
                                {{ totalProcessed() }}
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                Pengajuan telah diproses
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Main Table Card -->
                <div
                    class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
                >

                    <!-- Card Header -->
                    <div
                        class="flex flex-col gap-3 border-b border-slate-100 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6"
                    >
                        <div>
                            <h3
                                class="text-base font-bold text-slate-900"
                            >
                                Status Perubahan Gaji
                            </h3>

                            <p
                                class="mt-1 text-xs text-slate-500"
                            >
                                Monitoring laporan perubahan gaji PNS dan PPPK
                                pada periode aktif.
                            </p>
                        </div>

                        <div class="flex flex-wrap items-center gap-2">
                            <a
                                :href="route('admin-changes.export')"
                                class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-3 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700"
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
                                        d="M12 3v12"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M7 10l5 5 5-5"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5 21h14"
                                    />
                                </svg>

                                Download Excel
                            </a>

                            <div
                                class="inline-flex w-fit items-center gap-2 rounded-lg bg-slate-50 px-3 py-2 text-xs text-slate-500"
                            >
                                <span
                                    class="h-1.5 w-1.5 rounded-full bg-emerald-500"
                                ></span>

                                {{ rows.length }} sekolah
                            </div>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div
                        v-if="rows.length === 0"
                        class="px-6 py-16 text-center"
                    >
                        <div
                            class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.6"
                                class="h-7 w-7 text-slate-400"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12h6M9 16h6M9 8h.01M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z"
                                />
                            </svg>
                        </div>

                        <h4
                            class="mt-4 text-sm font-semibold text-slate-800"
                        >
                            Belum ada data pengajuan
                        </h4>

                        <p class="mt-1 text-xs text-slate-500">
                            Belum ada data perubahan gaji untuk periode ini.
                        </p>
                    </div>

                    <!-- Table -->
                    <div
                        v-else
                        class="overflow-x-auto"
                    >
                        <table
                            class="w-full min-w-[800px] text-sm text-left"
                        >
                            <thead>
                                <tr
                                    class="border-b border-slate-100 bg-slate-50/80"
                                >
                                    <th
                                        class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-slate-500"
                                    >
                                        Sekolah
                                    </th>

                                    <th
                                        class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-slate-500"
                                    >
                                        PNS
                                    </th>

                                    <th
                                        class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-slate-500"
                                    >
                                        PPPK
                                    </th>

                                    <th
                                        class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-slate-500"
                                    >
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr
                                    v-for="r in rows"
                                    :key="r.school"
                                    class="group border-b border-slate-100 last:border-0 hover:bg-slate-50/60 transition-colors"
                                >

                                    <!-- Sekolah -->
                                    <td class="px-6 py-4">
                                        <div
                                            class="flex items-center gap-3"
                                        >
                                            <div
                                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#28558f]"
                                            >
                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.7"
                                                    class="h-4 w-4"
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
                                                <p
                                                    class="font-semibold text-slate-900 truncate max-w-[300px]"
                                                    :title="r.school"
                                                >
                                                    {{ r.school }}
                                                </p>

                                                <p
                                                    class="mt-0.5 text-[11px] text-slate-400"
                                                >
                                                    Data periode aktif
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- PNS -->
                                    <td class="px-6 py-4">
                                        <Link
                                            v-if="r.pns"
                                            :href="
                                                route(
                                                    'admin-changes.show',
                                                    r.pns.id
                                                )
                                            "
                                            class="inline-flex items-center rounded-lg px-2.5 py-1.5 text-[11px] font-semibold transition hover:opacity-80"
                                            :class="statusColor(r.pns)"
                                        >
                                            <span
                                                class="mr-1.5 h-1.5 w-1.5 rounded-full bg-current opacity-70"
                                            ></span>

                                            {{ statusLabel(r.pns) }}
                                        </Link>

                                        <span
                                            v-else
                                            class="inline-flex items-center rounded-lg bg-amber-50 px-2.5 py-1.5 text-[11px] font-semibold text-amber-700 ring-1 ring-inset ring-amber-600/10"
                                        >
                                            <span
                                                class="mr-1.5 h-1.5 w-1.5 rounded-full bg-current opacity-70"
                                            ></span>

                                            Belum Lapor
                                        </span>
                                    </td>

                                    <!-- PPPK -->
                                    <td class="px-6 py-4">
                                        <Link
                                            v-if="r.pppk"
                                            :href="
                                                route(
                                                    'admin-changes.show',
                                                    r.pppk.id
                                                )
                                            "
                                            class="inline-flex items-center rounded-lg px-2.5 py-1.5 text-[11px] font-semibold transition hover:opacity-80"
                                            :class="statusColor(r.pppk)"
                                        >
                                            <span
                                                class="mr-1.5 h-1.5 w-1.5 rounded-full bg-current opacity-70"
                                            ></span>

                                            {{ statusLabel(r.pppk) }}
                                        </Link>

                                        <span
                                            v-else
                                            class="inline-flex items-center rounded-lg bg-amber-50 px-2.5 py-1.5 text-[11px] font-semibold text-amber-700 ring-1 ring-inset ring-amber-600/10"
                                        >
                                            <span
                                                class="mr-1.5 h-1.5 w-1.5 rounded-full bg-current opacity-70"
                                            ></span>

                                            Belum Lapor
                                        </span>
                                    </td>

                                    <!-- Aksi -->
                                    <td class="px-6 py-4">
                                        <div
                                            class="flex flex-wrap items-center gap-2"
                                        >
                                            <Link
                                                v-if="r.pns"
                                                :href="
                                                    route(
                                                        'admin-changes.show',
                                                        r.pns.id
                                                    )
                                                "
                                                class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-2 text-[11px] font-semibold text-slate-600 shadow-sm hover:border-blue-200 hover:bg-blue-50 hover:text-[#28558f] transition"
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
                                                        d="M15 12H9m3-3v6"
                                                    />

                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="9"
                                                    />
                                                </svg>

                                                Detail PNS
                                            </Link>

                                            <Link
                                                v-if="r.pppk"
                                                :href="
                                                    route(
                                                        'admin-changes.show',
                                                        r.pppk.id
                                                    )
                                                "
                                                class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-2 text-[11px] font-semibold text-slate-600 shadow-sm hover:border-blue-200 hover:bg-blue-50 hover:text-[#28558f] transition"
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
                                                        d="M15 12H9m3-3v6"
                                                    />

                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="9"
                                                    />
                                                </svg>

                                                Detail PPPK
                                            </Link>

                                            <span
                                                v-if="
                                                    !r.pns &&
                                                    !r.pppk
                                                "
                                                class="text-xs text-slate-300"
                                            >
                                                Tidak ada aksi
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Legend -->
                <div
                    v-if="rows.length > 0"
                    class="mt-5 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                >
                    <div class="flex items-center gap-2 mb-4">
                        <div
                            class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="w-4 h-4 text-slate-500"
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
                                Keterangan Status
                            </p>

                            <p
                                class="text-[11px] text-slate-400"
                            >
                                Referensi status pengajuan perubahan gaji.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <span
                            class="inline-flex items-center rounded-lg bg-emerald-50 px-2.5 py-1.5 text-[10px] font-semibold text-emerald-700"
                        >
                            Sudah Diproses
                        </span>

                        <span
                            class="inline-flex items-center rounded-lg bg-blue-50 px-2.5 py-1.5 text-[10px] font-semibold text-blue-700"
                        >
                            Sudah Lapor
                        </span>

                        <span
                            class="inline-flex items-center rounded-lg bg-slate-100 px-2.5 py-1.5 text-[10px] font-semibold text-slate-500"
                        >
                            Tidak Ada Perubahan
                        </span>

                        <span
                            class="inline-flex items-center rounded-lg bg-amber-50 px-2.5 py-1.5 text-[10px] font-semibold text-amber-700"
                        >
                            Belum Lapor
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>