<?php
echo "<h3>Danh sách file trong thư mục req/:</h3>";

$path = 'req/';

if (is_dir($path)) {
    $files = scandir($path);
    echo "<ul>";
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            echo "<li>$file</li>";
        }
    }
    echo "</ul>";
} else {
    echo "<p>Không tìm thấy thư mục req/. Hãy kiểm tra lại đường dẫn.</p>";
}
?>
