function toggleDropdown() {
    const menu = document.getElementById('dropdownMenu');
    menu.style.display = (menu.style.display === 'flex') ? 'none' : 'flex';
  }

  // Optional: Close dropdown if clicked outside
  window.addEventListener('click', function (e) {
    const dropdown = document.getElementById('dropdownMenu');
    if (!e.target.closest('.dropdown')) {
      dropdown.style.display = 'none';
    }
  });