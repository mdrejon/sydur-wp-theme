    <!-- Footer -->
    <footer class="py-8 text-center text-slate-500 font-mono text-sm border-t border-slate-800 <?php echo is_front_page() ? 'mt-0' : 'mt-20'; ?>">
        <p>&copy; <script>document.write(new Date().getFullYear())</script> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>. All rights reserved.</p>
    </footer>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mobileBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if(mobileBtn && mobileMenu) {
                mobileBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                    if(mobileMenu.classList.contains('hidden')) {
                        mobileBtn.innerHTML = '&#9776;';
                    } else {
                        mobileBtn.innerHTML = '&#10005;';
                    }
                });
            }

            const navbar = document.getElementById('navbar');
            if(navbar) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 20) {
                        navbar.classList.add('glass-panel', 'shadow-md', 'border-b', 'border-slate-800');
                    } else {
                        // Only remove on front-page where it starts transparent
                        <?php if ( is_front_page() ) : ?>
                        navbar.classList.remove('glass-panel', 'shadow-md', 'border-b', 'border-slate-800');
                        <?php endif; ?>
                    }
                });
            }

            const revealElements = document.querySelectorAll('.reveal');
            if(revealElements.length > 0) {
                const revealOptions = { threshold: 0.15, rootMargin: "0px 0px -50px 0px" };
                const revealOnScroll = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('active');
                            observer.unobserve(entry.target);
                        }
                    });
                }, revealOptions);

                revealElements.forEach(el => revealOnScroll.observe(el));
            }

            <?php if ( is_front_page() ) : ?>
            // Stack Chart Init
            const ctx = document.getElementById('stackChart');
            if (ctx && typeof Chart !== 'undefined') {
                new Chart(ctx, {
                    type: 'radar',
                    data: {
                        labels: ['Backend', 'Frontend', 'DevOps', 'UI/UX', 'Database', 'WP API'],
                        datasets: [{
                            label: 'Current Proficiency',
                            data: [95, 85, 70, 75, 90, 98],
                            backgroundColor: 'rgba(34, 211, 238, 0.2)',
                            borderColor: '#22d3ee',
                            borderWidth: 2,
                            pointBackgroundColor: '#22d3ee',
                            pointBorderColor: '#fff',
                            pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: '#22d3ee'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            r: {
                                angleLines: { color: 'rgba(255, 255, 255, 0.1)' },
                                grid: { color: 'rgba(255, 255, 255, 0.1)' },
                                pointLabels: {
                                    color: '#94a3b8',
                                    font: { family: "'Fira Code', monospace", size: 10 }
                                },
                                ticks: { display: false, stepSize: 20 },
                                suggestedMin: 0,
                                suggestedMax: 100
                            }
                        },
                        plugins: {
                            legend: { display: false }
                        },
                        animation: {
                            duration: 2000,
                            easing: 'easeOutQuart'
                        }
                    }
                });
            }
            <?php endif; ?>
        });
    </script>
    <?php wp_footer(); ?>
</body>
</html>
