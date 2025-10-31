<?php
/**
 * Skyworld Cannabis Theme - PHP Validation Script
 * Run this script to check for PHP errors and WordPress compatibility
 */

echo "🌿 Skyworld Cannabis Theme - PHP Validation\n";
echo "==========================================\n\n";

$theme_path = 'wp-content/themes/skyworld-cannabis';
$errors = 0;
$warnings = 0;

// Check if theme directory exists
if (!is_dir($theme_path)) {
    echo "❌ Theme directory not found: $theme_path\n";
    exit(1);
}

echo "📁 Scanning theme files...\n";

// Get all PHP files
$php_files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($theme_path)
);

$files_checked = 0;
$syntax_errors = [];

foreach ($php_files as $file) {
    if ($file->getExtension() === 'php') {
        $filepath = $file->getPathname();
        $filename = str_replace($theme_path . '/', '', $filepath);
        
        // Check PHP syntax
        $output = [];
        $return_code = 0;
        exec("php -l \"$filepath\" 2>&1", $output, $return_code);
        
        if ($return_code === 0) {
            echo "✅ $filename - Syntax OK\n";
        } else {
            echo "❌ $filename - Syntax Error:\n";
            foreach ($output as $line) {
                echo "   $line\n";
            }
            $syntax_errors[] = $filename;
            $errors++;
        }
        
        $files_checked++;
    }
}

echo "\n📊 Summary:\n";
echo "- Files checked: $files_checked\n";
echo "- Syntax errors: " . count($syntax_errors) . "\n";

// Check for required WordPress functions
echo "\n🔍 WordPress Compatibility Check:\n";

$required_wp_functions = [
    'wp_enqueue_style',
    'wp_enqueue_script',
    'add_theme_support',
    'get_template_directory_uri'
];

$functions_content = file_get_contents("$theme_path/functions.php");

foreach ($required_wp_functions as $function) {
    if (strpos($functions_content, $function) !== false) {
        echo "✅ WordPress function '$function' found\n";
    } else {
        echo "⚠️  WordPress function '$function' not found\n";
        $warnings++;
    }
}

// Check for security best practices
echo "\n🔒 Security Check:\n";

$security_functions = [
    'esc_html',
    'esc_attr',
    'esc_url',
    'sanitize_text_field'
];

foreach ($security_functions as $function) {
    $count = substr_count($functions_content, $function);
    if ($count > 0) {
        echo "✅ Security function '$function' used $count times\n";
    } else {
        echo "⚠️  Security function '$function' not found\n";
        $warnings++;
    }
}

// Check for ABSPATH protection
$files_with_abspath = 0;
foreach ($php_files as $file) {
    if ($file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        if (strpos($content, 'ABSPATH') !== false) {
            $files_with_abspath++;
        }
    }
}

if ($files_with_abspath > 0) {
    echo "✅ ABSPATH security check found in $files_with_abspath files\n";
} else {
    echo "⚠️  ABSPATH security check not found\n";
    $warnings++;
}

// Check style.css header
echo "\n🎨 Theme Header Check:\n";

$style_css = "$theme_path/style.css";
if (file_exists($style_css)) {
    $style_content = file_get_contents($style_css);
    
    $required_headers = [
        'Theme Name:' => 'Theme Name',
        'Description:' => 'Description',
        'Version:' => 'Version'
    ];
    
    foreach ($required_headers as $header => $name) {
        if (strpos($style_content, $header) !== false) {
            echo "✅ $name header found\n";
        } else {
            echo "❌ $name header missing\n";
            $errors++;
        }
    }
} else {
    echo "❌ style.css not found\n";
    $errors++;
}

// Cannabis compliance check
echo "\n🌿 Cannabis Compliance Check:\n";

$compliance_items = [
    'OCM-PROC-24-000030' => 'NY OCM Processor License',
    'OCM-CULT-2023-000179' => 'NY OCM Cultivator License',
    '21+' => 'Age gate requirement'
];

foreach ($compliance_items as $item => $description) {
    $found = false;
    foreach ($php_files as $file) {
        if ($file->getExtension() === 'php') {
            $content = file_get_contents($file->getPathname());
            if (strpos($content, $item) !== false) {
                $found = true;
                break;
            }
        }
    }
    
    if ($found) {
        echo "✅ $description found\n";
    } else {
        echo "⚠️  $description not found\n";
        $warnings++;
    }
}

// Final results
echo "\n" . str_repeat("=", 50) . "\n";
echo "🎯 FINAL RESULTS:\n";

if ($errors === 0 && $warnings === 0) {
    echo "🎉 ALL TESTS PASSED! Theme is ready for deployment.\n";
    $exit_code = 0;
} elseif ($errors === 0) {
    echo "⚠️  Tests passed with $warnings warnings.\n";
    echo "Review warnings before deployment.\n";
    $exit_code = 0;
} else {
    echo "❌ $errors critical errors found.\n";
    if ($warnings > 0) {
        echo "Also found $warnings warnings.\n";
    }
    echo "Fix all errors before deployment!\n";
    $exit_code = 1;
}

if (!empty($syntax_errors)) {
    echo "\n📝 Files with syntax errors:\n";
    foreach ($syntax_errors as $file) {
        echo "- $file\n";
    }
}

echo "\n💡 To run this test: php validate-theme.php\n";
echo "💡 To run bash test: ./test-theme.sh\n";

exit($exit_code);
?>