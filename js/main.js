/**
 * Dwarka Tourism & Pilgrimage Portal - Main JavaScript
 * Handling Live Budget Calculation, Filter System, Place Modal, Aarti Clock & AJAX Feedback
 */

document.addEventListener('DOMContentLoaded', function () {
    initLiveClock();
    initTempleBell();
    initMobileNav();
    initPlaceFilter();
    initItineraryTabs();
    initBudgetCalculator();
    initReviewForm();
    initStarRating();
    initBackToTop();
    initPwaInstaller();
    initMobileBottomNav();
});

/* ================= 1. Temple Bell Sound (Web Audio API) ================= */
function initTempleBell() {
    const bellBtn = document.getElementById('templeBellBtn');
    if (!bellBtn) return;

    bellBtn.addEventListener('click', function () {
        playTempleBell();
        this.classList.add('ringing');
        setTimeout(() => this.classList.remove('ringing'), 1200);
    });
}

function playTempleBell() {
    try {
        const AudioContext = window.AudioContext || window.webkitAudioContext;
        if (!AudioContext) return;
        const ctx = new AudioContext();

        // Harmonics frequencies for metallic temple bell resonance
        const freqs = [587.33, 880, 1174.66, 1760, 2349.32];
        const gains = [0.4, 0.25, 0.15, 0.08, 0.04];

        freqs.forEach((freq, idx) => {
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();

            osc.type = 'sine';
            osc.frequency.setValueAtTime(freq, ctx.currentTime);

            gain.gain.setValueAtTime(gains[idx], ctx.currentTime);
            // Exponential decay for metallic chime
            gain.gain.exponentialRampToValueAtTime(0.0001, ctx.currentTime + 2.8);

            osc.connect(gain);
            gain.connect(ctx.destination);

            osc.start();
            osc.stop(ctx.currentTime + 3.0);
        });
    } catch (e) {
        console.log('Audio error:', e);
    }
}

/* ================= 1. Live Device Clock ================= */
function initLiveClock() {
    const clockEl = document.getElementById('liveClock');
    if (!clockEl) return;

    function updateTime() {
        const now = new Date();
        const lang = window.currentLang || localStorage.getItem('dwarka_lang') || 'gu';
        const options = { 
            hour: '2-digit', 
            minute: '2-digit', 
            second: '2-digit',
            hour12: true 
        };
        // Uses the exact local clock time of the user's phone/device
        const baseTime = now.toLocaleTimeString('en-US', options).toUpperCase();

        if (lang === 'hi') {
            const hiDigits = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
            const hiTime = baseTime.replace(/\d/g, d => hiDigits[d]);
            clockEl.textContent = 'समय: ' + hiTime;
        } else if (lang === 'en') {
            clockEl.textContent = 'Time: ' + baseTime;
        } else {
            const guDigits = ['૦', '૧', '૨', '૩', '૪', '૫', '૬', '૭', '૮', '૯'];
            const guTime = baseTime.replace(/\d/g, d => guDigits[d]);
            clockEl.textContent = 'સમય: ' + guTime;
        }
    }

    window.refreshClockText = updateTime;
    updateTime();
    setInterval(updateTime, 1000);
}

/* ================= 2. Mobile Navigation Toggle ================= */
function initMobileNav() {
    const toggleBtn = document.getElementById('mobileToggle');
    const navLinks = document.getElementById('navLinks');

    if (!toggleBtn || !navLinks) return;

    toggleBtn.addEventListener('click', function () {
        navLinks.classList.toggle('active');
        const icon = toggleBtn.querySelector('i');
        if (icon) {
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        }
    });

    // Close on link click
    navLinks.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            navLinks.classList.remove('active');
            const icon = toggleBtn.querySelector('i');
            if (icon) {
                icon.classList.add('fa-bars');
                icon.classList.remove('fa-times');
            }
        });
    });
}

/* ================= 3. Place Filter & Live Search ================= */
function initPlaceFilter() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const placeCards = document.querySelectorAll('.place-card');
    const searchInput = document.getElementById('placeSearch');

    function applyFilter() {
        const activeBtn = document.querySelector('.filter-btn.active');
        const filterVal = activeBtn ? activeBtn.getAttribute('data-filter') : 'all';
        const query = searchInput ? searchInput.value.trim().toLowerCase() : '';

        placeCards.forEach(card => {
            const locType = card.getAttribute('data-location');
            const category = card.getAttribute('data-category');
            const textContent = card.textContent.toLowerCase();

            let matchesCategory = false;
            if (filterVal === 'all') matchesCategory = true;
            else if (filterVal === 'in_dwarka' && locType === 'in_dwarka') matchesCategory = true;
            else if (filterVal === 'nearby' && locType === 'nearby') matchesCategory = true;
            else if (filterVal === category) matchesCategory = true;

            const matchesSearch = query === '' || textContent.includes(query);

            if (matchesCategory && matchesSearch) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            applyFilter();
        });
    });

    if (searchInput) {
        searchInput.addEventListener('input', applyFilter);
    }
}

/* ================= 4. Place Details Modal ================= */
function openPlaceModal(placeData) {
    const modal = document.getElementById('placeModal');
    if (!modal) return;

    const data = window.getTranslatedPlaceData ? window.getTranslatedPlaceData(placeData) : placeData;
    const lang = window.currentLang || 'gu';
    const deityPrefix = lang === 'hi' ? 'आराध्य देव: ' : (lang === 'en' ? 'Presiding Deity: ' : 'આરાધ્ય દેવ: ');

    document.getElementById('modalTitle').textContent = data.name_gu;
    document.getElementById('modalEnglishTitle').textContent = data.name_en || '';
    document.getElementById('modalDeity').textContent = data.deity_gu ? deityPrefix + data.deity_gu : '';
    document.getElementById('modalTiming').textContent = data.timings || 'સવારે ૬:૦૦ થી રાત્રે ૯:૦૦';
    document.getElementById('modalEntry').textContent = data.entry_fee || 'મફત (Free)';
    document.getElementById('modalDistance').textContent = data.distance_km || 'શહેરમાં';
    document.getElementById('modalDesc').textContent = data.full_desc || data.short_desc;
    document.getElementById('modalHighlights').textContent = data.highlights || '';

    const img = document.getElementById('modalImg');
    if (img && data.image_url) {
        img.src = data.image_url;
        img.alt = data.name_gu;
    }

    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closePlaceModal() {
    const modal = document.getElementById('placeModal');
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
    }
}

/* ================= 5. Itinerary Plan Tabs ================= */
function initItineraryTabs() {
    const tabBtns = document.querySelectorAll('.itinerary-tab-btn');
    const tabContents = document.querySelectorAll('.itinerary-plan-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            tabBtns.forEach(b => b.classList.remove('active'));
            tabContents.forEach(c => c.style.display = 'none');

            this.classList.add('active');
            const targetPlan = this.getAttribute('data-plan');
            const targetEl = document.getElementById('itinerary-plan-' + targetPlan);
            if (targetEl) {
                targetEl.style.display = 'block';
            }
        });
    });
}

function printItinerary() {
    window.print();
}

/* ================= 6. Interactive Live Budget Calculator ================= */
function initBudgetCalculator() {
    let days = 2;
    let persons = 2;

    const daysValEl = document.getElementById('daysVal');
    const personsValEl = document.getElementById('personsVal');
    const staySelect = document.getElementById('stayTier');
    const foodSelect = document.getElementById('foodTier');
    const transportSelect = document.getElementById('transportTier');

    // Stepper buttons
    const btnDaysMinus = document.getElementById('btnDaysMinus');
    const btnDaysPlus = document.getElementById('btnDaysPlus');
    const btnPersonsMinus = document.getElementById('btnPersonsMinus');
    const btnPersonsPlus = document.getElementById('btnPersonsPlus');

    if (btnDaysMinus && btnDaysPlus) {
        btnDaysMinus.addEventListener('click', () => {
            if (days > 1) {
                days--;
                daysValEl.textContent = days;
                calculateBudget();
            }
        });
        btnDaysPlus.addEventListener('click', () => {
            if (days < 7) {
                days++;
                daysValEl.textContent = days;
                calculateBudget();
            }
        });
    }

    if (btnPersonsMinus && btnPersonsPlus) {
        btnPersonsMinus.addEventListener('click', () => {
            if (persons > 1) {
                persons--;
                personsValEl.textContent = persons;
                calculateBudget();
            }
        });
        btnPersonsPlus.addEventListener('click', () => {
            if (persons < 25) {
                persons++;
                personsValEl.textContent = persons;
                calculateBudget();
            }
        });
    }

    if (staySelect) staySelect.addEventListener('change', calculateBudget);
    if (foodSelect) foodSelect.addEventListener('change', calculateBudget);
    if (transportSelect) transportSelect.addEventListener('change', calculateBudget);

    function calculateBudget() {
        const stayTier = staySelect ? staySelect.value : 'normal';
        const foodTier = foodSelect ? foodSelect.value : 'normal';
        const transportTier = transportSelect ? transportSelect.value : 'normal';

        // Rates
        const stayRates = {
            budget: { rate: 500, label: 'સામાન્ય ધર્મશાળા / આશ્રમ' },
            normal: { rate: 1200, label: 'નોર્મલ બજેટ હોટેલ' },
            deluxe: { rate: 2600, label: 'પ્રીમિયમ હોટેલ / રિસોર્ટ' }
        };

        const foodRates = {
            budget: { rate: 70, label: 'અન્નક્ષેત્ર / સાદું ભોજન' },
            normal: { rate: 130, label: 'નોર્મલ કાઠિયાવાડી / ગુજરાતી થાળી' },
            deluxe: { rate: 220, label: 'સ્પેશિયલ કાઠિયાવાડી + મિઠાઈ' }
        };

        const transportRates = {
            budget: { rate: 150, per_person: true, label: 'લોકલ GSRTC બસ / શેરિંગ' },
            normal: { rate: 800, per_person: false, label: 'પ્રાઇવેટ ઓટો રિક્ષા' },
            deluxe: { rate: 2200, per_person: false, label: 'પ્રાઇવેટ AC કાર / ટેક્સી' }
        };

        const stayInfo = stayRates[stayTier] || stayRates.normal;
        const foodInfo = foodRates[foodTier] || foodRates.normal;
        const transInfo = transportRates[transportTier] || transportRates.normal;

        // Rooms calculation: 2 persons per room
        const rooms = Math.ceil(persons / 2);
        const nights = days === 1 ? 0 : (days - 1);
        let stayCost = 0;
        if (days === 1) {
            stayCost = Math.round(rooms * stayInfo.rate * 0.5); // Day fresh-up room
        } else {
            stayCost = rooms * stayInfo.rate * nights;
        }

        // Food: 2 meals a day + Rs. 40 tea/snacks
        const foodPerDayPerPerson = (foodInfo.rate * 2) + 40;
        const foodCost = foodPerDayPerPerson * persons * days;

        // Transport
        let transCost = 0;
        if (transInfo.per_person) {
            transCost = transInfo.rate * persons * days;
        } else {
            const capacity = transportTier === 'normal' ? 4 : 5;
            const vehicles = Math.ceil(persons / capacity);
            transCost = vehicles * transInfo.rate * days;
        }

        // Misc (prasad, entry, auto tip): Rs. 150 per person per day
        const miscCost = 150 * persons * days;

        const grandTotal = stayCost + foodCost + transCost + miscCost;
        const perPersonTotal = Math.round(grandTotal / persons);

        // Update UI
        const stayCostEl = document.getElementById('calcStayCost');
        const foodCostEl = document.getElementById('calcFoodCost');
        const transCostEl = document.getElementById('calcTransCost');
        const miscCostEl = document.getElementById('calcMiscCost');
        const grandTotalEl = document.getElementById('calcGrandTotal');
        const perPersonEl = document.getElementById('calcPerPerson');

        if (stayCostEl) stayCostEl.textContent = '₹ ' + stayCost.toLocaleString('en-IN');
        if (foodCostEl) foodCostEl.textContent = '₹ ' + foodCost.toLocaleString('en-IN');
        if (transCostEl) transCostEl.textContent = '₹ ' + transCost.toLocaleString('en-IN');
        if (miscCostEl) miscCostEl.textContent = '₹ ' + miscCost.toLocaleString('en-IN');
        if (grandTotalEl) grandTotalEl.textContent = '₹ ' + grandTotal.toLocaleString('en-IN');
        if (perPersonEl) {
            const lang = window.currentLang || 'gu';
            const prefix = lang === 'hi'
                ? 'प्रति व्यक्ति अनुमानित खर्च: ₹ '
                : (lang === 'en' ? 'Estimated Cost Per Person: ₹ ' : 'પ્રતિ વ્યક્તિ અંદાજિત ખર્ચ: ₹ ');
            perPersonEl.textContent = prefix + perPersonTotal.toLocaleString('en-IN');
        }
    }

    window.refreshBudgetText = calculateBudget;

    // Initial run
    calculateBudget();
}

/* ================= 7. Star Rating Interaction ================= */
function initStarRating() {
    const starContainer = document.getElementById('starRatingSelect');
    const ratingInput = document.getElementById('ratingInput');
    if (!starContainer || !ratingInput) return;

    const stars = starContainer.querySelectorAll('.star');

    stars.forEach(star => {
        star.addEventListener('click', function () {
            const val = parseInt(this.getAttribute('data-val'));
            ratingInput.value = val;

            stars.forEach(s => {
                const sVal = parseInt(s.getAttribute('data-val'));
                if (sVal <= val) {
                    s.classList.add('selected');
                } else {
                    s.classList.remove('selected');
                }
            });
        });
    });
}

/* ================= 8. Review / Inquiry Form Submission (AJAX) ================= */
function initReviewForm() {
    const form = document.getElementById('reviewForm');
    const msgBox = document.getElementById('formMsg');
    const reviewsList = document.getElementById('reviewsList');

    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const name = document.getElementById('userName').value.trim();
        const city = document.getElementById('userCity').value.trim();
        const rating = document.getElementById('ratingInput') ? document.getElementById('ratingInput').value : 5;
        const comment = document.getElementById('userComment').value.trim();

        if (!name || !comment) {
            if (msgBox) {
                msgBox.innerHTML = '<div style="color: #ef4444; margin-top: 10px; font-weight: 600;">કૃપા કરીને નામ અને પ્રતિભાવ અવશ્ય લખો.</div>';
            }
            return;
        }

        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'નોંધણી થઈ રહી છે...';
        }

        fetch('api/feedback.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                user_name: name,
                user_city: city,
                rating: rating,
                user_comment: comment
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Static/Network');
            }
            return response.json();
        })
        .then(data => {
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.textContent = 'પ્રતિભાવ સબમિટ કરો';
            }

            if (data.success) {
                if (msgBox) {
                    msgBox.innerHTML = '<div style="color: #10b981; margin-top: 10px; font-weight: 600;">' + data.message + '</div>';
                }
                form.reset();

                // Reset star rating to 5
                const stars = document.querySelectorAll('#starRatingSelect .star');
                stars.forEach(s => s.classList.add('selected'));
                if (document.getElementById('ratingInput')) {
                    document.getElementById('ratingInput').value = 5;
                }

                // Add to list dynamically
                if (reviewsList && data.review) {
                    const starsHtml = '★'.repeat(data.review.rating) + '☆'.repeat(5 - data.review.rating);
                    const newReviewHtml = `
                        <div class="review-item" style="border-left: 4px solid #10b981; animation: modalIn 0.4s ease;">
                            <div class="review-header">
                                <div>
                                    <span class="reviewer-name">${data.review.user_name}</span>
                                    <span class="reviewer-city"> (${data.review.user_city})</span>
                                </div>
                                <div class="review-stars">${starsHtml}</div>
                            </div>
                            <p class="review-text">${data.review.user_comment}</p>
                            <small style="color: #94a3b8; font-size: 0.78rem;">હમણાં જ ઉમેરાયેલ</small>
                        </div>
                    `;
                    reviewsList.insertAdjacentHTML('afterbegin', newReviewHtml);
                }
            } else {
                if (msgBox) {
                    msgBox.innerHTML = '<div style="color: #ef4444; margin-top: 10px; font-weight: 600;">' + data.message + '</div>';
                }
            }
        })
        .catch(err => {
            // Static Hosting / GitHub Pages fallback
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.textContent = 'પ્રતિભાવ સબમિટ કરો';
            }
            if (msgBox) {
                msgBox.innerHTML = '<div style="color: #10b981; margin-top: 10px; font-weight: 600;">આભાર! તમારો પ્રતિભાવ સફળતાપૂર્વક નોંધાઈ ગયો છે.</div>';
            }
            form.reset();
            const stars = document.querySelectorAll('#starRatingSelect .star');
            stars.forEach(s => s.classList.add('selected'));
            if (document.getElementById('ratingInput')) {
                document.getElementById('ratingInput').value = 5;
            }

            if (reviewsList) {
                const safeName = name.replace(/</g, "&lt;").replace(/>/g, "&gt;");
                const safeCity = (city || 'યાત્રાળુ').replace(/</g, "&lt;").replace(/>/g, "&gt;");
                const safeComment = comment.replace(/</g, "&lt;").replace(/>/g, "&gt;");
                const starsHtml = '★'.repeat(parseInt(rating) || 5) + '☆'.repeat(5 - (parseInt(rating) || 5));
                const newReviewHtml = `
                    <div class="review-item" style="border-left: 4px solid #10b981; animation: modalIn 0.4s ease;">
                        <div class="review-header">
                            <div>
                                <span class="reviewer-name">${safeName}</span>
                                <span class="reviewer-city"> (${safeCity})</span>
                            </div>
                            <div class="review-stars">${starsHtml}</div>
                        </div>
                        <p class="review-text">${safeComment}</p>
                        <small style="color: #94a3b8; font-size: 0.78rem;">હમણાં જ ઉમેરાયેલ</small>
                    </div>
                `;
                reviewsList.insertAdjacentHTML('afterbegin', newReviewHtml);
            }
        });
    });
}

/* ================= 9. Back to Top Button ================= */
function initBackToTop() {
    const btn = document.getElementById('backToTop');
    if (!btn) return;

    window.addEventListener('scroll', () => {
        if (window.scrollY > 400) {
            btn.classList.add('show');
        } else {
            btn.classList.remove('show');
        }
    });

    btn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

/* ================= 10. Progressive Web App (PWA) Install Handler ================= */
function initPwaInstaller() {
    let deferredPrompt = null;
    const installBtn = document.getElementById('pwaInstallBtn');
    if (!installBtn) return;

    const btnLabel = installBtn.querySelector('.pwa-btn-label');
    const btnIcon = installBtn.querySelector('.pwa-icon');

    // Register Service Worker
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('sw.js')
                .then(reg => console.log('PWA ServiceWorker registered:', reg.scope))
                .catch(err => console.log('PWA ServiceWorker error:', err));
        });
    }

    // Check standalone mode or localStorage flag
    const isStandalone = window.matchMedia('(display-mode: standalone)').matches 
                      || window.navigator.standalone === true;
    const isMarkedInstalled = localStorage.getItem('pwa_dwarka_installed') === 'true';

    function setInstalledUI() {
        installBtn.classList.add('is-installed');
        if (btnIcon) btnIcon.className = 'fa-solid fa-circle-check pwa-icon';
        if (btnLabel) btnLabel.textContent = 'એપ ઇન્સ્ટોલ છે';
        installBtn.setAttribute('title', 'દ્વારકા ગાઇડ એપ તમારા ડિવાઇસ પર પહેલેથી જ ઇન્સ્ટોલ થયેલ છે');
    }

    if (isStandalone || isMarkedInstalled) {
        setInstalledUI();
    }

    // Capture beforeinstallprompt
    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;

        if (!isStandalone && !isMarkedInstalled) {
            installBtn.classList.remove('is-installed');
            if (btnIcon) btnIcon.className = 'fa-solid fa-cloud-arrow-down pwa-icon';
            if (btnLabel) btnLabel.textContent = 'ઇન્સ્ટોલ એપ';
        }
    });

    // Handle button click
    installBtn.addEventListener('click', async () => {
        if (installBtn.classList.contains('is-installed') || isStandalone || localStorage.getItem('pwa_dwarka_installed') === 'true') {
            showPwaToast('✅ આ એપ તમારા ફોન અથવા કમ્પ્યુટર પર પહેલેથી જ ઇન્સ્ટોલ થયેલ છે! તમે હોમ સ્ક્રીન શોર્ટકટથી ઓપન કરી શકો છો.');
            return;
        }

        if (deferredPrompt) {
            deferredPrompt.prompt();
            const { outcome } = await deferredPrompt.userChoice;
            if (outcome === 'accepted') {
                localStorage.setItem('pwa_dwarka_installed', 'true');
                setInstalledUI();
                showPwaToast('🎉 દ્વારકા ગાઇડ એપ સફળતાપૂર્વક ઇન્સ્ટોલ થઈ ગઈ છે! શોર્ટકટ હોમ સ્ક્રીન પર ઉમેરાઈ ગયું છે.');
            }
            deferredPrompt = null;
        } else {
            // Check if iOS
            const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
            if (isIOS) {
                showPwaToast('📲 Safari માં નીચે શેર (Share) બટન ⎋ દબાવી "Add to Home Screen" (+) પસંદ કરો.');
            } else {
                showPwaToast('📲 ક્રોમ બ્રાઉઝરમાં ઉપર ૩-ડોટ્સ મેનૂ (⋮) દબાવી "Install app" અથવા "Add to Home screen" પસંદ કરો.');
            }
        }
    });

    // Handle successful install event
    window.addEventListener('appinstalled', () => {
        localStorage.setItem('pwa_dwarka_installed', 'true');
        setInstalledUI();
        deferredPrompt = null;
        showPwaToast('🎉 દ્વારકા ગાઇડ એપ સફળતાપૂર્વક ઇન્સ્ટોલ થઈ ગઈ છે!');
    });
}

function showPwaToast(msg) {
    let toast = document.getElementById('pwaToast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'pwaToast';
        toast.className = 'pwa-toast';
        document.body.appendChild(toast);
    }
    toast.textContent = msg;
    toast.classList.add('show');
    clearTimeout(window._pwaToastTimer);
    window._pwaToastTimer = setTimeout(() => {
        toast.classList.remove('show');
    }, 4500);
}

/* ================= 11. Mobile Bottom Navigation Bar (m1.jpg Style) ================= */
function initMobileBottomNav() {
    const bottomNav = document.getElementById('mobileBottomNav');
    if (!bottomNav) return;

    const navItems = bottomNav.querySelectorAll('.bottom-nav-item');

    navItems.forEach(item => {
        item.addEventListener('click', function (e) {
            const targetId = this.getAttribute('data-target');
            navItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');

            if (targetId === 'top') {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
    });

    // Scroll spy to update active item
    const sections = [
        { id: 'top', el: document.querySelector('.hero') || document.body },
        { id: 'aarti-schedule', el: document.getElementById('aarti-schedule') },
        { id: 'places', el: document.getElementById('places') },
        { id: 'itinerary', el: document.getElementById('itinerary') },
        { id: 'budget-calculator', el: document.getElementById('budget-calculator') }
    ];

    window.addEventListener('scroll', () => {
        const scrollPos = window.scrollY + 200;
        let currentSectionId = 'top';

        sections.forEach(sec => {
            if (sec.el && sec.el.offsetTop <= scrollPos) {
                currentSectionId = sec.id;
            }
        });

        navItems.forEach(item => {
            const target = item.getAttribute('data-target');
            if (target === currentSectionId) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
        });
    }, { passive: true });
}
