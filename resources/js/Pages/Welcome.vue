<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Sistem Monitoring Gaji Cabdin" />

    <div class="min-h-screen bg-slate-50 text-slate-900 flex flex-col">

        <!-- =========================================================
             NAVBAR
        ========================================================== -->
        <header class="bg-white border-b border-slate-200">
            <div
                class="max-w-7xl mx-auto px-6 lg:px-10 h-[72px] flex items-center justify-between"
            >
                <!-- Brand -->
                <div class="flex items-center gap-3">
                    <img
                        src="/images/logo-jatim.png"
                        alt="Logo Jawa Timur"
                        class="w-10 h-10 object-contain"
                    />

                    <div class="leading-tight">
                        <div
                            class="font-bold text-slate-950 text-base sm:text-lg"
                        >
                            Sistem Monitoring Gaji
                        </div>

                        <div
                            class="hidden sm:block text-xs text-slate-500 mt-0.5"
                        >
                            Cabang Dinas Pendidikan Wilayah Kabupaten Malang
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="flex items-center gap-3 sm:gap-7">
                    <a
                        href="#tentang"
                        class="hidden sm:inline text-sm font-medium text-slate-600 hover:text-slate-950 transition-colors"
                    >
                        Tentang Kami
                    </a>

                    <Link
                        :href="route('login')"
                        class="inline-flex items-center justify-center bg-[#28558f] hover:bg-[#1f4678] text-white text-sm font-semibold px-6 py-2.5 rounded-full shadow-sm transition-all duration-200 hover:shadow-md"
                    >
                        Masuk
                    </Link>
                </div>
            </div>
        </header>


        <!-- =========================================================
             HERO
        ========================================================== -->
        <main class="flex-1">

            <section
                class="relative overflow-hidden bg-gradient-to-b from-white to-slate-50"
            >
                <!-- Decorative background -->
                <div
                    class="absolute top-0 right-0 w-[44%] h-[430px] bg-[#294d7a] hidden lg:block"
                ></div>

                <div
                    class="absolute top-0 right-0 w-[44%] h-[430px] bg-gradient-to-br from-[#315b8d] to-[#233f63] opacity-90 hidden lg:block"
                ></div>

                <div
                    class="relative max-w-7xl mx-auto px-6 lg:px-10 pt-14 lg:pt-14 pb-12"
                >
                    <div
                        class="grid lg:grid-cols-[0.95fr_1.05fr] gap-10 lg:gap-14 items-center"
                    >

                        <!-- =================================================
                             HERO COPY
                        ================================================== -->
                        <div class="max-w-2xl">

                            <h1
                                class="text-[42px] sm:text-[52px] lg:text-[56px] leading-[1.04] tracking-[-0.035em] font-bold text-[#101d33]"
                            >
                                Digitalisasi Monitoring
                                <br />
                                Gaji & Payroll Cabdin
                            </h1>

                            <p
                                class="mt-6 text-base sm:text-lg leading-7 text-slate-600 max-w-xl"
                            >
                                Transformasi pengelolaan gaji dan payroll Cabang
                                Dinas Pendidikan. Tinggalkan proses manual
                                berbasis file WhatsApp dan beralih ke alur kerja
                                digital yang terstruktur, transparan, dan efisien.
                            </p>

                            <div class="mt-8 flex flex-wrap items-center gap-4">
                                <Link
                                    :href="route('login')"
                                    class="inline-flex items-center gap-2 bg-[#28558f] hover:bg-[#1f4678] text-white font-semibold px-6 py-3 rounded-full shadow-sm hover:shadow-lg transition-all duration-200"
                                >
                                    Pelajari Lebih Lanjut

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


                        <!-- =================================================
                             DASHBOARD PREVIEW
                        ================================================== -->
                        <div class="relative lg:pl-3">

                            <!-- Decorative shadow -->
                            <div
                                class="absolute -inset-4 bg-blue-900/10 blur-2xl rounded-3xl"
                            ></div>

                            <div
                                class="relative bg-white rounded-xl overflow-hidden border border-slate-200 shadow-2xl"
                            >

                                <!-- Preview Header -->
                                <div
                                    class="h-12 px-4 flex items-center justify-between border-b border-slate-200"
                                >
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-3 h-3 rounded-lg bg-[#172c48] flex items-center justify-center"
                                        >
                                            <span
                                                class="w-1.5 h-1.5 rounded-full bg-white"
                                            ></span>
                                        </div>

                                        <span
                                            class="font-bold text-xs text-slate-800"
                                        >
                                            Status Gaji & Payroll Cabdin
                                        </span>
                                    </div>

                                    <div class="flex gap-1">
                                        <span
                                            class="w-1.5 h-1.5 rounded-full bg-slate-300"
                                        ></span>

                                        <span
                                            class="w-1.5 h-1.5 rounded-full bg-slate-300"
                                        ></span>

                                        <span
                                            class="w-1.5 h-1.5 rounded-full bg-slate-300"
                                        ></span>
                                    </div>
                                </div>


                                <!-- Preview Body -->
                                <div class="p-4 sm:p-5">

                                    <!-- Search -->
                                    <div class="mb-4">
                                        <div
                                            class="w-full sm:w-64 h-8 border border-slate-200 rounded-md flex items-center px-2.5 gap-2 text-[10px] text-slate-400"
                                        >
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                class="w-3.5 h-3.5"
                                            >
                                                <circle
                                                    cx="11"
                                                    cy="11"
                                                    r="7"
                                                />

                                                <path d="M20 20l-4-4" />
                                            </svg>

                                            Cari sekolah atau pegawai...
                                        </div>
                                    </div>


                                    <!-- =================================================
                                         MONITORING FLOW
                                         Dibuat menggunakan flex + connector terpisah.
                                         Ini membuat garis benar-benar menghubungkan
                                         titik tengah setiap step.
                                    ================================================== -->
                                    <div
                                        class="border border-slate-200 rounded-lg p-4 sm:p-5"
                                    >

                                        <!-- Flow Header -->
                                        <div class="mb-5">
                                            <div
                                                class="text-[11px] font-bold text-slate-800"
                                            >
                                                Alur Monitoring Gaji & Payroll
                                            </div>

                                            <div
                                                class="text-[9px] text-slate-400 mt-0.5"
                                            >
                                                Dari penerimaan rekap hingga
                                                persetujuan payroll oleh Cabdin
                                            </div>
                                        </div>


                                        <!-- =================================================
                                             DESKTOP FLOW
                                        ================================================== -->
                                        <div class="hidden md:block">

                                            <div
                                                class="flex items-start w-full"
                                            >

                                                <!-- STEP 1 -->
                                                <div
                                                    class="w-[18%] shrink-0 text-center"
                                                >
                                                    <div
                                                        class="relative z-10 w-10 h-10 mx-auto rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center"
                                                    >
                                                        <svg
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="#28558f"
                                                            stroke-width="2"
                                                            class="w-5 h-5"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M7 3h8l4 4v14H7a2 2 0 01-2-2V5a2 2 0 012-2z"
                                                            />

                                                            <path
                                                                stroke-linecap="round"
                                                                d="M14 3v5h5M9 12h6M9 16h5"
                                                            />
                                                        </svg>
                                                    </div>

                                                    <div
                                                        class="mt-2 text-[10px] font-bold text-slate-800 whitespace-nowrap"
                                                    >
                                                        Rekap Gaji
                                                    </div>

                                                    <div
                                                        class="mt-0.5 text-[8px] text-slate-400"
                                                    >
                                                        Diterima
                                                    </div>
                                                </div>


                                                <!-- CONNECTOR 1 -->
                                                <div
                                                    class="flex-1 flex items-center pt-5 px-1"
                                                >
                                                    <div
                                                        class="h-px w-full bg-slate-300 relative"
                                                    >
                                                        <span
                                                            class="absolute right-0 -top-[3px] w-2 h-2 border-t border-r border-slate-300 rotate-45"
                                                        ></span>
                                                    </div>
                                                </div>


                                                <!-- STEP 2 -->
                                                <div
                                                    class="w-[18%] shrink-0 text-center"
                                                >
                                                    <div
                                                        class="relative z-10 w-10 h-10 mx-auto rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center"
                                                    >
                                                        <svg
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="#28558f"
                                                            stroke-width="2"
                                                            class="w-5 h-5"
                                                        >
                                                            <circle
                                                                cx="11"
                                                                cy="11"
                                                                r="7"
                                                            />

                                                            <path
                                                                stroke-linecap="round"
                                                                d="M20 20l-4-4"
                                                            />
                                                        </svg>
                                                    </div>

                                                    <div
                                                        class="mt-2 text-[10px] font-bold text-slate-800 whitespace-nowrap"
                                                    >
                                                        Pengecekan
                                                    </div>

                                                    <div
                                                        class="mt-0.5 text-[8px] text-slate-400"
                                                    >
                                                        Operator
                                                    </div>
                                                </div>


                                                <!-- CONNECTOR 2 -->
                                                <div
                                                    class="flex-1 flex items-center pt-5 px-1"
                                                >
                                                    <div
                                                        class="h-px w-full bg-slate-300 relative"
                                                    >
                                                        <span
                                                            class="absolute right-0 -top-[3px] w-2 h-2 border-t border-r border-slate-300 rotate-45"
                                                        ></span>
                                                    </div>
                                                </div>


                                                <!-- STEP 3 -->
                                                <div
                                                    class="w-[18%] shrink-0 text-center"
                                                >
                                                    <div
                                                        class="relative z-10 w-10 h-10 mx-auto rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center"
                                                    >
                                                        <svg
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="#278557"
                                                            stroke-width="2"
                                                            class="w-5 h-5"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M5 12l4 4L19 6"
                                                            />
                                                        </svg>
                                                    </div>

                                                    <div
                                                        class="mt-2 text-[10px] font-bold text-slate-800 whitespace-nowrap"
                                                    >
                                                        FIX
                                                    </div>

                                                    <div
                                                        class="mt-0.5 text-[8px] text-slate-400"
                                                    >
                                                        Data sesuai
                                                    </div>
                                                </div>


                                                <!-- CONNECTOR 3 -->
                                                <div
                                                    class="flex-1 flex items-center pt-5 px-1"
                                                >
                                                    <div
                                                        class="h-px w-full bg-slate-300 relative"
                                                    >
                                                        <span
                                                            class="absolute right-0 -top-[3px] w-2 h-2 border-t border-r border-slate-300 rotate-45"
                                                        ></span>
                                                    </div>
                                                </div>


                                                <!-- STEP 4 -->
                                                <div
                                                    class="w-[18%] shrink-0 text-center"
                                                >
                                                    <div
                                                        class="relative z-10 w-10 h-10 mx-auto rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center"
                                                    >
                                                        <svg
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="#28558f"
                                                            stroke-width="2"
                                                            class="w-5 h-5"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M12 16V4"
                                                            />

                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M7 9l5-5 5 5"
                                                            />

                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M5 20h14"
                                                            />
                                                        </svg>
                                                    </div>

                                                    <div
                                                        class="mt-2 text-[10px] font-bold text-slate-800 whitespace-nowrap"
                                                    >
                                                        Payroll
                                                    </div>

                                                    <div
                                                        class="mt-0.5 text-[8px] text-slate-400"
                                                    >
                                                        Dikirim
                                                    </div>
                                                </div>


                                                <!-- CONNECTOR 4 -->
                                                <div
                                                    class="flex-1 flex items-center pt-5 px-1"
                                                >
                                                    <div
                                                        class="h-px w-full bg-slate-300 relative"
                                                    >
                                                        <span
                                                            class="absolute right-0 -top-[3px] w-2 h-2 border-t border-r border-slate-300 rotate-45"
                                                        ></span>
                                                    </div>
                                                </div>


                                                <!-- STEP 5 -->
                                                <div
                                                    class="w-[18%] shrink-0 text-center"
                                                >
                                                    <div
                                                        class="relative z-10 w-10 h-10 mx-auto rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center"
                                                    >
                                                        <svg
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="#c28a16"
                                                            stroke-width="2"
                                                            class="w-5 h-5"
                                                        >
                                                            <circle
                                                                cx="12"
                                                                cy="12"
                                                                r="8"
                                                            />

                                                            <path
                                                                stroke-linecap="round"
                                                                d="M12 8v4l3 2"
                                                            />
                                                        </svg>
                                                    </div>

                                                    <div
                                                        class="mt-2 text-[10px] font-bold text-slate-800 whitespace-nowrap"
                                                    >
                                                        Approval Cabdin
                                                    </div>

                                                    <div
                                                        class="mt-0.5 text-[8px] text-slate-400"
                                                    >
                                                        Menunggu
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                        <!-- =================================================
                                             MOBILE FLOW
                                        ================================================== -->
                                        <div class="md:hidden">

                                            <!-- STEP 1 -->
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-9 h-9 shrink-0 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center"
                                                >
                                                    <svg
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="#28558f"
                                                        stroke-width="2"
                                                        class="w-4 h-4"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M7 3h8l4 4v14H7a2 2 0 01-2-2V5a2 2 0 012-2z"
                                                        />

                                                        <path
                                                            stroke-linecap="round"
                                                            d="M14 3v5h5M9 12h6M9 16h5"
                                                        />
                                                    </svg>
                                                </div>

                                                <div>
                                                    <div
                                                        class="text-[10px] font-bold text-slate-800"
                                                    >
                                                        Rekap Gaji
                                                    </div>

                                                    <div
                                                        class="text-[8px] text-slate-400"
                                                    >
                                                        Diterima
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- CONNECTOR -->
                                            <div
                                                class="ml-[18px] h-5 border-l border-slate-300"
                                            ></div>


                                            <!-- STEP 2 -->
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-9 h-9 shrink-0 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center"
                                                >
                                                    <svg
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="#28558f"
                                                        stroke-width="2"
                                                        class="w-4 h-4"
                                                    >
                                                        <circle
                                                            cx="11"
                                                            cy="11"
                                                            r="7"
                                                        />

                                                        <path
                                                            stroke-linecap="round"
                                                            d="M20 20l-4-4"
                                                        />
                                                    </svg>
                                                </div>

                                                <div>
                                                    <div
                                                        class="text-[10px] font-bold text-slate-800"
                                                    >
                                                        Pengecekan
                                                    </div>

                                                    <div
                                                        class="text-[8px] text-slate-400"
                                                    >
                                                        Operator
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- CONNECTOR -->
                                            <div
                                                class="ml-[18px] h-5 border-l border-slate-300"
                                            ></div>


                                            <!-- STEP 3 -->
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-9 h-9 shrink-0 rounded-lg bg-emerald-50 border border-emerald-100 flex items-center justify-center"
                                                >
                                                    <svg
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="#278557"
                                                        stroke-width="2"
                                                        class="w-4 h-4"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M5 12l4 4L19 6"
                                                        />
                                                    </svg>
                                                </div>

                                                <div>
                                                    <div
                                                        class="text-[10px] font-bold text-slate-800"
                                                    >
                                                        FIX
                                                    </div>

                                                    <div
                                                        class="text-[8px] text-slate-400"
                                                    >
                                                        Data sesuai
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- CONNECTOR -->
                                            <div
                                                class="ml-[18px] h-5 border-l border-slate-300"
                                            ></div>


                                            <!-- STEP 4 -->
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-9 h-9 shrink-0 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center"
                                                >
                                                    <svg
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="#28558f"
                                                        stroke-width="2"
                                                        class="w-4 h-4"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M12 16V4"
                                                        />

                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M7 9l5-5 5 5"
                                                        />

                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M5 20h14"
                                                        />
                                                    </svg>
                                                </div>

                                                <div>
                                                    <div
                                                        class="text-[10px] font-bold text-slate-800"
                                                    >
                                                        Payroll
                                                    </div>

                                                    <div
                                                        class="text-[8px] text-slate-400"
                                                    >
                                                        Dikirim
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- CONNECTOR -->
                                            <div
                                                class="ml-[18px] h-5 border-l border-slate-300"
                                            ></div>


                                            <!-- STEP 5 -->
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-9 h-9 shrink-0 rounded-lg bg-amber-50 border border-amber-100 flex items-center justify-center"
                                                >
                                                    <svg
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="#c28a16"
                                                        stroke-width="2"
                                                        class="w-4 h-4"
                                                    >
                                                        <circle
                                                            cx="12"
                                                            cy="12"
                                                            r="8"
                                                        />

                                                        <path
                                                            stroke-linecap="round"
                                                            d="M12 8v4l3 2"
                                                        />
                                                    </svg>
                                                </div>

                                                <div>
                                                    <div
                                                        class="text-[10px] font-bold text-slate-800"
                                                    >
                                                        Approval Cabdin
                                                    </div>

                                                    <div
                                                        class="text-[8px] text-slate-400"
                                                    >
                                                        Menunggu
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <!-- =================================================
                                             DATA TABLE
                                        ================================================== -->
                                        <div
                                            class="mt-5 border border-slate-200 rounded-md overflow-hidden"
                                        >

                                            <!-- Table Header -->
                                            <div
                                                class="grid grid-cols-[1.2fr_1.1fr_0.6fr_0.8fr] bg-slate-50 px-2.5 py-2 text-[8px] font-semibold text-slate-500"
                                            >
                                                <span>Pegawai</span>
                                                <span>Sekolah</span>
                                                <span>Jenis</span>
                                                <span>Status</span>
                                            </div>


                                            <!-- Table Rows -->
                                            <div
                                                v-for="item in [
                                                    ['Budi Santoso', 'SMA Negeri 1', 'PNS', 'FIX'],
                                                    ['Siti Aminah', 'SMA Negeri 1', 'PPPK', 'FIX'],
                                                    ['Ahmad Yani', 'SMA Negeri 2', 'PNS', 'Perlu Perbaikan']
                                                ]"
                                                :key="item[0]"
                                                class="grid grid-cols-[1.2fr_1.1fr_0.6fr_0.8fr] px-2.5 py-2 border-t border-slate-100 text-[8px] text-slate-700 items-center"
                                            >
                                                <span class="font-medium">
                                                    {{ item[0] }}
                                                </span>

                                                <span>
                                                    {{ item[1] }}
                                                </span>

                                                <span>
                                                    {{ item[2] }}
                                                </span>

                                                <span>
                                                    <span
                                                        class="inline-flex px-1.5 py-0.5 rounded-full text-[7px] font-medium whitespace-nowrap"
                                                        :class="{
                                                            'bg-emerald-50 text-emerald-700':
                                                                item[3] === 'FIX',

                                                            'bg-red-50 text-red-700':
                                                                item[3] === 'Perlu Perbaikan'
                                                        }"
                                                    >
                                                        {{ item[3] }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>


                                        <!-- Preview Status -->
                                        <div
                                            class="mt-3 flex items-center justify-between text-[8px]"
                                        >
                                            <div class="text-slate-400">
                                                Periode:

                                                <span
                                                    class="font-medium text-slate-600"
                                                >
                                                    Juli 2026
                                                </span>
                                            </div>

                                            <div
                                                class="flex items-center gap-1.5"
                                            >
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full bg-emerald-500"
                                                ></span>

                                                <span class="text-slate-500">
                                                    2 data FIX
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


            <!-- =========================================================
                 FEATURES
            ========================================================== -->
            <section
                id="tentang"
                class="relative max-w-7xl mx-auto px-6 lg:px-10 pb-14 lg:pb-16"
            >
                <div class="grid md:grid-cols-3 gap-5">

                    <!-- Feature 1 -->
                    <div
                        class="group bg-white border border-slate-200 rounded-xl p-5 sm:p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200"
                    >
                        <div
                            class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center mb-5"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                class="w-6 h-6 text-[#28558f]"
                            >
                                <circle cx="12" cy="12" r="8" />

                                <path
                                    stroke-linecap="round"
                                    d="M12 8v4l2.5 2"
                                />
                            </svg>
                        </div>

                        <h2 class="text-lg font-bold text-slate-950">
                            Verifikasi Terstruktur
                        </h2>

                        <p
                            class="mt-2 text-sm leading-5 text-slate-600"
                        >
                            Mempermudah operator memeriksa rekap gaji PNS dan
                            PPPK sebelum data dinyatakan sesuai dan diproses ke
                            tahap payroll.
                        </p>
                    </div>


                    <!-- Feature 2 -->
                    <div
                        class="group bg-white border border-slate-200 rounded-xl p-5 sm:p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200"
                    >
                        <div
                            class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center mb-5"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="w-6 h-6 text-[#28558f]"
                            >
                                <circle cx="12" cy="12" r="2.5" />
                                <circle cx="5" cy="7" r="1.5" />
                                <circle cx="19" cy="7" r="1.5" />
                                <circle cx="5" cy="17" r="1.5" />
                                <circle cx="19" cy="17" r="1.5" />

                                <path
                                    d="M10 10L6.5 8.2M14 10l3.5-1.8M10 14l-3.5 1.8M14 14l3.5 1.8"
                                />
                            </svg>
                        </div>

                        <h2 class="text-lg font-bold text-slate-950">
                            Perbaikan Data Terpusat
                        </h2>

                        <p
                            class="mt-2 text-sm leading-5 text-slate-600"
                        >
                            Data yang belum sesuai dapat dikembalikan untuk
                            diperbaiki dan diverifikasi kembali tanpa kehilangan
                            riwayat proses.
                        </p>
                    </div>


                    <!-- Feature 3 -->
                    <div
                        class="group bg-white border border-slate-200 rounded-xl p-5 sm:p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200"
                    >
                        <div
                            class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center mb-5"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                class="w-6 h-6 text-[#28558f]"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 3h9l4 4v14H6V3z"
                                />

                                <path
                                    stroke-linecap="round"
                                    d="M14 3v5h5M9 13h6M9 17h6"
                                />
                            </svg>
                        </div>

                        <h2 class="text-lg font-bold text-slate-950">
                            Payroll & Approval
                        </h2>

                        <p
                            class="mt-2 text-sm leading-5 text-slate-600"
                        >
                            Setelah data PNS dan PPPK dinyatakan sesuai, operator
                            mengirim payroll untuk kemudian diperiksa dan
                            disetujui oleh Cabang Dinas.
                        </p>
                    </div>

                </div>
            </section>

        </main>


                <!-- =========================================================
                    FOOTER
                ========================================================== -->
                <footer class="bg-[#0d1e35] text-white">
                    <div class="mx-auto max-w-7xl px-6 py-6 lg:px-10">

                        <div
                            class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between"
                        >
                            <!-- Brand -->
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center">
                                    <img
                                        src="/images/logo-jatim.png"
                                        alt="Logo Jawa Timur"
                                        class="w-10 h-10 object-contain"
                                    />
                                </div>

                                <div class="leading-tight">
                                    <p class="text-sm font-medium text-slate-300">
                                        Sistem Monitoring Gaji
                                    </p>

                                    <p class="text-base font-bold">
                                        Cabdin Pendidikan Kab. Malang
                                    </p>
                                </div>
                            </div>


                            <!-- Institution & Contact -->
                            <div class="text-sm text-slate-300 lg:text-right">
                                <p class="font-semibold text-white">
                                    Cabang Dinas Pendidikan Wilayah Kabupaten Malang
                                </p>

                                <p class="mt-1 leading-5 text-slate-400">
                                    Jl. Simpang Ijen No. 2, Kel. Oro-oro Dowo,
                                    Kec. Klojen, Kota Malang, Jawa Timur
                                </p>

                                <div
                                    class="mt-2 flex flex-wrap gap-x-4 gap-y-1 lg:justify-end"
                                >
                                    <a
                                        href="mailto:cabdinmalang@gmail.com"
                                        class="transition hover:text-white"
                                    >
                                        cabdinmalang@gmail.com
                                    </a>

                                    <span class="text-slate-600">•</span>

                                    <a
                                        href="tel:+62215551234"
                                        class="transition hover:text-white"
                                    >
                                        (0341) 5081868
                                    </a>
                                </div>
                            </div>
                        </div>


                        <!-- Copyright -->
                        <div
                            class="mt-6 border-t border-white/10 pt-4 text-center text-xs text-slate-500"
                        >
                            © 2026 Cabdin. Semua hak dilindungi.
                        </div>

                    </div>
                </footer>

    </div>
</template>