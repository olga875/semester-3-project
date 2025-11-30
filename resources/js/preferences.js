document.addEventListener('click', (e) => {
  const button = e.target.closest('.preset button');
  if (!button) return;
  document.querySelectorAll('.preset').forEach(p => p.classList.remove('active'));
  button.closest('.preset').classList.add('active');
});
