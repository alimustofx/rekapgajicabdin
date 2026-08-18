<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';

defineProps({
    periods: Array,
});

const form = useForm({
    month: '',
    year: new Date().getFullYear(),
});

function submit() {
    form.post(route('periods.store'), {
        onSuccess: () => form.reset('month'),
    });
}

function toggle(id) {
    router.post(route('periods.toggle', id));
}
</script>

<template>
    <Head title="Periode Gaji" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-3">

                <div>
                    <h2 class="text-xl font-bold tracking-tight text-slate-900">
                        Periode Gaji
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Kelola periode penggajian yang digunakan dalam sistem
                    </p>
                </div>
            </div>
        </template>

        <div class="min-h-[calc(100vh-72px)] bg-slate-50 py-8">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

                <!-- PAGE INTRO -->
                <div>
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 border border-blue-100 text-[#28558f] text-xs font-semibold"
                    >
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-blue-600"
                        ></span>

                        Manajemen Periode
                    </div>

                    <h1
                        class="mt-3 text-2xl sm:text-3xl font-bold tracking-tight text-slate-950"
                    >
                        Periode Penggajian
                    </h1>

                    <p
                        class="mt-2 text-sm leading-6 text-slate-500 max-w-2xl"
                    >
                        Buat dan kelola periode gaji untuk memastikan proses
                        verifikasi, payroll, dan monitoring berjalan pada
                        periode yang tepat.
                    </p>
                </div>


                <!-- CREATE PERIOD CARD -->
                <div
                    class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden"
                >
                    <div
                        class="px-5 sm:px-6 py-4 border-b border-slate-100 flex items-center gap-3"
                    >
                        <div
                            class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center shrink-0"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="w-5 h-5 text-[#28558f]"
                            >
                                <circle cx="12" cy="12" r="9" />
                                <path
                                    stroke-linecap="round"
                                    d="M12 8v8M8 12h8"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-sm font-bold text-slate-900">
                                Buat Periode Baru
                            </h3>

                            <p class="text-xs text-slate-500 mt-0.5">
                                Tambahkan periode penggajian baru ke sistem.
                            </p>
                        </div>
                    </div>


                    <form
                        @submit.prevent="submit"
                        class="p-5 sm:p-6"
                    >
                        <div
                            class="grid grid-cols-1 sm:grid-cols-[1fr_1fr_auto] gap-4 items-end"
                        >

                            <!-- MONTH -->
                            <div>
                                <label
                                    for="month"
                                    class="block text-xs font-semibold text-slate-700 mb-2"
                                >
                                    Bulan
                                </label>

                                <select
                                    id="month"
                                    v-model="form.month"
                                    class="block w-full rounded-xl border-slate-200 bg-slate-50/50 text-sm text-slate-700 focus:border-[#28558f] focus:ring-[#28558f]"
                                >
                                    <option value="" disabled>
                                        Pilih bulan
                                    </option>

                                    <option
                                        v-for="n in 12"
                                        :key="n"
                                        :value="n"
                                    >
                                        {{ n }}
                                    </option>
                                </select>

                                <p
                                    v-if="form.errors.month"
                                    class="text-xs text-red-600 mt-1.5"
                                >
                                    {{ form.errors.month }}
                                </p>
                            </div>


                            <!-- YEAR -->
                            <div>
                                <label
                                    for="year"
                                    class="block text-xs font-semibold text-slate-700 mb-2"
                                >
                                    Tahun
                                </label>

                                <input
                                    id="year"
                                    v-model="form.year"
                                    type="number"
                                    class="block w-full rounded-xl border-slate-200 bg-slate-50/50 text-sm text-slate-700 focus:border-[#28558f] focus:ring-[#28558f]"
                                />

                                <p
                                    v-if="form.errors.year"
                                    class="text-xs text-red-600 mt-1.5"
                                >
                                    {{ form.errors.year }}
                                </p>
                            </div>


                            <!-- SUBMIT -->
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#28558f] hover:bg-[#1f4678] disabled:opacity-50 disabled:cursor-not-allowed text-white px-5 py-2.5 text-sm font-semibold shadow-sm hover:shadow-md transition-all duration-200"
                            >
                                <svg
                                    v-if="!form.processing"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    class="w-4 h-4"
                                >
                                    <path
                                        stroke-linecap="round"
                                        d="M12 5v14M5 12h14"
                                    />
                                </svg>

                                <svg
                                    v-else
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    class="w-4 h-4 animate-spin"
                                >
                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="9"
                                        class="opacity-30"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        d="M21 12a9 9 0 00-9-9"
                                    />
                                </svg>

                                {{
                                    form.processing
                                        ? 'Menyimpan...'
                                        : 'Buat Periode'
                                }}
                            </button>
                        </div>
                    </form>
                </div>


                <!-- PERIOD LIST -->
                <div
                    class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden"
                >

                    <!-- TABLE HEADER -->
                    <div
                        class="px-5 sm:px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3"
                    >
                        <div>
                            <h3 class="text-sm font-bold text-slate-900">
                                Daftar Periode
                            </h3>

                            <p class="text-xs text-slate-500 mt-0.5">
                                Periode penggajian yang telah dibuat.
                            </p>
                        </div>

                        <div
                            class="inline-flex items-center gap-2 text-xs text-slate-500"
                        >
                            <span
                                class="w-2 h-2 rounded-full bg-emerald-500"
                            ></span>

                            {{ periods.length }} periode
                        </div>
                    </div>


                    <!-- DESKTOP TABLE -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full text-sm text-left">

                            <thead>
                                <tr
                                    class="bg-slate-50/80 border-b border-slate-100"
                                >
                                    <th
                                        class="px-6 py-3.5 text-[11px] font-bold uppercase tracking-wider text-slate-500"
                                    >
                                        Periode
                                    </th>

                                    <th
                                        class="px-6 py-3.5 text-[11px] font-bold uppercase tracking-wider text-slate-500"
                                    >
                                        Status
                                    </th>

                                    <th
                                        class="px-6 py-3.5 text-[11px] font-bold uppercase tracking-wider text-slate-500 text-right"
                                    >
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr
                                    v-for="p in periods"
                                    :key="p.id"
                                    class="border-b border-slate-100 last:border-0 hover:bg-slate-50/60 transition-colors"
                                >

                                    <!-- PERIOD -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">

                                            <div
                                                class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0"
                                            >
                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                    class="w-5 h-5 text-[#28558f]"
                                                >
                                                    <rect
                                                        x="3"
                                                        y="4"
                                                        width="18"
                                                        height="17"
                                                        rx="2"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        d="M16 2v4M8 2v4M3 9h18"
                                                    />
                                                </svg>
                                            </div>

                                            <div>
                                                <div
                                                    class="font-semibold text-slate-900"
                                                >
                                                    {{ p.label }}
                                                </div>

                                                <div
                                                    class="text-xs text-slate-400 mt-0.5"
                                                >
                                                    Periode penggajian
                                                </div>
                                            </div>

                                        </div>
                                    </td>


                                    <!-- STATUS -->
                                    <td class="px-6 py-4">

                                        <span
                                            v-if="p.status === 'OPEN'"
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-700 text-xs font-semibold"
                                        >
                                            <span
                                                class="w-1.5 h-1.5 rounded-full bg-emerald-500"
                                            ></span>

                                            Terbuka
                                        </span>

                                        <span
                                            v-else
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-slate-100 border border-slate-200 text-slate-600 text-xs font-semibold"
                                        >
                                            <span
                                                class="w-1.5 h-1.5 rounded-full bg-slate-400"
                                            ></span>

                                            Ditutup
                                        </span>

                                    </td>


                                    <!-- ACTION -->
                                    <td class="px-6 py-4 text-right">

                                        <button
                                            @click="toggle(p.id)"
                                            class="inline-flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-semibold transition-colors"
                                            :class="
                                                p.status === 'OPEN'
                                                    ? 'text-red-600 hover:bg-red-50'
                                                    : 'text-emerald-600 hover:bg-emerald-50'
                                            "
                                        >

                                            <svg
                                                v-if="p.status === 'OPEN'"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                class="w-4 h-4"
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
                                                    d="M8 12h8"
                                                />
                                            </svg>

                                            <svg
                                                v-else
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                class="w-4 h-4"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    d="M12 5v14M5 12h14"
                                                />
                                            </svg>

                                            {{
                                                p.status === 'OPEN'
                                                    ? 'Tutup Periode'
                                                    : 'Buka Lagi'
                                            }}
                                        </button>

                                    </td>

                                </tr>


                                <!-- EMPTY STATE -->
                                <tr v-if="periods.length === 0">

                                    <td
                                        colspan="3"
                                        class="px-6 py-14 text-center"
                                    >

                                        <div
                                            class="w-14 h-14 mx-auto rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center"
                                        >
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                                class="w-7 h-7 text-slate-300"
                                            >
                                                <rect
                                                    x="3"
                                                    y="4"
                                                    width="18"
                                                    height="17"
                                                    rx="2"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    d="M16 2v4M8 2v4M3 9h18"
                                                />
                                            </svg>
                                        </div>

                                        <p
                                            class="mt-4 text-sm font-semibold text-slate-700"
                                        >
                                            Belum ada periode gaji
                                        </p>

                                        <p
                                            class="mt-1 text-xs text-slate-400"
                                        >
                                            Buat periode baru menggunakan form
                                            di atas.
                                        </p>

                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>


                    <!-- MOBILE CARDS -->
                    <div class="md:hidden divide-y divide-slate-100">

                        <div
                            v-for="p in periods"
                            :key="p.id"
                            class="p-5"
                        >

                            <div class="flex items-start justify-between gap-4">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="w-5 h-5 text-[#28558f]"
                                        >
                                            <rect
                                                x="3"
                                                y="4"
                                                width="18"
                                                height="17"
                                                rx="2"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                d="M16 2v4M8 2v4M3 9h18"
                                            />
                                        </svg>
                                    </div>

                                    <div>
                                        <div
                                            class="font-semibold text-slate-900"
                                        >
                                            {{ p.label }}
                                        </div>

                                        <div
                                            class="text-xs text-slate-400 mt-0.5"
                                        >
                                            Periode penggajian
                                        </div>
                                    </div>

                                </div>


                                <span
                                    v-if="p.status === 'OPEN'"
                                    class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-700 text-[10px] font-semibold"
                                >
                                    <span
                                        class="w-1.5 h-1.5 rounded-full bg-emerald-500"
                                    ></span>

                                    Terbuka
                                </span>

                                <span
                                    v-else
                                    class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full bg-slate-100 border border-slate-200 text-slate-600 text-[10px] font-semibold"
                                >
                                    <span
                                        class="w-1.5 h-1.5 rounded-full bg-slate-400"
                                    ></span>

                                    Ditutup
                                </span>

                            </div>


                            <button
                                @click="toggle(p.id)"
                                class="mt-4 w-full inline-flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl text-xs font-semibold transition-colors"
                                :class="
                                    p.status === 'OPEN'
                                        ? 'text-red-600 bg-red-50 hover:bg-red-100'
                                        : 'text-emerald-600 bg-emerald-50 hover:bg-emerald-100'
                                "
                            >

                                <svg
                                    v-if="p.status === 'OPEN'"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="w-4 h-4"
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
                                        d="M8 12h8"
                                    />
                                </svg>

                                <svg
                                    v-else
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="w-4 h-4"
                                >
                                    <path
                                        stroke-linecap="round"
                                        d="M12 5v14M5 12h14"
                                    />
                                </svg>

                                {{
                                    p.status === 'OPEN'
                                        ? 'Tutup Periode'
                                        : 'Buka Lagi'
                                }}
                            </button>

                        </div>


                        <!-- EMPTY MOBILE -->
                        <div
                            v-if="periods.length === 0"
                            class="p-10 text-center"
                        >
                            <div
                                class="w-14 h-14 mx-auto rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    class="w-7 h-7 text-slate-300"
                                >
                                    <rect
                                        x="3"
                                        y="4"
                                        width="18"
                                        height="17"
                                        rx="2"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        d="M16 2v4M8 2v4M3 9h18"
                                    />
                                </svg>
                            </div>

                            <p
                                class="mt-4 text-sm font-semibold text-slate-700"
                            >
                                Belum ada periode gaji
                            </p>

                            <p
                                class="mt-1 text-xs text-slate-400"
                            >
                                Belum terdapat data periode penggajian.
                            </p>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>