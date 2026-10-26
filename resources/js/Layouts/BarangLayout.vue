```vue
<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div class="min-h-screen bg-slate-100 text-slate-800">
        <nav class="bg-blue-700 text-white shadow-lg">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">
                <Link href="/barang" class="text-xl font-bold">
                    📦 Sistem Inventaris
                </Link>

                <Link
                    href="/barang"
                    class="rounded-lg bg-blue-600 px-4 py-2 font-medium hover:bg-blue-500"
                >
                    Data Barang
                </Link>
            </div>
        </nav>

        <main class="mx-auto max-w-7xl px-6 py-10">
            <slot />
        </main>

        <footer class="mt-12 border-t bg-white py-5 text-center text-sm text-slate-500">
            © 2026 Sistem Inventaris Barang
        </footer>
    </div>
</template>
