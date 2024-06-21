function showContent(menu) {
    let content = document.getElementById('content');
    switch(menu) {
        case 'dashboard':
            content.innerHTML = '<h1>Dashboard</h1><p>Ini adalah halaman Dashboard.</p>';
            break;
        case 'project':
            content.innerHTML = '<h1>Project</h1><p>Ini adalah halaman Project.</p>';
            break;
        case 'tugas-kuliah':
            content.innerHTML = '<h1>Tugas Kuliah</h1><p>Ini adalah halaman Tugas Kuliah.</p>';
            break;
        case 'catatan-kuliah':
            content.innerHTML = '<h1>Catatan Kuliah</h1><p>Ini adalah halaman Catatan Kuliah.</p>';
            break;
        case 'jadwal-kuliah':
            content.innerHTML = '<h1>Jadwal Kuliah</h1><p>Ini adalah halaman Jadwal Kuliah.</p>';
            break;
        default:
            content.innerHTML = '<h1>Selamat Datang!</h1><p>Silakan pilih menu di sidebar.</p>';
    }
}

function logout() {
    alert('Anda telah logout.');
}
