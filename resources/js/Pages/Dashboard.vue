<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const props = defineProps({
    period: Object,
    statuses: Array,
    payroll: Object,
    stats: Object,
});

const user = usePage().props.auth.user;

const labelStatus = {
    WAITING_DOCUMENT: 'Belum Ada',
    WAITING_VERIFICATION: 'Menunggu Verifikasi',
    NEEDS_REVISION: 'Perlu Perbaikan',
    WAITING_REVERIFICATION: 'Menunggu Verifikasi Ulang',
    FIX: 'FIX',
};

const payrollRequired =
    user.role === 'OPERATOR' &&
    props.payroll?.status === 'REQUIRED';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold tracking-tight text-slate-900">
                        Dashboard
                    </h2>

                    <p class="mt-0.5 text-xs text-slate-500">
                        Monitoring gaji dan payroll Cabang Dinas Pendidikan
                    </p>
                </div>

            </div>
        </template>

        <div class="min-h-[calc(100vh-65px)] bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">

                <!-- =====================================================
                     HEADER DASHBOARD
                ====================================================== -->
                <div class="mb-7">
                    <div
                        class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#17385f] via-[#28558f] to-[#32669f] shadow-sm"
                    >
                        <!-- Decorative -->
                        <div
                            class="absolute -right-20 -top-28 w-80 h-80 rounded-full border border-white/10"
                        ></div>

                        <div
                            class="absolute -right-8 -bottom-32 w-72 h-72 rounded-full border border-white/10"
                        ></div>

                        <div
                            class="absolute right-24 top-10 w-32 h-32 rounded-full bg-blue-300/10 blur-2xl"
                        ></div>

                        <div
                            class="relative px-6 py-6 sm:px-8 sm:py-7 flex flex-col md:flex-row md:items-center md:justify-between gap-5"
                        >
                            <div>
                                <div
                                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/10"
                                >
                                    <span
                                        class="w-1.5 h-1.5 rounded-full bg-blue-200"
                                    ></span>

                                    <span
                                        class="text-[11px] font-semibold text-blue-100"
                                    >
                                        {{ user.role === 'OPERATOR'
                                            ? 'Dashboard Operator'
                                            : 'Dashboard Administrator' }}
                                    </span>
                                </div>

                                <h1
                                    class="mt-4 text-2xl sm:text-3xl font-bold tracking-tight text-white"
                                >
                                    Monitoring Gaji & Payroll
                                </h1>

                                <p
                                    class="mt-2 text-sm leading-6 text-blue-100/75 max-w-xl"
                                >
                                    Pantau status dokumen gaji, proses verifikasi,
                                    perbaikan data, hingga proses payroll dalam
                                    satu sistem terpusat.
                                </p>
                            </div>

                            <div
                                class="shrink-0 rounded-xl bg-white/10 border border-white/10 px-5 py-4 min-w-[190px]"
                            >
                                <p class="text-[10px] uppercase tracking-wider text-blue-100/60 font-semibold">
                                    Periode Aktif
                                </p>

                                <p class="mt-1 text-sm font-bold text-white">
                                    {{ period?.label ?? 'Belum ada periode aktif' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- =====================================================
                     DASHBOARD ADMIN
                ====================================================== -->
                <div
                    v-if="user.role !== 'OPERATOR'"
                    class="space-y-6"
                >

                    <!-- Permintaan Perbaikan -->
                    <div
                        v-if="stats?.open_revisions > 0"
                        class="relative overflow-hidden rounded-2xl border border-amber-200 bg-gradient-to-r from-amber-50 to-white"
                    >
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-amber-500"></div>

                        <div
                            class="px-5 py-5 sm:px-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4"
                        >
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-11 h-11 shrink-0 rounded-xl bg-amber-100 flex items-center justify-center"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="w-5 h-5 text-amber-700"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 9v3m0 3h.01M10.3 4.2L2.9 17a2 2 0 001.73 3h14.74a2 2 0 001.73-3L13.7 4.2a2 2 0 00-3.4 0z"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <p class="font-bold text-amber-900">
                                        {{ stats.open_revisions }}
                                        Permintaan Perbaikan Menunggu
                                    </p>

                                    <p class="mt-1 text-sm text-amber-700/80">
                                        Terdapat data yang membutuhkan tindak
                                        lanjut sebelum dapat diverifikasi kembali.
                                    </p>
                                </div>
                            </div>

                            <Link
                                :href="route('revisions.index')"
                                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold shadow-sm transition-colors"
                            >
                                Buka Perbaikan

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
                            </Link>
                        </div>
                    </div>


                    <!-- Statistik Utama -->
                    <section v-if="stats">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-sm font-bold text-slate-900">
                                    Ringkasan Monitoring
                                </h3>

                                <p class="text-xs text-slate-500 mt-1">
                                    Status data gaji berdasarkan periode aktif
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

                            <!-- Total Sekolah -->
                            <div
                                class="group bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition-shadow"
                            >
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="text-xs font-medium text-slate-500">
                                            Total Sekolah
                                        </p>

                                        <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">
                                            {{ stats.total_schools }}
                                        </p>
                                    </div>

                                    <div
                                        class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center"
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
                                </div>

                                <div class="mt-4 pt-4 border-t border-slate-100">
                                    <span class="text-xs text-slate-400">
                                        Sekolah terdaftar
                                    </span>
                                </div>
                            </div>


                            <!-- PNS FIX -->
                            <div
                                class="group bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition-shadow"
                            >
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="text-xs font-medium text-slate-500">
                                            PNS FIX
                                        </p>

                                        <p class="mt-3 text-3xl font-bold tracking-tight text-emerald-600">
                                            {{ stats.pns_fix }}
                                            <span class="text-base font-medium text-slate-400">
                                                / {{ stats.total_schools }}
                                            </span>
                                        </p>
                                    </div>

                                    <div
                                        class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center"
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
                                </div>

                                <div class="mt-4 pt-4 border-t border-slate-100">
                                    <span class="text-xs text-slate-400">
                                        Data PNS telah FIX
                                    </span>
                                </div>
                            </div>


                            <!-- PPPK FIX -->
                            <div
                                class="group bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition-shadow"
                            >
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="text-xs font-medium text-slate-500">
                                            PPPK FIX
                                        </p>

                                        <p class="mt-3 text-3xl font-bold tracking-tight text-emerald-600">
                                            {{ stats.pppk_fix }}
                                            <span class="text-base font-medium text-slate-400">
                                                / {{ stats.total_schools }}
                                            </span>
                                        </p>
                                    </div>

                                    <div
                                        class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="w-5 h-5 text-emerald-600"
                                        >
                                            <circle cx="12" cy="8" r="3" />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 20c.7-3.3 3.1-5 7-5s6.3 1.7 7 5"
                                            />
                                        </svg>
                                    </div>
                                </div>

                                <div class="mt-4 pt-4 border-t border-slate-100">
                                    <span class="text-xs text-slate-400">
                                        Data PPPK telah FIX
                                    </span>
                                </div>
                            </div>


                            <!-- Payroll Approved -->
                            <div
                                class="group bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition-shadow"
                            >
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="text-xs font-medium text-slate-500">
                                            Payroll Approved
                                        </p>

                                        <p class="mt-3 text-3xl font-bold tracking-tight text-[#28558f]">
                                            {{ stats.payroll_approved }}
                                        </p>
                                    </div>

                                    <div
                                        class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center"
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
                                                d="M7 3h8l4 4v14H7a2 2 0 01-2-2V5a2 2 0 012-2z"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M14 3v5h5M9 14l2 2 4-4"
                                            />
                                        </svg>
                                    </div>
                                </div>

                                <div class="mt-4 pt-4 border-t border-slate-100">
                                    <span class="text-xs text-slate-400">
                                        Payroll telah disetujui
                                    </span>
                                </div>
                            </div>

                        </div>
                    </section>


                    <!-- Statistik Payroll -->
                    <section v-if="stats">
                        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">

                            <div
                                class="px-5 py-5 sm:px-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2"
                            >
                                <div>
                                    <h3 class="text-sm font-bold text-slate-900">
                                        Monitoring Payroll
                                    </h3>

                                    <p class="text-xs text-slate-500 mt-1">
                                        Ringkasan proses pengiriman dan pemeriksaan payroll
                                    </p>
                                </div>

                                <Link
                                    :href="route('rekap.index')"
                                    class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#28558f] hover:text-[#1f4678]"
                                >
                                    Lihat Rekap Lengkap

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        class="w-3.5 h-3.5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 12h14m-6-6l6 6-6 6"
                                        />
                                    </svg>
                                </Link>
                            </div>


                            <div class="grid grid-cols-2 lg:grid-cols-4 divide-x divide-slate-100">

                                <!-- Belum Upload -->
                                <div class="p-5 sm:p-6">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>

                                        <span class="text-xs font-medium text-slate-500">
                                            Belum Upload
                                        </span>
                                    </div>

                                    <p class="mt-3 text-2xl font-bold text-amber-600">
                                        {{ stats.payroll_required }}
                                    </p>

                                    <p class="mt-1 text-[11px] text-slate-400">
                                        Membutuhkan payroll
                                    </p>
                                </div>


                                <!-- Menunggu Review -->
                                <div class="p-5 sm:p-6">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>

                                        <span class="text-xs font-medium text-slate-500">
                                            Menunggu Review
                                        </span>
                                    </div>

                                    <p class="mt-3 text-2xl font-bold text-blue-600">
                                        {{ stats.payroll_uploaded }}
                                    </p>

                                    <p class="mt-1 text-[11px] text-slate-400">
                                        Menunggu pemeriksaan
                                    </p>
                                </div>


                                <!-- Perlu Revisi -->
                                <div class="p-5 sm:p-6">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-red-500"></span>

                                        <span class="text-xs font-medium text-slate-500">
                                            Perlu Revisi
                                        </span>
                                    </div>

                                    <p class="mt-3 text-2xl font-bold text-red-600">
                                        {{ stats.payroll_revision }}
                                    </p>

                                    <p class="mt-1 text-[11px] text-slate-400">
                                        Membutuhkan perbaikan
                                    </p>
                                </div>


                                <!-- Approved -->
                                <div class="p-5 sm:p-6">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                                        <span class="text-xs font-medium text-slate-500">
                                            Approved
                                        </span>
                                    </div>

                                    <p class="mt-3 text-2xl font-bold text-emerald-600">
                                        {{ stats.payroll_approved }}
                                    </p>

                                    <p class="mt-1 text-[11px] text-slate-400">
                                        Payroll disetujui
                                    </p>
                                </div>

                            </div>
                        </div>
                    </section>

                </div>


                <!-- =====================================================
                     DASHBOARD OPERATOR
                ====================================================== -->
                <template v-else>

                    <!-- Payroll Required -->
                    <div
                        v-if="payrollRequired"
                        class="relative overflow-hidden rounded-2xl border border-amber-200 bg-gradient-to-r from-amber-50 to-white"
                    >
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-amber-500"></div>

                        <div
                            class="px-5 py-5 sm:px-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4"
                        >
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-11 h-11 shrink-0 rounded-xl bg-amber-100 flex items-center justify-center"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="w-5 h-5 text-amber-700"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 3v12m0 0l4-4m-4 4l-4-4M5 21h14"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <p class="font-bold text-amber-900">
                                        Payroll Perlu Dibuat
                                    </p>

                                    <p class="mt-1 text-sm text-amber-700/80">
                                        PNS & PPPK sudah FIX. Payroll dapat
                                        segera dibuat untuk periode ini.
                                    </p>
                                </div>
                            </div>

                            <Link
                                :href="route('payroll.show')"
                                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold shadow-sm transition-colors"
                            >
                                Buka Payroll

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
                            </Link>
                        </div>
                    </div>


                    <!-- Empty State -->
                    <div
                        v-if="statuses.length === 0"
                        class="bg-white border border-slate-200 rounded-2xl p-8 sm:p-12 text-center shadow-sm"
                    >
                        <div
                            class="mx-auto w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.7"
                                class="w-7 h-7 text-[#28558f]"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M7 3h8l4 4v14H7a2 2 0 01-2-2V5a2 2 0 012-2z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M14 3v5h5"
                                />
                            </svg>
                        </div>

                        <h3 class="mt-5 text-base font-bold text-slate-900">
                            Belum Ada Dokumen Gaji
                        </h3>

                        <p class="mt-2 max-w-md mx-auto text-sm leading-6 text-slate-500">
                            Belum ada dokumen gaji untuk sekolah Anda pada
                            periode aktif ini.
                        </p>
                    </div>


                    <!-- Dokumen PNS / PPPK -->
                    <div v-else>
                        <div class="mb-4">
                            <h3 class="text-sm font-bold text-slate-900">
                                Status Dokumen Gaji
                            </h3>

                            <p class="mt-1 text-xs text-slate-500">
                                Pantau status dokumen PNS dan PPPK sekolah Anda.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            <div
                                v-for="s in statuses"
                                :key="s.id"
                                class="group bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md hover:border-slate-300 transition-all"
                            >
                                <div class="flex items-start justify-between gap-4">

                                    <!-- Icon -->
                                    <div
                                        class="w-11 h-11 shrink-0 rounded-xl bg-blue-50 flex items-center justify-center"
                                    >
                                        <svg
                                            v-if="s.type === 'PNS'"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="w-5 h-5 text-[#28558f]"
                                        >
                                            <circle cx="12" cy="8" r="3" />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 20c.7-3.3 3.1-5 7-5s6.3 1.7 7 5"
                                            />
                                        </svg>

                                        <svg
                                            v-else
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="w-5 h-5 text-[#28558f]"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M4 6h16v12H4z"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                d="M8 10h8M8 14h5"
                                            />
                                        </svg>
                                    </div>


                                    <!-- Status -->
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-full text-[11px] font-semibold"
                                        :class="
                                            s.status === 'FIX'
                                                ? 'bg-emerald-50 text-emerald-700 border border-emerald-100'
                                                : s.status === 'NEEDS_REVISION'
                                                    ? 'bg-red-50 text-red-700 border border-red-100'
                                                    : 'bg-amber-50 text-amber-700 border border-amber-100'
                                        "
                                    >
                                        <span
                                            class="w-1.5 h-1.5 rounded-full"
                                            :class="
                                                s.status === 'FIX'
                                                    ? 'bg-emerald-500'
                                                    : s.status === 'NEEDS_REVISION'
                                                        ? 'bg-red-500'
                                                        : 'bg-amber-500'
                                            "
                                        ></span>

                                        {{ labelStatus[s.status] ?? s.status }}
                                    </span>

                                </div>


                                <div class="mt-5">
                                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">
                                        Jenis Dokumen
                                    </p>

                                    <h3 class="mt-1 text-lg font-bold text-slate-900">
                                        {{ s.type }}
                                    </h3>
                                </div>


                                <div class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between">

                                    <div class="text-xs text-slate-400">
                                        Status saat ini
                                    </div>

                                    <Link
                                        v-if="s.current_document"
                                        :href="route(
                                            'documents.show',
                                            s.current_document.id
                                        )"
                                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#28558f] hover:text-[#1f4678]"
                                    >
                                        Lihat Dokumen

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            class="w-3.5 h-3.5"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 12h14m-6-6l6 6-6 6"
                                            />
                                        </svg>
                                    </Link>

                                    <span
                                        v-else
                                        class="text-xs text-slate-400"
                                    >
                                        Belum tersedia
                                    </span>

                                </div>
                            </div>

                        </div>
                    </div>

                </template>

            </div>
        </div>
    </AuthenticatedLayout>
</template>