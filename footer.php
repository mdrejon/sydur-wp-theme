    <!-- Footer -->
    <footer class="py-12 text-center font-mono text-sm border-t border-slate-800 <?php echo is_front_page() ? 'mt-0' : 'mt-20'; ?>">
        <?php
        $options = get_option('sydur_options');
        $socials = array(
            'linkedin' => array(
                'url'  => isset($options['linkedin_url']) ? $options['linkedin_url'] : '',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>'
            ),
            'github' => array(
                'url'  => isset($options['github_url']) ? $options['github_url'] : '',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>'
            ),
            'wporg' => array(
                'url'  => isset($options['wporg_url']) ? $options['wporg_url'] : '',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 1.2c2.414 0 4.63.81 6.402 2.164l-5.322 14.544-3.27-9.878c.552-.04.88-.13.88-.13 0-.05-.12-.48-.12-.48-.52.05-1.59.05-2.07 0 0 0-.12.43-.12.48s.45.1.75.14l.11.02.59 1.79c-1.52.41-2.92.65-4.2.65-.63 0-1.23-.05-1.81-.17l4.032-11.012c1.3-.778 2.798-1.232 4.408-1.232zm-6.904 4.024c-.958 1.182-1.6 2.616-1.802 4.186l2.128 5.82c.49-.074 1.054-.15 1.684-.216l-2.01-5.79zm13.142 8.786l-2.324-6.632c.504-.046.99-.08 1.458-.1l1.554 4.428c.31.884.57 1.83.774 2.822-1.462-1.428-3.04-1.928-1.462-1.428v.91z"/></svg>'
            ),
            'facebook' => array(
                'url'  => isset($options['facebook_url']) ? $options['facebook_url'] : '',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>'
            ),
        );
        ?>
        <div class="flex justify-center gap-6 mb-8">
            <?php foreach ($socials as $id => $social):
                if (!empty($social['url'])): ?>
                    <a href="<?php echo esc_url($social['url']); ?>" target="_blank" class="text-slate-500 hover:text-primary transition-all duration-300 transform hover:-translate-y-1" aria-label="<?php echo esc_attr($id); ?>">
                        <?php echo $social['icon']; ?>
                    </a>
            <?php endif;
            endforeach; ?>
        </div>
        <p class="text-slate-500">&copy; <script>
                document.write(new Date().getFullYear())
            </script> <?php echo esc_html(get_bloginfo('name')); ?>. All rights reserved.</p>
    </footer>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mobileBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileBtn && mobileMenu) {
                mobileBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                    if (mobileMenu.classList.contains('hidden')) {
                        mobileBtn.innerHTML = '&#9776;';
                    } else {
                        mobileBtn.innerHTML = '&#10005;';
                    }
                });
            }

            const navbar = document.getElementById('navbar');
            if (navbar) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 20) {
                        navbar.classList.add('glass-panel', 'shadow-md', );
                    } else {
                        // Only remove on front-page where it starts transparent
                        <?php if (is_front_page()) : ?>
                            navbar.classList.remove('glass-panel', 'shadow-md', );
                        <?php endif; ?>
                    }
                });
            }

            const revealElements = document.querySelectorAll('.reveal');
            if (revealElements.length > 0) {
                const revealOptions = {
                    threshold: 0.15,
                    rootMargin: "0px 0px -50px 0px"
                };
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

            <?php if (is_front_page()) : ?>
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
                                    angleLines: {
                                        color: 'rgba(255, 255, 255, 0.1)'
                                    },
                                    grid: {
                                        color: 'rgba(255, 255, 255, 0.1)'
                                    },
                                    pointLabels: {
                                        color: '#94a3b8',
                                        font: {
                                            family: "'Fira Code', monospace",
                                            size: 10
                                        }
                                    },
                                    ticks: {
                                        display: false,
                                        stepSize: 20
                                    },
                                    suggestedMin: 0,
                                    suggestedMax: 100
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                }
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