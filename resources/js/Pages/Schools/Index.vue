<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';

defineProps({
    schools: Array,
});

const form = useForm({
    official_name: '',
    school_type: 'SMA',
});

function submit() {
    form.post(route('schools.store'), {
        onSuccess: () => form.reset(),
    });
}

function toggle(id) {
    router.post(route('schools.toggle', id));
}
</script>

<template>
    <Head title="Master Sekolah" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col gap-1">
                <h2 class="text-xl font-bold tracking-tight text-slate-900">
                    Master Sekolah
                </h2>

                <p class="text-sm text-slate-500">
                    Kelola data sekolah yang terdaftar dalam sistem monitoring.
                </p>
            </div>
        </template>

        <div class="min-h-[calc(100vh-72px)] bg-slate-50 py-6 sm:py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- =====================================================
                     PAGE HEADER
                ====================================================== -->
                <div class="mb-6">
                    <div
                        class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#28558f] via-[#28558f] to-[#17385f] px-6 py-6 sm:px-8"
                    >
                        <!-- Decorative -->
                        <div
                            class="absolute -right-20 -top-24 h-64 w-64 rounded-full border border-white/10"
                        ></div>

                        <div
                            class="absolute -bottom-32 right-20 h-72 w-72 rounded-full border border-white/5"
                        ></div>

                        <div class="relative flex items-center gap-4">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white/10 border border-white/10"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="h-6 w-6 text-white"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 21h18"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5 21V6l7-3 7 3v15"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 21v-4h6v4"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8 9h.01M12 9h.01M16 9h.01M8 12h.01M12 12h.01M16 12h.01"
                                    />
                                </svg>
                            </div>

                            <div>
                                <div
                                    class="text-xs font-semibold uppercase tracking-wider text-blue-100/70"
                                >
                                    Data Master
                                </div>

                                <h1
                                    class="mt-0.5 text-xl sm:text-2xl font-bold text-white"
                                >
                                    Sekolah
                                </h1>

                                <p
                                    class="mt-1 text-sm text-blue-100/75"
                                >
                                    Daftar sekolah dan status keaktifan dalam sistem.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- =====================================================
                     ADD SCHOOL
                ====================================================== -->
                <div
                    class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
                >
                    <!-- Card Header -->
                    <div
                        class="flex items-center gap-3 border-b border-slate-100 px-5 py-4 sm:px-6"
                    >
                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                class="h-5 w-5 text-[#28558f]"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 5v14M5 12h14"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-sm font-bold text-slate-900">
                                Tambah Sekolah
                            </h3>

                            <p class="mt-0.5 text-xs text-slate-500">
                                Tambahkan sekolah baru ke dalam master data.
                            </p>
                        </div>
                    </div>


                    <!-- Form -->
                    <form
                        @submit.prevent="submit"
                        class="p-5 sm:p-6"
                    >
                        <div
                            class="grid grid-cols-1 gap-5 lg:grid-cols-[1fr_180px_auto] lg:items-end"
                        >

                            <!-- Nama Sekolah -->
                            <div>
                                <label
                                    for="official_name"
                                    class="mb-2 block text-xs font-semibold text-slate-700"
                                >
                                    Nama Sekolah
                                </label>

                                <div class="relative">
                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="h-4.5 w-4.5 text-slate-400"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3 21h18"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 21V6l7-3 7 3v15"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M9 21v-4h6v4"
                                            />
                                        </svg>
                                    </div>

                                    <input
                                        id="official_name"
                                        v-model="form.official_name"
                                        type="text"
                                        class="block w-full rounded-xl border-slate-200 bg-slate-50/50 py-3 pl-10 pr-4 text-sm text-slate-900 placeholder:text-slate-400 focus:border-[#28558f] focus:bg-white focus:ring-[#28558f]"
                                        placeholder="Contoh: SMA Negeri 1 Turen"
                                    />
                                </div>

                                <p
                                    v-if="form.errors.official_name"
                                    class="mt-1.5 text-xs font-medium text-red-600"
                                >
                                    {{ form.errors.official_name }}
                                </p>
                            </div>


                            <!-- Jenis -->
                            <div>
                                <label
                                    for="school_type"
                                    class="mb-2 block text-xs font-semibold text-slate-700"
                                >
                                    Jenis Sekolah
                                </label>

                                <select
                                    id="school_type"
                                    v-model="form.school_type"
                                    class="block w-full rounded-xl border-slate-200 bg-slate-50/50 py-3 px-4 text-sm text-slate-900 focus:border-[#28558f] focus:bg-white focus:ring-[#28558f]"
                                >
                                    <option value="SMA">
                                        SMA
                                    </option>

                                    <option value="SMK">
                                        SMK
                                    </option>

                                    <option value="SLB">
                                        SLB
                                    </option>
                                </select>

                                <p
                                    v-if="form.errors.school_type"
                                    class="mt-1.5 text-xs font-medium text-red-600"
                                >
                                    {{ form.errors.school_type }}
                                </p>
                            </div>


                            <!-- Submit -->
                            <div>
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="inline-flex w-full lg:w-auto items-center justify-center gap-2 rounded-xl bg-[#28558f] px-5 py-3 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:bg-[#1f4678] hover:shadow-md disabled:cursor-not-allowed disabled:opacity-50"
                                >
                                    <svg
                                        v-if="!form.processing"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        class="h-4 w-4"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 5v14M5 12h14"
                                        />
                                    </svg>

                                    <svg
                                        v-else
                                        class="h-4 w-4 animate-spin"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                    >
                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="9"
                                            stroke="currentColor"
                                            stroke-width="3"
                                            class="opacity-25"
                                        />

                                        <path
                                            d="M21 12a9 9 0 0 0-9-9"
                                            stroke="currentColor"
                                            stroke-width="3"
                                            stroke-linecap="round"
                                        />
                                    </svg>

                                    {{
                                        form.processing
                                            ? 'Menyimpan...'
                                            : 'Tambah Sekolah'
                                    }}
                                </button>
                            </div>

                        </div>
                    </form>
                </div>


                <!-- =====================================================
                     SCHOOL LIST
                ====================================================== -->
                <div
                    class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
                >

                    <!-- Table Header -->
                    <div
                        class="flex flex-col gap-3 border-b border-slate-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6"
                    >
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="h-5 w-5 text-slate-600"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M4 5h16v14H4z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        d="M4 9h16M9 5v14"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-sm font-bold text-slate-900">
                                    Daftar Sekolah
                                </h3>

                                <p class="mt-0.5 text-xs text-slate-500">
                                    {{ schools.length }} sekolah terdaftar
                                </p>
                            </div>
                        </div>

                        <!-- Summary -->
                        <div class="flex items-center gap-2">
                            <div
                                class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-medium text-emerald-700"
                            >
                                <span
                                    class="h-1.5 w-1.5 rounded-full bg-emerald-500"
                                ></span>

                                {{
                                    schools.filter(
                                        school => school.is_active
                                    ).length
                                }}
                                Aktif
                            </div>

                            <div
                                class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-medium text-slate-600"
                            >
                                {{
                                    schools.filter(
                                        school => !school.is_active
                                    ).length
                                }}
                                Nonaktif
                            </div>
                        </div>
                    </div>


                    <!-- Desktop Table -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead>
                                <tr
                                    class="border-b border-slate-100 bg-slate-50/80"
                                >
                                    <th
                                        class="px-6 py-3.5 text-[11px] font-bold uppercase tracking-wider text-slate-500"
                                    >
                                        Kode
                                    </th>

                                    <th
                                        class="px-6 py-3.5 text-[11px] font-bold uppercase tracking-wider text-slate-500"
                                    >
                                        Nama Sekolah
                                    </th>

                                    <th
                                        class="px-6 py-3.5 text-[11px] font-bold uppercase tracking-wider text-slate-500"
                                    >
                                        Jenis
                                    </th>

                                    <th
                                        class="px-6 py-3.5 text-[11px] font-bold uppercase tracking-wider text-slate-500"
                                    >
                                        Status
                                    </th>

                                    <th
                                        class="px-6 py-3.5 text-right text-[11px] font-bold uppercase tracking-wider text-slate-500"
                                    >
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr
                                    v-for="school in schools"
                                    :key="school.id"
                                    class="border-b border-slate-100 last:border-0 transition-colors hover:bg-slate-50/70"
                                >
                                    <!-- Code -->
                                    <td
                                        class="whitespace-nowrap px-6 py-4 font-mono text-xs font-medium text-slate-500"
                                    >
                                        {{ school.school_code }}
                                    </td>

                                    <!-- Name -->
                                    <td class="px-6 py-4">
                                        <div
                                            class="flex items-center gap-3"
                                        >
                                            <div
                                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50"
                                            >
                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                    class="h-4 w-4 text-[#28558f]"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M3 21h18"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M5 21V6l7-3 7 3v15"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M9 21v-4h6v4"
                                                    />
                                                </svg>
                                            </div>

                                            <div>
                                                <div
                                                    class="font-semibold text-slate-900"
                                                >
                                                    {{ school.official_name }}
                                                </div>

                                                <div
                                                    class="mt-0.5 text-xs text-slate-400"
                                                >
                                                    Sekolah {{ school.school_type }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Type -->
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600"
                                        >
                                            {{ school.school_type }}
                                        </span>
                                    </td>

                                    <!-- Status -->
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-semibold"
                                            :class="
                                                school.is_active
                                                    ? 'bg-emerald-50 text-emerald-700'
                                                    : 'bg-slate-100 text-slate-500'
                                            "
                                        >
                                            <span
                                                class="h-1.5 w-1.5 rounded-full"
                                                :class="
                                                    school.is_active
                                                        ? 'bg-emerald-500'
                                                        : 'bg-slate-400'
                                                "
                                            ></span>

                                            {{
                                                school.is_active
                                                    ? 'Aktif'
                                                    : 'Nonaktif'
                                            }}
                                        </span>
                                    </td>

                                    <!-- Action -->
                                    <td class="px-6 py-4 text-right">
                                        <button
                                            @click="toggle(school.id)"
                                            class="inline-flex items-center gap-1.5 rounded-lg px-3 py-2 text-xs font-semibold transition-colors"
                                            :class="
                                                school.is_active
                                                    ? 'text-red-600 hover:bg-red-50'
                                                    : 'text-emerald-600 hover:bg-emerald-50'
                                            "
                                        >
                                            <svg
                                                v-if="school.is_active"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                class="h-4 w-4"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M6 6l12 12M18 6L6 18"
                                                />
                                            </svg>

                                            <svg
                                                v-else
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                class="h-4 w-4"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M12 5v14M5 12h14"
                                                />
                                            </svg>

                                            {{
                                                school.is_active
                                                    ? 'Nonaktifkan'
                                                    : 'Aktifkan'
                                            }}
                                        </button>
                                    </td>
                                </tr>

                                <!-- Empty -->
                                <tr v-if="schools.length === 0">
                                    <td
                                        colspan="5"
                                        class="px-6 py-16 text-center"
                                    >
                                        <div
                                            class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100"
                                        >
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                                class="h-7 w-7 text-slate-400"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M3 21h18"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M5 21V6l7-3 7 3v15"
                                                />
                                            </svg>
                                        </div>

                                        <p
                                            class="mt-4 text-sm font-semibold text-slate-700"
                                        >
                                            Belum ada data sekolah
                                        </p>

                                        <p
                                            class="mt-1 text-xs text-slate-400"
                                        >
                                            Tambahkan sekolah menggunakan formulir di atas.
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <!-- =================================================
                         MOBILE CARDS
                    ================================================== -->
                    <div class="md:hidden divide-y divide-slate-100">

                        <div
                            v-for="school in schools"
                            :key="school.id"
                            class="p-5"
                        >
                            <div
                                class="flex items-start justify-between gap-4"
                            >
                                <div class="flex items-center gap-3 min-w-0">
                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="h-5 w-5 text-[#28558f]"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3 21h18"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 21V6l7-3 7 3v15"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M9 21v-4h6v4"
                                            />
                                        </svg>
                                    </div>

                                    <div class="min-w-0">
                                        <div
                                            class="truncate text-sm font-bold text-slate-900"
                                        >
                                            {{ school.official_name }}
                                        </div>

                                        <div
                                            class="mt-1 text-xs text-slate-400"
                                        >
                                            {{ school.school_code }}
                                        </div>
                                    </div>
                                </div>

                                <span
                                    class="inline-flex shrink-0 items-center gap-1.5 rounded-full px-2.5 py-1 text-[10px] font-semibold"
                                    :class="
                                        school.is_active
                                            ? 'bg-emerald-50 text-emerald-700'
                                            : 'bg-slate-100 text-slate-500'
                                    "
                                >
                                    <span
                                        class="h-1.5 w-1.5 rounded-full"
                                        :class="
                                            school.is_active
                                                ? 'bg-emerald-500'
                                                : 'bg-slate-400'
                                        "
                                    ></span>

                                    {{
                                        school.is_active
                                            ? 'Aktif'
                                            : 'Nonaktif'
                                    }}
                                </span>
                            </div>

                            <div
                                class="mt-4 flex items-center justify-between"
                            >
                                <span
                                    class="inline-flex rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600"
                                >
                                    {{ school.school_type }}
                                </span>

                                <button
                                    @click="toggle(school.id)"
                                    class="inline-flex items-center gap-1.5 rounded-lg px-3 py-2 text-xs font-semibold"
                                    :class="
                                        school.is_active
                                            ? 'bg-red-50 text-red-600'
                                            : 'bg-emerald-50 text-emerald-600'
                                    "
                                >
                                    {{
                                        school.is_active
                                            ? 'Nonaktifkan'
                                            : 'Aktifkan'
                                    }}
                                </button>
                            </div>
                        </div>


                        <!-- Mobile Empty -->
                        <div
                            v-if="schools.length === 0"
                            class="px-5 py-14 text-center"
                        >
                            <div
                                class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    class="h-7 w-7 text-slate-400"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 21h18"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5 21V6l7-3 7 3v15"
                                    />
                                </svg>
                            </div>

                            <p
                                class="mt-4 text-sm font-semibold text-slate-700"
                            >
                                Belum ada data sekolah
                            </p>

                            <p
                                class="mt-1 text-xs text-slate-400"
                            >
                                Tambahkan sekolah menggunakan formulir di atas.
                            </p>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>