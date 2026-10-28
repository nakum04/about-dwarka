        </main>
        
        <footer style="padding: 16px 28px; background: #fff; border-top: 1px solid var(--border); font-size: 0.82rem; color: var(--text-muted); display: flex; justify-content: space-between; align-items: center; flex-wrap: gap;">
            <div>© <?= date('Y') ?> દ્વારકા યાત્રા પોર્ટલ એડમિન પેનલ (Dwarka Tourism CMS)</div>
            <div>સ્થિતિ: <span style="color: #10b981; font-weight: 600;"><i class="fa-solid fa-circle" style="font-size: 0.6rem;"></i> ડેટાબેઝ સક્રિય છે</span></div>
        </footer>
    </div>
</div>

<script>
// Sidebar Toggle for Mobile
const sidebarToggle = document.getElementById('sidebarToggle');
const adminSidebar = document.getElementById('adminSidebar');
if (sidebarToggle && adminSidebar) {
    sidebarToggle.addEventListener('click', () => {
        adminSidebar.classList.toggle('open');
    });
}

// Confirmation helper for deletes
function confirmDelete(message) {
    return confirm(message || 'શું તમે ખરેખર આ રેકોર્ડ કાઢી નાખવા માંગો છો? આ ક્રિયા રદ થઈ શકશે નહીં.');
}
</script>
</body>
</html>
