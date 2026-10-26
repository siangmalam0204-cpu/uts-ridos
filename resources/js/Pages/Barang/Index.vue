
<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import { ref, watch, onBeforeUnmount } from 'vue'

const props = defineProps({
    items: {
        type: Object,
        required: true,
    },
    filters: {
        type: Object,
        default: () => ({ search: '' }),
    },
})

const search = ref(props.filters.search || '')
let timer = null

watch(search, (value) => {
    clearTimeout(timer)

    timer = setTimeout(() => {
        router.get('/barang', { search: value }, {
            preserveState: true,
            preserveScroll: true,
            replace: true,
        })
    }, 350)
})

onBeforeUnmount(() => {
    clearTimeout(timer)
})

function hapusBarang(item) {
    if (confirm(`Yakin ingin menghapus barang "${item.nama_barang}"?`)) {
        router.delete(`/barang/${item.id}`, {
            preserveScroll: true,
        })
    }
}
</script>

<template>
    <Head title="Daftar Barang" />

    <div class="min-h-screen bg-slate-100 text-slate-800">
        <header class="bg-blue-700 text-white shadow">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">
                <h1 class="text-xl font-bold">
                    📦 Sistem Inventaris
                </h1>

                <span class="rounded-lg bg-blue-600 px-4 py-2 font-semibold">
                    Data Barang
                </span>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-6 py-10">
            <div class="mb-8 flex flex-col justify-between gap-5 sm:flex-row sm:items-center">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                        Manajemen Inventaris
                    </p>

                    <h2 class="mt-2 text-3xl font-bold">
                        Daftar Barang
                    </h2>

                    <p class="mt-2 text-slate-500">
                        Kelola dan pantau seluruh inventaris barang kantor.
                    </p>
                </div>

                <a
                    href="/barang/create"
                    class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 font-semibold text-white shadow transition hover:bg-blue-700"
                >
                    + Tambah Barang
                </a>
            </div>

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex flex-col justify-between gap-4 p-6 md:flex-row md:items-center">
                    <div>
                        <h3 class="text-xl font-bold">
                            Daftar Inventaris
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Cari berdasarkan kode, nama, kategori, atau lokasi.
                        </p>
                    </div>

                    <input
                        v-model="search"
                        type="search"
                        placeholder="Cari barang..."
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 md:max-w-md"
                    />
                </div>

                <div class="overflow-x-auto px-6 pb-6">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 text-slate-600">
                            <tr>
                                <th class="px-4 py-4">No.</th>
                                <th class="px-4 py-4">Kode Barang</th>
                                <th class="px-4 py-4">Nama Barang</th>
                                <th class="px-4 py-4">Kategori</th>
                                <th class="px-4 py-4">Jumlah</th>
                                <th class="px-4 py-4">Lokasi Simpan</th>
                                <th class="px-4 py-4">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            <tr
                                v-for="(item, index) in items.data"
                                :key="item.id"
                                class="transition hover:bg-blue-50"
                            >
                                <td class="px-4 py-4">
                                    {{ (items.current_page - 1) * items.per_page + index + 1 }}
                                </td>

                                <td class="px-4 py-4 font-semibold text-blue-700">
                                    {{ item.kode_barang }}
                                </td>

                                <td class="px-4 py-4 font-medium">
                                    {{ item.nama_barang }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ item.kategori }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ item.jumlah }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ item.lokasi_simpan }}
                                </td>

                                <td class="px-4 py-4">
                                    <div class="flex gap-2">
                                        <Link
                                            :href="`/barang/${item.id}/edit`"
                                            class="rounded-lg bg-amber-100 px-3 py-2 font-semibold text-amber-700 hover:bg-amber-200"
                                        >
                                            Edit
                                        </Link>

                                        <button
                                            type="button"
                                            @click="hapusBarang(item)"
                                            class="rounded-lg bg-red-100 px-3 py-2 font-semibold text-red-700 hover:bg-red-200"
                                        >
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr v-if="items.data.length === 0">
                                <td colspan="7" class="px-4 py-12 text-center">
                                    <div class="text-4xl">📦</div>

                                    <p class="mt-3 font-semibold">
                                        Belum ada data barang
                                    </p>

                                    <p class="mt-1 text-slate-500">
                                        Tambahkan barang untuk mulai mengisi inventaris.
                                    </p>

                                    <a
                                        href="/barang/create"
                                        class="mt-4 inline-block rounded-lg bg-blue-600 px-4 py-2 font-semibold text-white hover:bg-blue-700"
                                    >
                                        + Tambah Barang
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-200 px-6 py-4">
                    <p class="text-sm text-slate-500">
                        Total {{ items.total }} barang
                    </p>

                    <div class="flex flex-wrap gap-2">
                        <template v-for="link in items.links" :key="link.label">
                            <Link
                                v-if="link.url"
                                :href="link.url"
                                v-html="link.label"
                                class="rounded-lg border px-3 py-2 text-sm"
                                :class="link.active
                                    ? 'border-blue-600 bg-blue-600 text-white'
                                    : 'border-slate-300 bg-white hover:bg-slate-100'"
                            />

                            <span
                                v-else
                                v-html="link.label"
                                class="rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-400"
                            />
                        </template>
                    </div>
                </div>
            </section>
        </main>

        <footer class="py-6 text-center text-sm text-slate-500">
            © 2026 Sistem Inventaris Barang
        </footer>
    </div>
</template>
