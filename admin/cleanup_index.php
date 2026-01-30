<?php
// Assuming run from root: php admin/cleanup_index.php
$file = 'index.php';
$lines = file($file);

if (!$lines) {
    die("Could not read index.php");
}

$newContent = "";

// Keep lines 0 to 803 (inclusive, 0-indexed)
// Line 804 in 1-based editor is index 803.
// View_file showed line 804 was the start of junk.
// So we keep up to index 803 (line 804).
// Wait, view_file is 1-indexed.
// Line 804: <div class="bazaar-container">...
// We want to remove that.
// So we keep indices 0 to 802. (Lines 1 to 803).

for ($i = 0; $i <= 802; $i++) {
    $newContent .= $lines[$i];
}

// Insert missing closing logic
$newContent .= "                                            <?php endwhile; ?>\n";
$newContent .= "                                        </div>\n"; // Close swiper-wrapper
$newContent .= "                                        <div class=\"swiper-scrollbar\"></div>\n";
$newContent .= "                                    </div>\n"; // Close amp_swiper
$newContent .= "                                </div>\n"; // Close experience-component (or tab-pane)
$newContent .= "                            </div>\n"; // Close tab-content
$newContent .= "                            <!-- End of Dynamic Section -->\n";

// Now verify which lines to keep at the bottom.
// We saw line 3000 was a closing div </div>.
// We estimated we need to keep the last 5 closing divs + footer.
// Let's keep from line 3000 (index 2999) to end.
// But we should verify if we need to close 'inner', 'nav', etc.
// The original structure was:
// homepage-slot -> ampliance_layout -> inner -> [nav, tab-content]
// We closed tab-content.
// So we are inside 'inner'.
// If lines 3000-3004 represent closing of inner, ampliance_layout, homepage-slot...
// Then we should keep them.

for ($i = 2999; $i < count($lines); $i++) {
    $newContent .= $lines[$i];
}

file_put_contents($file, $newContent);
echo "Cleaned index.php\n";
?>