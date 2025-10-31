<?php
/**
 * Template Name: Privacy Policy
 * 
 * Template for privacy policy page
 */

get_header(); ?>

<main class="main-content privacy-page">
    <!-- Hero Section -->
    <section class="privacy-hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="page-title">Privacy Policy</h1>
                <p class="hero-subtitle">Your privacy is important to us. This policy explains how we collect, use, and protect your information.</p>
                <p class="update-date">Last updated: <?php echo date('F j, Y'); ?></p>
            </div>
        </div>
    </section>

    <!-- Privacy Content -->
    <section class="privacy-content">
        <div class="container">
            <div class="privacy-wrapper">
                <div class="privacy-nav">
                    <h3>Quick Navigation</h3>
                    <ul>
                        <li><a href="#information-collection">Information We Collect</a></li>
                        <li><a href="#information-use">How We Use Information</a></li>
                        <li><a href="#information-sharing">Information Sharing</a></li>
                        <li><a href="#age-verification">Age Verification</a></li>
                        <li><a href="#cannabis-compliance">Cannabis Compliance</a></li>
                        <li><a href="#data-security">Data Security</a></li>
                        <li><a href="#your-rights">Your Rights</a></li>
                        <li><a href="#contact-info">Contact Information</a></li>
                    </ul>
                </div>
                
                <div class="privacy-body">
                    <div class="privacy-section" id="information-collection">
                        <h2>Information We Collect</h2>
                        <p>We collect information you provide directly to us, such as when you:</p>
                        <ul>
                            <li>Create an account or register for age verification</li>
                            <li>Contact us through our website or email</li>
                            <li>Subscribe to our newsletter or communications</li>
                            <li>Participate in surveys or promotional activities</li>
                            <li>Use our store locator or product search features</li>
                        </ul>
                        
                        <h3>Types of Information</h3>
                        <ul>
                            <li><strong>Personal Information:</strong> Name, email address, phone number, date of birth (for age verification)</li>
                            <li><strong>Technical Information:</strong> IP address, browser type, device information, usage data</li>
                            <li><strong>Location Information:</strong> General location data for store locator functionality</li>
                        </ul>
                    </div>
                    
                    <div class="privacy-section" id="information-use">
                        <h2>How We Use Your Information</h2>
                        <p>We use the information we collect to:</p>
                        <ul>
                            <li>Verify that you are 21 years of age or older</li>
                            <li>Provide customer support and respond to inquiries</li>
                            <li>Send newsletters and promotional communications (with your consent)</li>
                            <li>Improve our website functionality and user experience</li>
                            <li>Comply with legal obligations and cannabis regulations</li>
                            <li>Prevent fraud and maintain website security</li>
                        </ul>
                    </div>
                    
                    <div class="privacy-section" id="information-sharing">
                        <h2>Information Sharing</h2>
                        <p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except:</p>
                        <ul>
                            <li><strong>Service Providers:</strong> Trusted partners who assist in website operation, email delivery, and analytics</li>
                            <li><strong>Legal Requirements:</strong> When required by law, regulation, or legal process</li>
                            <li><strong>Safety Protection:</strong> To protect our rights, privacy, safety, or property, or that of others</li>
                            <li><strong>Business Transfers:</strong> In connection with a merger, acquisition, or sale of assets</li>
                        </ul>
                    </div>
                    
                    <div class="privacy-section" id="age-verification">
                        <h2>Age Verification</h2>
                        <p>Our website and products are intended for adults 21 years of age or older. We:</p>
                        <ul>
                            <li>Require age verification before accessing product information</li>
                            <li>Store date of birth information for compliance purposes</li>
                            <li>May use third-party age verification services</li>
                            <li>Immediately remove access for users under 21</li>
                        </ul>
                        <div class="compliance-notice">
                            <strong>Important:</strong> Providing false age information is prohibited and may result in legal consequences.
                        </div>
                    </div>
                    
                    <div class="privacy-section" id="cannabis-compliance">
                        <h2>Cannabis Compliance</h2>
                        <p>As a licensed cannabis business in New York State, we maintain strict compliance standards:</p>
                        <ul>
                            <li><strong>Tracking Requirements:</strong> All product information and customer interactions are logged for regulatory compliance</li>
                            <li><strong>Data Retention:</strong> We retain certain data as required by New York State cannabis regulations</li>
                            <li><strong>Regulatory Reporting:</strong> Information may be shared with regulatory authorities as required</li>
                            <li><strong>License Verification:</strong> Customer information may be used to verify eligibility for cannabis purchases</li>
                        </ul>
                        <div class="license-info">
                            <strong>Our Licenses:</strong><br>
                            Processing: #OCM-PROC-24-000030<br>
                            Cultivation: #OCM-CULT-2023-000179
                        </div>
                    </div>
                    
                    <div class="privacy-section" id="data-security">
                        <h2>Data Security</h2>
                        <p>We implement appropriate security measures to protect your personal information:</p>
                        <ul>
                            <li>SSL encryption for data transmission</li>
                            <li>Secure servers with limited access</li>
                            <li>Regular security audits and updates</li>
                            <li>Employee training on data protection</li>
                            <li>Incident response procedures</li>
                        </ul>
                        <p>However, no method of transmission over the internet is 100% secure. We cannot guarantee absolute security.</p>
                    </div>
                    
                    <div class="privacy-section" id="your-rights">
                        <h2>Your Rights</h2>
                        <p>You have the right to:</p>
                        <ul>
                            <li><strong>Access:</strong> Request information about what personal data we have about you</li>
                            <li><strong>Correction:</strong> Request correction of inaccurate personal information</li>
                            <li><strong>Deletion:</strong> Request deletion of your personal information (subject to legal requirements)</li>
                            <li><strong>Opt-out:</strong> Unsubscribe from marketing communications at any time</li>
                            <li><strong>Data Portability:</strong> Request a copy of your data in a portable format</li>
                        </ul>
                        <p>To exercise these rights, please contact us using the information below.</p>
                    </div>
                    
                    <div class="privacy-section" id="cookies">
                        <h2>Cookies and Tracking</h2>
                        <p>We use cookies and similar technologies to:</p>
                        <ul>
                            <li>Remember your age verification status</li>
                            <li>Improve website functionality and performance</li>
                            <li>Analyze website usage and traffic patterns</li>
                            <li>Provide personalized content and recommendations</li>
                        </ul>
                        <p>You can control cookies through your browser settings, but some website features may not function properly without them.</p>
                    </div>
                    
                    <div class="privacy-section" id="changes">
                        <h2>Policy Changes</h2>
                        <p>We may update this privacy policy from time to time. Changes will be posted on this page with an updated "Last Modified" date. Continued use of our website after changes constitutes acceptance of the updated policy.</p>
                    </div>
                    
                    <div class="privacy-section" id="contact-info">
                        <h2>Contact Information</h2>
                        <p>If you have questions about this privacy policy or our data practices, please contact us:</p>
                        <div class="contact-details">
                            <p><strong>Email:</strong> <a href="mailto:privacy@skyworldcannabis.com">privacy@skyworldcannabis.com</a></p>
                            <p><strong>General Contact:</strong> <a href="mailto:info@skyworldcannabis.com">info@skyworldcannabis.com</a></p>
                            <p><strong>Mailing Address:</strong><br>
                            Skyworld Cannabis<br>
                            [Address to be provided]<br>
                            New York, NY</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
/* Privacy Policy Styles */
.privacy-page {
    background: var(--color-background);
    color: var(--color-text);
}

.privacy-hero {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
    color: white;
    padding: 80px 0;
    text-align: center;
}

.privacy-hero .page-title {
    font-family: 'SkyFont-Black', sans-serif;
    font-size: clamp(2.5rem, 5vw, 4rem);
    margin-bottom: 1rem;
    letter-spacing: -0.02em;
}

.privacy-hero .hero-subtitle {
    font-size: 1.25rem;
    opacity: 0.9;
    max-width: 700px;
    margin: 0 auto 1rem;
    line-height: 1.6;
}

.update-date {
    font-size: 1rem;
    opacity: 0.8;
    font-style: italic;
}

.privacy-content {
    padding: 4rem 0;
}

.privacy-wrapper {
    display: grid;
    grid-template-columns: 250px 1fr;
    gap: 3rem;
    max-width: 1200px;
    margin: 0 auto;
}

.privacy-nav {
    position: sticky;
    top: 2rem;
    height: fit-content;
    background: var(--color-surface);
    padding: 1.5rem;
    border-radius: 12px;
    border: 1px solid var(--color-border);
}

.privacy-nav h3 {
    font-family: 'SkyFont-Bold', sans-serif;
    font-size: 1.125rem;
    margin-bottom: 1rem;
    color: var(--color-text);
}

.privacy-nav ul {
    list-style: none;
    padding: 0;
}

.privacy-nav li {
    margin-bottom: 0.5rem;
}

.privacy-nav a {
    color: var(--color-text-muted);
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.privacy-nav a:hover {
    color: var(--color-primary);
}

.privacy-body {
    background: var(--color-surface);
    padding: 2rem;
    border-radius: 12px;
    border: 1px solid var(--color-border);
}

.privacy-section {
    margin-bottom: 3rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid var(--color-border);
}

.privacy-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.privacy-section h2 {
    font-family: 'SkyFont-Bold', sans-serif;
    font-size: 1.75rem;
    margin-bottom: 1rem;
    color: var(--color-text);
}

.privacy-section h3 {
    font-family: 'SkyFont-Bold', sans-serif;
    font-size: 1.25rem;
    margin: 1.5rem 0 0.75rem;
    color: var(--color-text);
}

.privacy-section p {
    line-height: 1.7;
    margin-bottom: 1rem;
    color: var(--color-text);
}

.privacy-section ul {
    margin: 1rem 0;
    padding-left: 1.5rem;
}

.privacy-section li {
    margin-bottom: 0.5rem;
    line-height: 1.6;
    color: var(--color-text);
}

.privacy-section a {
    color: var(--color-primary);
    text-decoration: none;
}

.privacy-section a:hover {
    text-decoration: underline;
}

.compliance-notice {
    background: #fef3cd;
    border: 1px solid #fdbf47;
    color: #8a6914;
    padding: 1rem;
    border-radius: 8px;
    margin: 1rem 0;
}

.license-info {
    background: var(--color-background);
    border: 1px solid var(--color-border);
    padding: 1rem;
    border-radius: 8px;
    margin: 1rem 0;
    font-family: monospace;
    font-size: 0.9rem;
}

.contact-details {
    background: var(--color-background);
    padding: 1.5rem;
    border-radius: 8px;
    border: 1px solid var(--color-border);
    margin: 1rem 0;
}

.contact-details p {
    margin-bottom: 0.5rem;
}

/* Responsive */
@media (max-width: 768px) {
    .privacy-wrapper {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .privacy-nav {
        position: static;
        order: 2;
    }
    
    .privacy-hero {
        padding: 60px 0;
    }
    
    .privacy-content {
        padding: 3rem 0;
    }
    
    .privacy-body {
        padding: 1.5rem;
    }
}

@media (max-width: 480px) {
    .privacy-body {
        padding: 1rem;
    }
    
    .privacy-section {
        margin-bottom: 2rem;
    }
}
</style>

<script>
// Smooth scrolling for navigation links
document.querySelectorAll('.privacy-nav a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Highlight current section in navigation
window.addEventListener('scroll', function() {
    const sections = document.querySelectorAll('.privacy-section');
    const navLinks = document.querySelectorAll('.privacy-nav a');
    
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop - 100;
        if (window.pageYOffset >= sectionTop) {
            current = section.getAttribute('id');
        }
    });
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === '#' + current) {
            link.classList.add('active');
        }
    });
});
</script>

<?php get_footer(); ?>