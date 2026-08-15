<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    period: Object,
    rows: Array,
});

const labelSalary = {
    WAITING_DOCUMENT: 'Belum Ada',
    WAITING_VERIFICATION: 'Menunggu Verifikasi',
    NEEDS_REVISION: 'Perlu Perbaikan',
    WAITING_REVERIFICATION: 'Verifikasi Ulang',
    FIX: 'FIX',
};

const labelPayroll = {
    BELUM_WAJIB: 'Belum Wajib',
    REQUIRED: 'Belum Upload',
    UPLOADED: 'Menunggu Review',
    APPROVED: 'Approved',
    REVISION: 'Perlu Revisi',
};

const colorSalary = (status) => {
    return status === 'FIX'
        ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/10'
        : status === 'NEEDS_REVISION'
            ? 'bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/10'
            : 'bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-600/10';
};

const colorPayroll = (status) => {
    return {
        BELUM_WAJIB:
            'bg-slate-100 text-slate-500 ring-1 ring-inset ring-slate-500/10',
        REQUIRED:
            'bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-600/10',
        UPLOADED:
            'bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-600/10',
        APPROVED:
            'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/10',
        REVISION:
            'bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/10',
    }[status];
};

const notesFor = ref({});

function approve(payrollId) {
    if (!confirm('Setujui payroll ini?')) {
        return;
    }

    useForm({}).post(
        route('rekap.payroll.approve', payrollId)
    );
}

function requestRevision(payrollId) {
    useForm({
        revision_notes:
            notesFor.value[payrollId] || 'Perlu diperbaiki',
    }).post(
        route('rekap.payroll.revision', payrollId)
    );
}

function downloadPayroll(payrollId) {
    window.location.href = route(
        'rekap.payroll.download',
        payrollId
    );
}
</script>

<template>
    <Head title="Rekap" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-bold tracking-tight text-slate-900">
                        Rekap Payroll
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Monitoring status dokumen gaji dan payroll seluruh sekolah.
                    </p>
                </div>

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
                        <p class="text-[10px] font-semibold uppercase tracking-wider text-slate-400">
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
                            <div class="flex items-center justify-between">
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

                            <p class="mt-5 text-2xl font-bold text-slate-900">
                                {{ rows.length }}
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                Total sekolah dalam periode
                            </p>
                        </div>
                    </div>


                    <!-- PNS FIX -->
                    <div
                        class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                    >
                        <div
                            class="absolute -right-5 -top-5 h-24 w-24 rounded-full bg-emerald-50"
                        ></div>

                        <div class="relative">
                            <div class="flex items-center justify-between">
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
                                    PNS
                                </span>
                            </div>

                            <p class="mt-5 text-2xl font-bold text-slate-900">
                                {{
                                    rows.filter(
                                        r => r.pns_status === 'FIX'
                                    ).length
                                }}
                                <span class="text-sm font-medium text-slate-400">
                                    / {{ rows.length }}
                                </span>
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                Dokumen PNS berstatus FIX
                            </p>
                        </div>
                    </div>


                    <!-- PPPK FIX -->
                    <div
                        class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                    >
                        <div
                            class="absolute -right-5 -top-5 h-24 w-24 rounded-full bg-emerald-50"
                        ></div>

                        <div class="relative">
                            <div class="flex items-center justify-between">
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
                                    PPPK
                                </span>
                            </div>

                            <p class="mt-5 text-2xl font-bold text-slate-900">
                                {{
                                    rows.filter(
                                        r => r.pppk_status === 'FIX'
                                    ).length
                                }}
                                <span class="text-sm font-medium text-slate-400">
                                    / {{ rows.length }}
                                </span>
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                Dokumen PPPK berstatus FIX
                            </p>
                        </div>
                    </div>


                    <!-- Payroll Approved -->
                    <div
                        class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                    >
                        <div
                            class="absolute -right-5 -top-5 h-24 w-24 rounded-full bg-indigo-50"
                        ></div>

                        <div class="relative">
                            <div class="flex items-center justify-between">
                                <div
                                    class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="w-5 h-5 text-indigo-600"
                                    >
                                        <rect
                                            x="3"
                                            y="5"
                                            width="18"
                                            height="14"
                                            rx="2"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            d="M3 10h18M7 15h4"
                                        />
                                    </svg>
                                </div>

                                <span
                                    class="text-[10px] font-bold uppercase tracking-wider text-slate-400"
                                >
                                    Payroll
                                </span>
                            </div>

                            <p class="mt-5 text-2xl font-bold text-slate-900">
                                {{
                                    rows.filter(
                                        r => r.payroll_status === 'APPROVED'
                                    ).length
                                }}
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                Payroll telah disetujui
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
                            <h3 class="text-base font-bold text-slate-900">
                                Status Sekolah
                            </h3>

                            <p class="mt-1 text-xs text-slate-500">
                                Status dokumen gaji dan payroll pada periode aktif.
                            </p>
                        </div>

                        <div
                            class="inline-flex w-fit items-center gap-2 rounded-lg bg-slate-50 px-3 py-2 text-xs text-slate-500"
                        >
                            <span
                                class="h-1.5 w-1.5 rounded-full bg-emerald-500"
                            ></span>

                            {{ rows.length }} sekolah
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
                                    d="M3 21h18M5 21V9l7-5 7 5v12"
                                />
                                <path
                                    stroke-linecap="round"
                                    d="M9 21v-6h6v6"
                                />
                            </svg>
                        </div>

                        <h4 class="mt-4 text-sm font-semibold text-slate-800">
                            Belum ada data sekolah
                        </h4>

                        <p class="mt-1 text-xs text-slate-500">
                            Belum ada data sekolah untuk periode ini.
                        </p>
                    </div>


                    <!-- Desktop / Tablet Table -->
                    <div
                        v-else
                        class="overflow-x-auto"
                    >
                        <table class="w-full min-w-[900px] text-sm text-left">

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
                                        Payroll
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
                                        <div class="flex items-center gap-3">
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
                                                    class="font-semibold text-slate-900 truncate max-w-[280px]"
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
                                        <span
                                            class="inline-flex items-center rounded-lg px-2.5 py-1.5 text-[11px] font-semibold"
                                            :class="colorSalary(r.pns_status)"
                                        >
                                            <span
                                                class="mr-1.5 h-1.5 w-1.5 rounded-full bg-current opacity-70"
                                            ></span>

                                            {{
                                                labelSalary[r.pns_status]
                                                ?? r.pns_status
                                            }}
                                        </span>
                                    </td>


                                    <!-- PPPK -->
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center rounded-lg px-2.5 py-1.5 text-[11px] font-semibold"
                                            :class="colorSalary(r.pppk_status)"
                                        >
                                            <span
                                                class="mr-1.5 h-1.5 w-1.5 rounded-full bg-current opacity-70"
                                            ></span>

                                            {{
                                                labelSalary[r.pppk_status]
                                                ?? r.pppk_status
                                            }}
                                        </span>
                                    </td>


                                    <!-- Payroll -->
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center rounded-lg px-2.5 py-1.5 text-[11px] font-semibold"
                                            :class="colorPayroll(r.payroll_status)"
                                        >
                                            <span
                                                class="mr-1.5 h-1.5 w-1.5 rounded-full bg-current opacity-70"
                                            ></span>

                                            {{
                                                labelPayroll[r.payroll_status]
                                                ?? r.payroll_status
                                            }}
                                        </span>
                                    </td>


                                    <!-- Actions -->
                                    <td class="px-6 py-4">

                                        <div
                                            v-if="
                                                r.payroll_status === 'UPLOADED'
                                                && r.payroll_id
                                            "
                                            class="flex flex-wrap items-center gap-2"
                                        >

                                            <!-- Download -->
                                            <a
                                                :href="
                                                    route(
                                                        'rekap.payroll.download',
                                                        r.payroll_id
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
                                                        d="M12 3v12m0 0l-4-4m4 4l4-4M5 21h14"
                                                    />
                                                </svg>

                                                Lihat File
                                            </a>


                                            <!-- Approve -->
                                            <button
                                                @click="approve(r.payroll_id)"
                                                class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-600 px-3 py-2 text-[11px] font-semibold text-white shadow-sm hover:bg-emerald-700 transition"
                                            >
                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    class="h-3.5 w-3.5"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M5 12l4 4L19 6"
                                                    />
                                                </svg>

                                                Approve
                                            </button>


                                            <!-- Revision -->
                                            <div class="flex items-center gap-2">
                                                <input
                                                    v-model="
                                                        notesFor[r.payroll_id]
                                                    "
                                                    type="text"
                                                    placeholder="Catatan revisi"
                                                    class="w-36 rounded-lg border-slate-200 bg-slate-50 px-3 py-2 text-[11px] text-slate-700 placeholder:text-slate-400 focus:border-[#28558f] focus:bg-white focus:ring-[#28558f]"
                                                />

                                                <button
                                                    @click="
                                                        requestRevision(
                                                            r.payroll_id
                                                        )
                                                    "
                                                    class="inline-flex items-center gap-1.5 rounded-lg border border-red-100 bg-red-50 px-3 py-2 text-[11px] font-semibold text-red-600 hover:bg-red-100 transition"
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
                                                            d="M12 9v4"
                                                        />
                                                        <path
                                                            stroke-linecap="round"
                                                            d="M12 17h.01"
                                                        />
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M10.3 4.7L2.8 18a2 2 0 001.7 3h15a2 2 0 001.7-3L13.7 4.7a2 2 0 00-3.4 0z"
                                                        />
                                                    </svg>

                                                    Revisi
                                                </button>
                                            </div>

                                        </div>

                                        <span
                                            v-else
                                            class="text-xs text-slate-300"
                                        >
                                            Tidak ada aksi
                                        </span>

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
                            <p class="text-sm font-semibold text-slate-800">
                                Keterangan Status
                            </p>

                            <p class="text-[11px] text-slate-400">
                                Referensi status dokumen dan payroll.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <span
                            class="inline-flex items-center rounded-lg bg-emerald-50 px-2.5 py-1.5 text-[10px] font-semibold text-emerald-700"
                        >
                            FIX / Approved
                        </span>

                        <span
                            class="inline-flex items-center rounded-lg bg-blue-50 px-2.5 py-1.5 text-[10px] font-semibold text-blue-700"
                        >
                            Menunggu Review
                        </span>

                        <span
                            class="inline-flex items-center rounded-lg bg-amber-50 px-2.5 py-1.5 text-[10px] font-semibold text-amber-700"
                        >
                            Menunggu / Belum Upload
                        </span>

                        <span
                            class="inline-flex items-center rounded-lg bg-red-50 px-2.5 py-1.5 text-[10px] font-semibold text-red-700"
                        >
                            Perlu Perbaikan
                        </span>

                        <span
                            class="inline-flex items-center rounded-lg bg-slate-100 px-2.5 py-1.5 text-[10px] font-semibold text-slate-500"
                        >
                            Belum Wajib
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>