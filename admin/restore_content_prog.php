<?php
$file = dirname(__DIR__) . '/ciltbakim/yaslanma-karsiti.php';
$content = file_get_contents($file);

function insertAfterProduct($content, $pid, $insertion)
{
    // Find the product div with this PID
    $search = 'data-pid="' . $pid . '"';
    $pos = strpos($content, $search);
    if ($pos === false)
        return $content;

    // We are inside <div class="product" ...>
    // This div is inside <div class="product-grid-item">
    // We need to find the CLOSING of product-grid-item.

    // Reverse search for <div class="product-grid-item"> before $pos
    $startItemTag = '<div class="product-grid-item">';
    $startPos = strrpos(substr($content, 0, $pos), $startItemTag);
    if ($startPos === false)
        return $content;

    // Now find the balanced closing div for this Item
    $offset = $startPos + strlen($startItemTag);
    $balance = 1;
    $endPos = false;
    $len = strlen($content);

    for ($i = $offset; $i < $len; $i++) {
        if ($content[$i] == '<') {
            if (substr($content, $i, 4) == '<div') {
                $balance++;
            } elseif (substr($content, $i, 5) == '</div') {
                $balance--;
            }
        }
        if ($balance == 0) {
            $endPos = $i + 6; // Position after </div>
            break;
        }
    }

    if ($endPos !== false) {
        // Insert after
        $content = substr_replace($content, "\n" . $insertion . "\n", $endPos, 0);
    }
    return $content;
}

$block1 = '
    <div class="grid-interrupter-tile" data-category="">
        <div class="grid-interrupter-slot-container">
            <?php 
            $section1 = isset($pageSections[0]) ? $pageSections[0] : null; 
            if ($section1): 
            ?>
                <div class="content-image">
                    <img src="<?= BASE_URL . \'/\' . htmlspecialchars($section1[\'image_url\']) ?>" title="<?= htmlspecialchars($section1[\'title\']) ?>" alt="<?= htmlspecialchars($section1[\'title\']) ?>">
                </div>
                <div class="content-body">
                    <div class="content-title">
                        <?= htmlspecialchars($section1[\'title\']) ?>
                    </div>
                    <div class="content-msg">
                        <?= htmlspecialchars($section1[\'subtitle\']) ?>
                    </div>
                    <?php if ($section1[\'button_text\']): ?>
                    <div class="amp_partial general-cta">
                        <a class="btn-rounded-primary" href="<?= htmlspecialchars($section1[\'button_url\']) ?>"><?= htmlspecialchars($section1[\'button_text\']) ?></a>
                    </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                 <div class="content-image">
                    <img src="<?= BASE_URL ?>/assets/images/noc-yaslanma-icerik-1.png" title="" alt="">
                </div>
                <div class="content-body">
                    <div class="content-title">
                        Çoklu Peptit Yaş Desteği.
                    </div>
                    <div class="content-msg">
                        İnce çizgi ve kırışıklıkların görünümünü hedef alan yaşlanma karşıtı serum.
                    </div>
                    <div class="amp_partial general-cta">
                        <a class="btn-rounded-primary" href="<?= BASE_URL ?>/multi-peptide-ha-serum-100613?pid=100613">Çoklu Peptit Mağazası</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
';

$block2 = '
    <div class="grid-interrupter-tile" data-category="">
        <div class="grid-interrupter-slot-container">
            <?php 
            $section2 = isset($pageSections[1]) ? $pageSections[1] : null; 
            if ($section2): 
            ?>
                 <div class="content-image">
                    <img src="<?= BASE_URL . \'/\' . htmlspecialchars($section2[\'image_url\']) ?>" title="<?= htmlspecialchars($section2[\'title\']) ?>" alt="<?= htmlspecialchars($section2[\'title\']) ?>">
                </div>
                <div class="content-body">
                    <div class="content-title">
                        <?= htmlspecialchars($section2[\'title\']) ?>
                    </div>
                    <div class="content-msg">
                        <?= htmlspecialchars($section2[\'subtitle\']) ?>
                    </div>
                    <?php if ($section2[\'button_text\']): ?>
                    <div class="amp_partial general-cta">
                        <a class="btn-rounded-primary" href="<?= htmlspecialchars($section2[\'button_url\']) ?>"><?= htmlspecialchars($section2[\'button_text\']) ?></a>
                    </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="content-image">
                    <img src="<?= BASE_URL ?>/assets/images/noc-yaslanma-icerik-2.png" title="" alt="">
                </div>
                <div class="content-body">
                    <div class="content-title">
                        Çoklu Peptit Yaş Desteği.
                    </div>
                    <div class="content-msg">
                        İnce çizgi ve kırışıklıkların görünümünü hedef alan yaşlanma karşıtı serum.
                    </div>
                    <div class="amp_partial general-cta">
                        <a class="btn-rounded-primary" href="<?= BASE_URL ?>/multi-peptide-ha-serum-100613?pid=100613">Çoklu Peptit Mağazası</a>
                    </div>
                </div>
             <?php endif; ?>
        </div>
    </div>
';

$content = insertAfterProduct($content, '769915233353', $block1); // After Multi-Peptide + HA
$content = insertAfterProduct($content, '769915232165', $block2); // After Multi-Peptide Eye Serum

file_put_contents($file, $content);
echo "Restoration complete.";
?>