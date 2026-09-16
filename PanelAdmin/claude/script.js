// Navegación entre secciones del sidebar
const sideLinks = document.querySelectorAll('.side-link');
const sections = document.querySelectorAll('.section-view');
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');

sideLinks.forEach(link => {
  link.addEventListener('click', e => {
    e.preventDefault();

    sideLinks.forEach(l => l.classList.remove('active'));
    link.classList.add('active');

    sections.forEach(s => s.classList.remove('active'));
    document.getElementById('view-' + link.dataset.target).classList.add('active');

    closeSidebar();
  });
});

// Sidebar en móvil
const toggleSidebarBtn = document.getElementById('toggleSidebar');

function openSidebar(){
  sidebar.classList.add('show');
  overlay.classList.add('show');
}

function closeSidebar(){
  sidebar.classList.remove('show');
  overlay.classList.remove('show');
}

toggleSidebarBtn.addEventListener('click', openSidebar);
overlay.addEventListener('click', closeSidebar);

// Modal de cierre de sesión
const logoutBtn = document.getElementById('logoutBtn');
const logoutModal = document.getElementById('logoutModal');
const cancelLogout = document.getElementById('cancelLogout');

logoutBtn.addEventListener('click', e => {
  e.preventDefault();
  logoutModal.classList.add('show');
});

cancelLogout.addEventListener('click', () => {
  logoutModal.classList.remove('show');
});

logoutModal.addEventListener('click', e => {
  if (e.target === logoutModal){
    logoutModal.classList.remove('show');
  }
});
