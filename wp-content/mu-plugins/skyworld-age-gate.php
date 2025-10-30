<?php
/**
 * Plugin Name: Skyworld Age Gate
 * Description: NYS compliant age verification for cannabis website
 * Version: 1.0.0
 * Author: Skyworld Cannabis
 * 
 * Must-use plugin for age verification compliance
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class Skyworld_Age_Gate {
    
    private $session_key = 'skyworld_age_verified';
    private $cookie_name = 'skyworld_age_verified';
    private $cookie_duration = DAY_IN_SECONDS * 30; // 30 days
    
    public function __construct() {
        add_action('init', array($this, 'init'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_ajax_verify_age', array($this, 'handle_age_verification'));
        add_action('wp_ajax_nopriv_verify_age', array($this, 'handle_age_verification'));
        add_action('wp_footer', array($this, 'render_age_gate'));
    }
    
    /**
     * Initialize the age gate
     */
    public function init() {
        // Start session if not already started
        if (!session_id()) {
            session_start();
        }
        
        // Check if user needs age verification
        if (!$this->is_age_verified() && !$this->is_admin_area()) {
            add_action('wp_head', array($this, 'add_no_index_meta'));
            add_filter('body_class', array($this, 'add_body_class'));
        }
    }
    
    /**
     * Check if user has verified their age
     */
    private function is_age_verified() {
        // Check session first
        if (isset($_SESSION[$this->session_key]) && $_SESSION[$this->session_key] === true) {
            return true;
        }
        
        // Check cookie
        if (isset($_COOKIE[$this->cookie_name]) && $_COOKIE[$this->cookie_name] === 'verified') {
            // Restore session from cookie
            $_SESSION[$this->session_key] = true;
            return true;
        }
        
        return false;
    }
    
    /**
     * Check if we're in admin area
     */
    private function is_admin_area() {
        return is_admin() || wp_doing_ajax() || wp_doing_cron();
    }
    
    /**
     * Add no-index meta tag when age gate is shown
     */
    public function add_no_index_meta() {
        echo '<meta name="robots" content="noindex, nofollow">' . "\n";
    }
    
    /**
     * Add body class when age gate is active
     */
    public function add_body_class($classes) {
        $classes[] = 'age-gate-active';
        return $classes;
    }
    
    /**
     * Enqueue age gate scripts and styles
     */
    public function enqueue_scripts() {
        if (!$this->is_age_verified() && !$this->is_admin_area()) {
            wp_enqueue_script(
                'skyworld-age-gate',
                $this->get_plugin_url() . 'assets/age-gate.js',
                array('jquery'),
                '1.0.0',
                true
            );
            
            wp_localize_script('skyworld-age-gate', 'ageGateAjax', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('age_gate_nonce'),
            ));
            
            wp_enqueue_style(
                'skyworld-age-gate',
                $this->get_plugin_url() . 'assets/age-gate.css',
                array(),
                '1.0.0'
            );
        }
    }
    
    /**
     * Handle AJAX age verification
     */
    public function handle_age_verification() {
        // Verify nonce
        if (!wp_verify_nonce($_POST['nonce'], 'age_gate_nonce')) {
            wp_die('Security check failed');
        }
        
        $is_of_age = isset($_POST['is_of_age']) && $_POST['is_of_age'] === 'true';
        
        if ($is_of_age) {
            // Set session
            $_SESSION[$this->session_key] = true;
            
            // Set cookie
            setcookie(
                $this->cookie_name,
                'verified',
                time() + $this->cookie_duration,
                COOKIEPATH,
                COOKIE_DOMAIN,
                is_ssl(),
                true
            );
            
            wp_send_json_success(array(
                'message' => 'Age verified successfully',
                'redirect' => false
            ));
        } else {
            wp_send_json_error(array(
                'message' => 'You must be 21 or older to access this site',
                'redirect' => 'https://www.samhsa.gov/'
            ));
        }
    }
    
    /**
     * Render the age gate HTML
     */
    public function render_age_gate() {
        if (!$this->is_age_verified() && !$this->is_admin_area()) {
            ?>
            <div id="skyworld-age-gate" class="age-gate-overlay" role="dialog" aria-labelledby="age-gate-title" aria-modal="true">
                <div class="age-gate-content">
                    <div class="age-gate-header">
                        <?php if (has_custom_logo()) : ?>
                            <div class="age-gate-logo">
                                <?php the_custom_logo(); ?>
                            </div>
                        <?php else : ?>
                            <h1 class="age-gate-site-title"><?php bloginfo('name'); ?></h1>
                        <?php endif; ?>
                    </div>
                    
                    <div class="age-gate-body">
                        <h2 id="age-gate-title" class="age-gate-title">Age Verification Required</h2>
                        
                        <p class="age-gate-text">
                            You must be <strong>21 years of age or older</strong> to access this website. 
                            Cannabis products are for adults only and have not been evaluated by the FDA.
                        </p>
                        
                        <p class="age-gate-compliance">
                            By entering this site, you certify that you are of lawful age to purchase cannabis 
                            products in your jurisdiction and that you will not redistribute the material to minors.
                        </p>
                        
                        <div class="age-gate-actions">
                            <button id="age-gate-yes" class="btn btn--primary age-gate-btn">
                                I am 21 or older
                            </button>
                            <button id="age-gate-no" class="btn btn--outline age-gate-btn">
                                I am under 21
                            </button>
                        </div>
                        
                        <div class="age-gate-disclaimer">
                            <p><small>
                                Licensed by the New York State Office of Cannabis Management. 
                                Keep out of reach of children and pets.
                            </small></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <style>
                /* Prevent scrolling when age gate is active */
                body.age-gate-active {
                    overflow: hidden;
                    position: fixed;
                    width: 100%;
                    height: 100%;
                }
                
                .age-gate-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.95);
                    z-index: 999999;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    backdrop-filter: blur(10px);
                }
                
                .age-gate-content {
                    background: var(--skyworld-white, #ffffff);
                    padding: 3rem;
                    border-radius: 12px;
                    max-width: 500px;
                    width: 90%;
                    text-align: center;
                    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
                    animation: fadeInUp 0.5s ease;
                }
                
                @keyframes fadeInUp {
                    from {
                        opacity: 0;
                        transform: translateY(30px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
                
                .age-gate-logo img {
                    max-height: 80px;
                    margin-bottom: 1rem;
                }
                
                .age-gate-title {
                    color: var(--skyworld-black, #000);
                    font-size: 1.5rem;
                    margin-bottom: 1rem;
                }
                
                .age-gate-text {
                    color: var(--skyworld-grey, #666);
                    font-size: 1rem;
                    line-height: 1.5;
                    margin-bottom: 1rem;
                }
                
                .age-gate-compliance {
                    color: var(--skyworld-grey, #666);
                    font-size: 0.9rem;
                    line-height: 1.4;
                    margin-bottom: 2rem;
                }
                
                .age-gate-actions {
                    display: flex;
                    gap: 1rem;
                    justify-content: center;
                    margin-bottom: 2rem;
                    flex-wrap: wrap;
                }
                
                .age-gate-btn {
                    min-width: 140px;
                    padding: 0.75rem 1.5rem;
                    font-weight: 600;
                    border-radius: 6px;
                    border: 2px solid transparent;
                    cursor: pointer;
                    transition: all 0.3s ease;
                }
                
                .age-gate-btn.btn--primary {
                    background: var(--skyworld-orange, #f15b27);
                    color: white;
                }
                
                .age-gate-btn.btn--primary:hover {
                    background: var(--skyworld-black, #000);
                    transform: translateY(-2px);
                }
                
                .age-gate-btn.btn--outline {
                    background: transparent;
                    color: var(--skyworld-grey, #666);
                    border-color: var(--skyworld-grey, #666);
                }
                
                .age-gate-btn.btn--outline:hover {
                    background: var(--skyworld-grey, #666);
                    color: white;
                }
                
                .age-gate-disclaimer {
                    color: var(--skyworld-grey, #666);
                    font-size: 0.8rem;
                    line-height: 1.3;
                    opacity: 0.8;
                }
                
                @media (max-width: 480px) {
                    .age-gate-content {
                        padding: 2rem;
                        margin: 1rem;
                    }
                    
                    .age-gate-actions {
                        flex-direction: column;
                    }
                    
                    .age-gate-btn {
                        width: 100%;
                    }
                }
            </style>
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const ageGate = document.getElementById('skyworld-age-gate');
                    const yesBtn = document.getElementById('age-gate-yes');
                    const noBtn = document.getElementById('age-gate-no');
                    
                    if (yesBtn) {
                        yesBtn.addEventListener('click', function() {
                            verifyAge(true);
                        });
                    }
                    
                    if (noBtn) {
                        noBtn.addEventListener('click', function() {
                            verifyAge(false);
                        });
                    }
                    
                    function verifyAge(isOfAge) {
                        const formData = new FormData();
                        formData.append('action', 'verify_age');
                        formData.append('is_of_age', isOfAge);
                        formData.append('nonce', '<?php echo wp_create_nonce('age_gate_nonce'); ?>');
                        
                        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                ageGate.style.display = 'none';
                                document.body.classList.remove('age-gate-active');
                            } else {
                                if (data.data.redirect) {
                                    window.location.href = data.data.redirect;
                                } else {
                                    alert(data.data.message);
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Age verification error:', error);
                        });
                    }
                });
            </script>
            <?php
        }
    }
    
    /**
     * Get plugin URL
     */
    private function get_plugin_url() {
        return plugin_dir_url(__FILE__);
    }
}

// Initialize the age gate
new Skyworld_Age_Gate();