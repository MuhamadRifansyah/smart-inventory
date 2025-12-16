import './bootstrap'

import Alpine from 'alpinejs'
import Swal from 'sweetalert2'
import Chart from 'chart.js/auto'

// =============================
// GLOBAL WINDOW
// =============================
window.Alpine = Alpine
window.Swal = Swal
window.Chart = Chart

Alpine.start()

// =============================
// 🌙 DARK MODE GLOBAL
// =============================
window.toggleDarkMode = function () {
    const html = document.documentElement

    html.classList.toggle('dark')

    localStorage.setItem(
        'theme',
        html.classList.contains('dark') ? 'dark' : 'light'
    )
}

// =============================
// LOAD THEME SAAT PAGE LOAD
// =============================
if (localStorage.getItem('theme') === 'dark') {
    document.documentElement.classList.add('dark')
}
