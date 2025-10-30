<?php
/**
 * Skyworld Content & Image Generator
 * Creates placeholder images and sample content for theme development
 */

if (!defined('ABSPATH')) {
    echo "This script must be run within WordPress.\n";
    exit;
}

class SkyworldContentGenerator {
    
    private $theme_dir;
    private $images_dir;
    private $assets_dir;
    
    public function __construct() {
        $this->theme_dir = get_template_directory();
        $this->images_dir = $this->theme_dir . '/assets/images/';
        $this->assets_dir = $this->theme_dir . '/assets/';
        
        // Ensure directories exist
        wp_mkdir_p($this->images_dir);
        wp_mkdir_p($this->images_dir . 'strains/');
        wp_mkdir_p($this->images_dir . 'products/');
        wp_mkdir_p($this->images_dir . 'categories/');
        wp_mkdir_p($this->images_dir . 'hero/');
        wp_mkdir_p($this->images_dir . 'press/');
    }
    
    /**
     * Generate all placeholder images and content
     */
    public function generate_all_content() {
        echo "Generating Skyworld Cannabis content and images...\n\n";
        
        $this->create_hero_images();
        $this->create_category_images();
        $this->create_strain_images();
        $this->create_product_images();
        $this->create_press_logos();
        $this->create_theme_screenshot();
        $this->create_brand_assets();
        $this->create_content_templates();
        
        echo "\n✅ All content and images generated successfully!\n";
        echo "📁 Images location: {$this->images_dir}\n";
        echo "🎨 Replace placeholder images with your real photos\n";
    }
    
    /**
     * Create hero section images
     */
    private function create_hero_images() {
        echo "Creating hero images...\n";
        
        // Hero background placeholder
        $this->create_placeholder_image(
            $this->images_dir . 'hero-bg-1.jpg',
            1920, 1080,
            '#1a1a1a',
            'Skyworld Cannabis\nPremium Indoor Flower',
            '#f15b27'
        );
        
        // Additional hero images
        $this->create_placeholder_image(
            $this->images_dir . 'hero-bg-2.jpg',
            1920, 1080,
            '#2a2a2a',
            'Craft Cannabis\nCultivated in NY',
            '#54a5db'
        );
    }
    
    /**
     * Create product category images
     */
    private function create_category_images() {
        echo "Creating category images...\n";
        
        $categories = [
            ['name' => 'flower-category.jpg', 'title' => 'Premium\nFlower', 'color' => '#2d5016'],
            ['name' => 'prerolls-category.jpg', 'title' => 'Pre-Rolls', 'color' => '#8b4513'],
            ['name' => 'hashholes-category.jpg', 'title' => 'Hash Holes', 'color' => '#4a4a4a'],
            ['name' => 'apparel-category.jpg', 'title' => 'Apparel', 'color' => '#f15b27']
        ];
        
        foreach ($categories as $category) {
            $this->create_placeholder_image(
                $this->images_dir . $category['name'],
                400, 300,
                $category['color'],
                $category['title'],
                '#ffffff'
            );
        }
    }
    
    /**
     * Create strain placeholder images
     */
    private function create_strain_images() {
        echo "Creating strain images...\n";
        
        // Load strain data and create images for each
        $strains = [
            'stay-puft' => ['color' => '#4a4a4a', 'title' => 'Stay Puft'],
            'wafflez' => ['color' => '#8b4513', 'title' => 'Wafflez'],
            'sherb-cream-pie' => ['color' => '#ff69b4', 'title' => 'Sherb Cream Pie'],
            'peanut-butter-gelato' => ['color' => '#daa520', 'title' => 'PB Gelato'],
            'kept-secret' => ['color' => '#2f4f2f', 'title' => 'Kept Secret'],
            'charmz' => ['color' => '#ff6347', 'title' => 'Charmz'],
            '41-gs' => ['color' => '#4b0082', 'title' => '41 Gs'],
            'garlic-gravity' => ['color' => '#556b2f', 'title' => 'Garlic Gravity'],
            'gushcanna' => ['color' => '#ff4500', 'title' => 'Gushcanna']
        ];
        
        foreach ($strains as $slug => $data) {
            $this->create_placeholder_image(
                $this->images_dir . 'strains/' . $slug . '.jpg',
                800, 600,
                $data['color'],
                $data['title'] . "\nPremium Genetics",
                '#ffffff'
            );
        }
    }
    
    /**
     * Create product placeholder images
     */
    private function create_product_images() {
        echo "Creating product images...\n";
        
        // Create generic product images
        $product_types = [
            ['name' => 'flower-jar.jpg', 'title' => 'Premium\nFlower', 'color' => '#2d5016'],
            ['name' => 'pre-roll.jpg', 'title' => 'Pre-Roll', 'color' => '#8b4513'],
            ['name' => 'hash-hole.jpg', 'title' => 'Hash Hole', 'color' => '#4a4a4a']
        ];
        
        foreach ($product_types as $product) {
            $this->create_placeholder_image(
                $this->images_dir . 'products/' . $product['name'],
                600, 600,
                $product['color'],
                $product['title'],
                '#ffffff'
            );
        }
    }
    
    /**
     * Create press logo placeholders
     */
    private function create_press_logos() {
        echo "Creating press logos...\n";
        
        $press_logos = [
            ['name' => 'press-logo-1.png', 'title' => 'HIGH TIMES'],
            ['name' => 'press-logo-2.png', 'title' => 'LEAFLY'],
            ['name' => 'press-logo-3.png', 'title' => 'CANNABIS NOW'],
            ['name' => 'press-logo-4.png', 'title' => 'NY CANNABIS']
        ];
        
        foreach ($press_logos as $logo) {
            $this->create_placeholder_image(
                $this->images_dir . 'press/' . $logo['name'],
                200, 80,
                '#ffffff',
                $logo['title'],
                '#333333'
            );
        }
    }
    
    /**
     * Create theme screenshot
     */
    private function create_theme_screenshot() {
        echo "Creating theme screenshot...\n";
        
        $this->create_placeholder_image(
            $this->theme_dir . '/screenshot.png',
            1200, 900,
            '#1a1a1a',
            "SKYWORLD CANNABIS\nWordPress Theme\n\nHub & Spoke Architecture\nJeeter-Inspired Navigation",
            '#f15b27'
        );
    }
    
    /**
     * Create brand assets
     */
    private function create_brand_assets() {
        echo "Creating brand assets...\n";
        
        // Cultivation story image
        $this->create_placeholder_image(
            $this->images_dir . 'cultivation-placeholder.jpg',
            800, 600,
            '#2d5016',
            'Indoor Cultivation\nPremium Quality\nSkyworld Standards',
            '#ffffff'
        );
        
        // NY State outline SVG
        $ny_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 150">
            <path d="M40,60 L160,60 L150,40 L170,35 L175,50 L180,55 L175,75 L170,85 L160,90 L155,110 L40,110 L35,95 L30,80 L35,65 Z" 
                  fill="#f15b27" opacity="0.8" stroke="#f15b27" stroke-width="2"/>
            <text x="100" y="80" text-anchor="middle" fill="white" font-size="14" font-weight="bold">NEW YORK</text>
        </svg>';
        
        file_put_contents($this->images_dir . 'ny-state-outline.svg', $ny_svg);
    }
    
    /**
     * Create placeholder image with text
     */
    private function create_placeholder_image($filepath, $width, $height, $bg_color, $text, $text_color) {
        // Create image
        $image = imagecreate($width, $height);
        
        // Convert hex colors to RGB
        $bg_rgb = $this->hex_to_rgb($bg_color);
        $text_rgb = $this->hex_to_rgb($text_color);
        
        // Allocate colors
        $bg = imagecolorallocate($image, $bg_rgb[0], $bg_rgb[1], $bg_rgb[2]);
        $text_col = imagecolorallocate($image, $text_rgb[0], $text_rgb[1], $text_rgb[2]);
        
        // Fill background
        imagefill($image, 0, 0, $bg);
        
        // Add text
        $lines = explode("\n", $text);
        $line_height = 30;
        $start_y = ($height - (count($lines) * $line_height)) / 2;
        
        foreach ($lines as $i => $line) {
            $bbox = imagettfbbox(18, 0, $this->get_font_path(), $line);
            $text_width = $bbox[4] - $bbox[0];
            $x = ($width - $text_width) / 2;
            $y = $start_y + ($i * $line_height) + 20;
            
            imagettftext($image, 18, 0, $x, $y, $text_col, $this->get_font_path(), $line);
        }
        
        // Save image
        if (pathinfo($filepath, PATHINFO_EXTENSION) === 'png') {
            imagepng($image, $filepath);
        } else {
            imagejpeg($image, $filepath, 90);
        }
        
        imagedestroy($image);
    }
    
    /**
     * Convert hex color to RGB array
     */
    private function hex_to_rgb($hex) {
        $hex = ltrim($hex, '#');
        return [
            hexdec(substr($hex, 0, 2)),
            hexdec(substr($hex, 2, 2)),
            hexdec(substr($hex, 4, 2))
        ];
    }
    
    /**
     * Get system font path (fallback to built-in)
     */
    private function get_font_path() {
        // Try to find a system font
        $fonts = [
            '/System/Library/Fonts/Arial.ttf',
            '/System/Library/Fonts/Helvetica.ttc',
            '/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf',
            '/Windows/Fonts/arial.ttf'
        ];
        
        foreach ($fonts as $font) {
            if (file_exists($font)) {
                return $font;
            }
        }
        
        // If no font found, use imagestring instead
        return null;
    }
    
    /**
     * Create content templates
     */
    private function create_content_templates() {
        echo "Creating content templates...\n";
        
        // Create sample strain content
        $strain_content = [
            'stay-puft' => [
                'title' => 'Stay Puft',
                'content' => 'A hybrid strain that delivers a smooth, marshmallow-like experience with hints of grape gasoline. Perfect for evening relaxation and creative endeavors.',
                'genetics' => 'Marshmallow OG × Grape Gasoline',
                'breeder' => 'Compound Genetics',
                'flowering_time' => '8-10 weeks',
                'aroma_profile' => 'Vanilla marshmallow, fluffy sugar, light grape fuel',
                'flavor_profile' => 'Creamy marshmallow with vanilla undertones'
            ],
            'wafflez' => [
                'title' => 'Wafflez',
                'content' => 'A dessert-forward strain combining Apple Fritter with Stuffed French Toast for a breakfast-inspired cannabis experience.',
                'genetics' => 'Apple Fritter × Stuffed French Toast',
                'breeder' => 'Raw Genetics',
                'flowering_time' => '8-9.5 weeks',
                'aroma_profile' => 'Waffle batter, maple syrup, vanilla, warm bakery spice',
                'flavor_profile' => 'Sweet waffle batter with maple and vanilla finish'
            ]
        ];
        
        file_put_contents($this->assets_dir . 'sample-strain-content.json', json_encode($strain_content, JSON_PRETTY_PRINT));
        
        // Create image replacement guide
        $image_guide = "# Skyworld Cannabis - Image Replacement Guide

## 📸 Image Requirements

### Hero Images (1920x1080)
- hero-bg-1.jpg - Main homepage hero background
- hero-bg-2.jpg - Secondary hero option

### Category Images (400x300)
- flower-category.jpg - Premium flower products
- prerolls-category.jpg - Pre-roll products  
- hashholes-category.jpg - Hash hole products
- apparel-category.jpg - Branded merchandise

### Strain Images (800x600)
Replace placeholder images in /assets/images/strains/ with actual strain photos:
- stay-puft.jpg
- wafflez.jpg
- sherb-cream-pie.jpg
- peanut-butter-gelato.jpg
- kept-secret.jpg
- charmz.jpg
- 41-gs.jpg
- garlic-gravity.jpg
- gushcanna.jpg

### Product Images (600x600)
- flower-jar.jpg - Generic flower jar
- pre-roll.jpg - Generic pre-roll
- hash-hole.jpg - Generic hash hole

### Press Logos (200x80)
Replace with actual media logos:
- press-logo-1.png
- press-logo-2.png
- press-logo-3.png
- press-logo-4.png

### Brand Assets
- cultivation-placeholder.jpg (800x600) - Indoor grow facility
- ny-state-outline.svg - New York state outline graphic

## 🔄 Image Naming Convention

For automatic detection by the image manager:
- Strain images: [strain-slug].jpg
- Product images: [batch-number].jpg or [product-slug].jpg
- Use lowercase, hyphens for spaces

## 📋 Recommended Image Specs

- Format: JPG for photos, PNG for logos with transparency
- Quality: 80-90% compression
- Optimization: Use WebP when possible
- Alt text: Automatically generated from product/strain data

## 🚀 Upload Process

1. Replace placeholder images with real photos
2. Keep same filenames for automatic detection
3. Run image manager: `wp eval-file import-scripts/image-manager.php`
4. Images will be imported to WordPress media library
";
        
        file_put_contents($this->theme_dir . '/IMAGE-GUIDE.md', $image_guide);
    }
}

// Run the content generator
$generator = new SkyworldContentGenerator();

if (defined('WP_CLI') && WP_CLI) {
    $generator->generate_all_content();
} else {
    if (current_user_can('manage_options')) {
        $generator->generate_all_content();
    } else {
        echo "You need administrator privileges to run this content generator.\n";
    }
}