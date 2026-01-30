<?php
require_once dirname(__DIR__) . '/config.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/db.php';

$post = null;
$sections = [];
$is_granular = false;
$message = '';
$error = '';

// Fetch by ID or Slug
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $post = $stmt->fetch();
} elseif (isset($_GET['slug'])) {
    $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE slug = ?");
    $stmt->execute([$_GET['slug']]);
    $post = $stmt->fetch();
}

if ($post && ($post['slug'] == 'rejim-rehberi' || $post['slug'] == 'malzeme-sozlugu' || $post['slug'] == 'katmanlama-kilavuzu')) {
    $is_granular = true;
    $stmtSec = $pdo->prepare("SELECT section_key, section_value FROM blog_post_sections WHERE post_id = ?");
    $stmtSec->execute([$post['id']]);
    $fetched_sections = $stmtSec->fetchAll(PDO::FETCH_KEY_PAIR);
    $sections = $fetched_sections;
}

// Define fields based on slug
$granular_fields = [];

if ($post && $post['slug'] == 'rejim-rehberi') {
    $granular_fields = [
        'Header' => [
            'header_logo_url' => ['label' => 'Header Logo', 'type' => 'image'],
            'main_title' => ['label' => 'Main Title', 'type' => 'text'],
        ],
        'Rejim Temelleri' => [
            'regimen_basics_title' => ['label' => 'Başlık', 'type' => 'text'],
            'regimen_basics_text' => ['label' => 'Metin', 'type' => 'textarea'],
        ],
        'Kaç Ürün?' => [
            'how_many_products_title' => ['label' => 'Başlık', 'type' => 'text'],
            'how_many_products_text' => ['label' => 'Metin', 'type' => 'textarea'],
            'how_many_products_image' => ['label' => 'Sol Görsel', 'type' => 'image'],
        ],
        'Adım 1: Hazırlık' => [
            'step1_title' => ['label' => 'Başlık', 'type' => 'text'],
            'step1_text' => ['label' => 'Metin', 'type' => 'textarea'],
            'middle_right_image' => ['label' => 'Orta Sağ Görsel', 'type' => 'image'],
        ],
        'Adım 2: Tedavi' => [
            'step2_title' => ['label' => 'Başlık', 'type' => 'text'],
            'step2_text' => ['label' => 'Metin', 'type' => 'textarea'],
            'infographic_image' => ['label' => 'Infografik Görsel', 'type' => 'image'],
        ],
        'Aynı Format & Çakışan Ürünler' => [
             'multiple_products_title' => ['label' => 'Aynı Format Başlık', 'type' => 'text'],
             'multiple_products_text' => ['label' => 'Aynı Format Metin', 'type' => 'textarea'],
             'conflicting_products_title' => ['label' => 'Çakışan Ürünler Başlık', 'type' => 'text'],
             'conflicting_products_text' => ['label' => 'Çakışan Ürünler Metin', 'type' => 'textarea'],
             'conflicting_products_image' => ['label' => 'Çakışan Ürünler Sol Görsel', 'type' => 'image'],
             'middle_right_image_2' => ['label' => 'Orta Sağ Görsel 2', 'type' => 'image'],
        ],
        'Adım 3: Koruma' => [
            'step3_title' => ['label' => 'Başlık', 'type' => 'text'],
            'step3_text' => ['label' => 'Metin', 'type' => 'textarea'],
        ],
        'FAQ' => [
            'faq_title' => ['label' => 'S.S.S Başlık', 'type' => 'text'],
            'faq_text' => ['label' => 'S.S.S Metin', 'type' => 'textarea'],
            'faq_image' => ['label' => 'S.S.S Sol Görsel', 'type' => 'image'],
        ],
    ];
} elseif ($post && $post['slug'] == 'malzeme-sozlugu') {
    $granular_fields = [
        'Genel' => [
            'page_title' => ['label' => 'Sayfa Başlığı', 'type' => 'text'],
            'intro_text' => ['label' => 'Giriş Metni', 'type' => 'textarea'],
            'header_image' => ['label' => 'Header Görseli', 'type' => 'image'],
        ],
        'İçindekiler (A-F)' => [
            'ingredients_a_f' => ['label' => 'İçerik Listesi', 'type' => 'json_repeater'],
        ],
        'İçindekiler (G-L)' => [
            'ingredients_g_l' => ['label' => 'İçerik Listesi', 'type' => 'json_repeater'],
        ],
        'İçindekiler (M-R)' => [
            'ingredients_m_r' => ['label' => 'İçerik Listesi', 'type' => 'json_repeater'],
        ],
        'İçindekiler (S-Z)' => [
            'ingredients_s_z' => ['label' => 'İçerik Listesi', 'type' => 'json_repeater'],
        ],
    ];
} elseif ($post && $post['slug'] == 'katmanlama-kilavuzu') {
    $granular_fields = [
        'Genel' => [
            'header_title' => ['label' => 'Sayfa Başlığı', 'type' => 'text'],
            'header_subtitle' => ['label' => 'Sayfa Alt Başlığı', 'type' => 'text'],
            'header_image' => ['label' => 'Header Görseli (İkon)', 'type' => 'image'],
        ],
        'Bölüm 1: Giriş' => [
            'section_1_title' => ['label' => 'Başlık', 'type' => 'text'],
            'section_1_content' => ['label' => 'İçerik', 'type' => 'textarea'],
            'section_1_image_1' => ['label' => 'Sol/Üst Görsel', 'type' => 'image'],
            'section_1_image_2' => ['label' => 'Sağ/Alt Görsel', 'type' => 'image'],
        ],
        'Bölüm 2: Cilt Tipleri' => [
            'section_2_title' => ['label' => 'Başlık', 'type' => 'text'],
            'section_2_content' => ['label' => 'İçerik', 'type' => 'textarea'],
            'section_2_image_1' => ['label' => 'Sol Görsel', 'type' => 'image'],
            'section_2_image_2' => ['label' => 'Sağ Görsel', 'type' => 'image'],
        ],
        'Bölüm 3: Rutinler vs Katmanlama' => [
            'section_3_title' => ['label' => 'Başlık', 'type' => 'text'],
            'section_3_content' => ['label' => 'İçerik', 'type' => 'textarea'],
            'section_3_image_1' => ['label' => 'Sol Görsel', 'type' => 'image'],
            'section_3_image_2' => ['label' => 'Sağ Görsel', 'type' => 'image'],
        ],
        'Bölüm 4: SSS' => [
            'section_4_title' => ['label' => 'Başlık', 'type' => 'text'],
            'section_4_content' => ['label' => 'İçerik', 'type' => 'textarea'],
            'section_4_image_1' => ['label' => 'Görsel', 'type' => 'image'],
            'section_4_image_2' => ['label' => '2. Görsel', 'type' => 'image'],
        ],
        'Bölüm 5: Öneriler' => [
            'section_5_title' => ['label' => 'Başlık', 'type' => 'text'],
            'section_5_content' => ['label' => 'İçerik', 'type' => 'textarea'],
            'section_5_image_1' => ['label' => 'Görsel', 'type' => 'image'],
            'section_5_image_2' => ['label' => '2. Görsel', 'type' => 'image'],
        ],
        'Bölüm 6: Kapanış' => [
            'section_6_title' => ['label' => 'Başlık', 'type' => 'text'],
            'section_6_content' => ['label' => 'İçerik', 'type' => 'textarea'],
            'section_6_image_1' => ['label' => 'Görsel', 'type' => 'image'],
            'section_6_image_2' => ['label' => '2. Görsel', 'type' => 'image'],
        ],
    ];
}

// Handle File Upload Function
function handleFileUpload($fileInputName) {
    if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
        $uploadDir = BASE_PATH . '/assets/uploads/blog/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $fileTmpPath = $_FILES[$fileInputName]['tmp_name'];
        $fileName = $_FILES[$fileInputName]['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $fileName . mt_rand()) . '.' . $fileExtension;
        
        $allowedfileExtensions = array('jpg', 'gif', 'png', 'webp', 'jpeg', 'svg');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $dest_path = $uploadDir . $newFileName;
            if(move_uploaded_file($fileTmpPath, $dest_path)) {
                return BASE_URL . '/assets/uploads/blog/' . $newFileName;
            }
        }
    }
    return null;
}

function handleNestedFileUpload($key, $index, $subKey) {
    // $_FILES[$key]['name'][$index][$subKey]
    if (isset($_FILES[$key]['name'][$index][$subKey]) && $_FILES[$key]['error'][$index][$subKey] === UPLOAD_ERR_OK) {
        $uploadDir = BASE_PATH . '/assets/uploads/blog/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        
        $tmpName = $_FILES[$key]['tmp_name'][$index][$subKey];
        $name = $_FILES[$key]['name'][$index][$subKey];
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $newFileName = md5(time() . $name . mt_rand()) . '.' . $ext;
        
        if (in_array($ext, ['jpg', 'gif', 'png', 'webp', 'jpeg', 'svg'])) {
            if(move_uploaded_file($tmpName, $uploadDir . $newFileName)) {
                return BASE_URL . '/assets/uploads/blog/' . $newFileName;
            }
        }
    }
    return null;
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $content = $is_granular ? ($post['content'] ?? '') : $_POST['content']; 
    
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $status = isset($_POST['status']) ? 1 : 0;

    try {
        if ($id) {
            $stmt = $pdo->prepare("UPDATE blog_posts SET title=?, slug=?, content=?, meta_title=?, meta_description=?, status=? WHERE id=?");
            $stmt->execute([$title, $slug, $content, $meta_title, $meta_description, $status, $id]);
            
            // Update Sections
            if ($is_granular) {
                $stmtSecUpdate = $pdo->prepare("INSERT INTO blog_post_sections (post_id, section_key, section_value, section_type) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE section_value = VALUES(section_value)");
                
                foreach ($granular_fields as $group) {
                    foreach ($group as $key => $props) {
                        $val = null;
                        $type = 'text';

                        if ($props['type'] === 'image') {
                            $uploadedUrl = handleFileUpload($key);
                            if ($uploadedUrl) {
                                $val = $uploadedUrl;
                            } elseif (isset($_POST['existing_' . $key])) {
                                $val = $_POST['existing_' . $key];
                            }
                            $type = 'image';
                        } elseif ($props['type'] === 'json_repeater') {
                            $type = 'json';
                            // Process Array Input
                            if (isset($_POST[$key]) && is_array($_POST[$key])) {
                                $items = $_POST[$key];
                                
                                // Determine sub-fields (default or custom)
                                $subFields = $props['fields'] ?? [
                                    'image' => ['type'=>'image'], 
                                    'title' => ['type'=>'text'], 
                                    'link' => ['type'=>'text'], 
                                    'subtitle' => ['type'=>'textarea']
                                ];

                                // Handle File Uploads for each item
                                foreach ($items as $idx => &$item) {
                                    foreach ($subFields as $subKey => $subProps) {
                                        if ($subProps['type'] === 'image') {
                                            $uploadedItemUrl = handleNestedFileUpload($key, $idx, $subKey);
                                            if ($uploadedItemUrl) {
                                                $item[$subKey] = $uploadedItemUrl;
                                            } elseif (empty($item[$subKey]) && isset($_POST['existing_' . $key][$idx][$subKey])) {
                                                // Keep existing if not empty and no new upload
                                                $item[$subKey] = $_POST['existing_' . $key][$idx][$subKey];
                                            }
                                        }
                                    }
                                }
                                $val = json_encode(array_values($items), JSON_UNESCAPED_UNICODE);
                            } else {
                                $val = '[]';
                            }
                        } else {
                            if (isset($_POST[$key])) {
                                $val = $_POST[$key];
                            }
                        }

                        if ($val !== null) {
                            $stmtSecUpdate->execute([$id, $key, $val, $type]);
                        }
                    }
                }
                
                // Refetch sections
                $stmtSec = $pdo->prepare("SELECT section_key, section_value FROM blog_post_sections WHERE post_id = ?");
                $stmtSec->execute([$id]);
                $sections = $stmtSec->fetchAll(PDO::FETCH_KEY_PAIR);
            }


            // Refresh post
            $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE id = ?");
            $stmt->execute([$id]);
            $post = $stmt->fetch();
            $message = "Blog yazısı ve bölümleri başarıyla güncellendi.";
        } else {
             // Insert logic (Generic)
             $stmt = $pdo->prepare("INSERT INTO blog_posts (title, slug, content, meta_title, meta_description, status) VALUES (?, ?, ?, ?, ?, ?)");
             $stmt->execute([$title, $slug, $content, $meta_title, $meta_description, $status]);
             $id = $pdo->lastInsertId();
             $post = ['id' => $id, 'title' => $title, 'slug' => $slug, 'content' => $content, 'meta_title' => $meta_title, 'meta_description' => $meta_description, 'status' => $status];
             $message = "Yeni blog yazısı oluşturuldu.";
        }
    } catch (PDOException $e) {
        $error = "Veritabanı hatası: " . $e->getMessage();

}
}
?>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><?php echo $post ? 'Yazıyı Düzenle: ' . htmlspecialchars($post['title']) : 'Yeni Yazı Ekle'; ?></h2>
        <a href="blog-posts.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Geri Dön</a>
    </div>

    <?php if ($message): ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <?php if ($post): ?>
                    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Yazı Başlığı (H1)</label>
                            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($post['title'] ?? ''); ?>" required>
                        </div>
                        
                        <?php if ($is_granular): ?>
                            <div class="alert alert-info border-start border-4 border-info">
                                <i class="fas fa-magic me-2"></i><strong>Özel Sayfa Düzeni Modu</strong><br>
                                Bu sayfa özel bir düzene sahiptir. Görselleri güncellemek için dosya seçebilirsiniz.
                            </div>
                            
                            <ul class="nav nav-tabs mb-3" id="sectionsTab" role="tablist">
                                <?php $i = 0; foreach ($granular_fields as $groupName => $fields): $i++; ?>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link <?php echo $i === 1 ? 'active' : ''; ?>" id="tab-<?php echo $i; ?>" data-bs-toggle="tab" data-bs-target="#content-<?php echo $i; ?>" type="button" role="tab"><?php echo $groupName; ?></button>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            
                            <div class="tab-content border p-3 rounded-bottom bg-light mb-3" id="sectionsTabContent">
                                <?php $i = 0; foreach ($granular_fields as $groupName => $fields): $i++; ?>
                                    <div class="tab-pane fade <?php echo $i === 1 ? 'show active' : ''; ?>" id="content-<?php echo $i; ?>" role="tabpanel">
                                        <?php foreach ($fields as $key => $props): ?>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold small text-uppercase text-muted"><?php echo $props['label']; ?></label>
                                                
                                                <?php if ($props['type'] === 'textarea'): ?>
                                                    <textarea name="<?php echo $key; ?>" class="form-control" rows="5"><?php echo htmlspecialchars($sections[$key] ?? ''); ?></textarea>
                                                
                                                <?php elseif ($props['type'] === 'image'): ?>
                                                    <div class="card p-2">
                                                        <?php if (!empty($sections[$key])): ?>
                                                            <div class="mb-2">
                                                                <img src="<?php echo $sections[$key]; ?>" class="img-thumbnail" style="max-height: 150px;">
                                                                <div class="small text-muted mt-1 text-break"><?php echo basename($sections[$key]); ?></div>
                                                            </div>
                                                        <?php endif; ?>
                                                        <input type="file" name="<?php echo $key; ?>" class="form-control" accept="image/*">
                                                        <input type="hidden" name="existing_<?php echo $key; ?>" value="<?php echo htmlspecialchars($sections[$key] ?? ''); ?>">
                                                        <div class="form-text">Yeni bir görsel yüklemek için dosya seçin. (JPG, PNG, WEBP)</div>
                                                    </div>

                                                <?php elseif ($props['type'] === 'json_repeater'): ?>
                                                    <div class="repeater-container" data-key="<?php echo $key; ?>">
                                                        <?php 
                                                            $items = json_decode($sections[$key] ?? '[]', true); 
                                                            if (!is_array($items)) $items = [];
                                                            
                                                            // Determine definition for subfields
                                                            $subFields = $props['fields'] ?? [
                                                                'image' => ['type'=>'image', 'label'=>'Görsel'], 
                                                                'title' => ['type'=>'text', 'label'=>'Başlık'], 
                                                                'link' => ['type'=>'text', 'label'=>'Link'], 
                                                                'subtitle' => ['type'=>'textarea', 'label'=>'Alt Başlık']
                                                            ];
                                                        ?>
                                                        <div class="repeater-items">
                                                            <?php foreach ($items as $idx => $item): ?>
                                                                <div class="card mb-3 repeater-item bg-white border">
                                                                    <div class="card-body p-3">
                                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                                             <div class="fw-bold text-muted small">Öğe #<?php echo $idx + 1; ?></div>
                                                                             <button type="button" class="btn btn-sm btn-outline-danger remove-item" title="Sil"><i class="fas fa-trash-alt"></i></button>
                                                                        </div>
                                                                        
                                                                        <div class="row g-3">
                                                                            <?php foreach ($subFields as $subKey => $subProps): ?>
                                                                                <div class="col-12 <?php echo ($subProps['type'] == 'image') ? 'col-md-3' : 'col-md-9'; ?>">
                                                                                    <label class="form-label small fw-bold"><?php echo $subProps['label'] ?? $subKey; ?></label>
                                                                                    
                                                                                    <?php if ($subProps['type'] === 'image'): ?>
                                                                                        <div class="mb-2">
                                                                                            <?php if (!empty($item[$subKey])): ?>
                                                                                                <img src="<?php echo $item[$subKey]; ?>" class="img-thumbnail" style="height: 60px; object-fit: contain;">
                                                                                            <?php else: ?>
                                                                                                <div class="bg-light border rounded d-flex align-items-center justify-content-center text-muted small" style="height: 60px;">Yok</div>
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                        <input type="file" name="<?php echo $key; ?>[<?php echo $idx; ?>][<?php echo $subKey; ?>]" class="form-control form-control-sm">
                                                                                        <input type="hidden" name="existing_<?php echo $key; ?>[<?php echo $idx; ?>][<?php echo $subKey; ?>]" value="<?php echo htmlspecialchars($item[$subKey] ?? ''); ?>">
                                                                                    
                                                                                    <?php elseif ($subProps['type'] === 'textarea'): ?>
                                                                                        <textarea name="<?php echo $key; ?>[<?php echo $idx; ?>][<?php echo $subKey; ?>]" class="form-control form-control-sm" rows="<?php echo $subProps['rows'] ?? 2; ?>"><?php echo htmlspecialchars($item[$subKey] ?? ''); ?></textarea>
                                                                                    
                                                                                    <?php else: ?>
                                                                                        <input type="text" name="<?php echo $key; ?>[<?php echo $idx; ?>][<?php echo $subKey; ?>]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($item[$subKey] ?? ''); ?>">
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                        <div class="d-grid gap-2">
                                                            <button type="button" class="btn btn-outline-primary add-repeater-item dashed-border"><i class="fas fa-plus-circle me-2"></i>Yeni Öğe Ekle</button>
                                                        </div>
                                                        
                                                        <!-- Template for New Items -->
                                                        <script type="text/template" id="tmpl-<?php echo $key; ?>">
                                                            <div class="card mb-3 repeater-item bg-white border">
                                                                <div class="card-body p-3">
                                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                                         <div class="fw-bold text-muted small">Yeni Öğe</div>
                                                                         <button type="button" class="btn btn-sm btn-outline-danger remove-item" title="Sil"><i class="fas fa-trash-alt"></i></button>
                                                                    </div>
                                                                    <div class="row g-3">
                                                                        <?php foreach ($subFields as $subKey => $subProps): ?>
                                                                            <div class="col-12 <?php echo ($subProps['type'] == 'image') ? 'col-md-3' : 'col-md-9'; ?>">
                                                                                <label class="form-label small fw-bold"><?php echo $subProps['label'] ?? $subKey; ?></label>
                                                                                
                                                                                <?php if ($subProps['type'] === 'image'): ?>
                                                                                    <div class="bg-light border rounded d-flex align-items-center justify-content-center text-muted small mb-2" style="height: 60px;">Yeni</div>
                                                                                    <input type="file" name="<?php echo $key; ?>[%INDEX%][<?php echo $subKey; ?>]" class="form-control form-control-sm">
                                                                                
                                                                                <?php elseif ($subProps['type'] === 'textarea'): ?>
                                                                                    <textarea name="<?php echo $key; ?>[%INDEX%][<?php echo $subKey; ?>]" class="form-control form-control-sm" rows="<?php echo $subProps['rows'] ?? 2; ?>"></textarea>
                                                                                
                                                                                <?php else: ?>
                                                                                    <input type="text" name="<?php echo $key; ?>[%INDEX%][<?php echo $subKey; ?>]" class="form-control form-control-sm">
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </script>
                                                    </div>

                                                <?php else: ?>
                                                    <input type="text" name="<?php echo $key; ?>" class="form-control" value="<?php echo htmlspecialchars($sections[$key] ?? ''); ?>">
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                        <?php else: ?>
                            <div class="mb-3">
                                <label class="form-label">İçerik (HTML)</label>
                                <textarea name="content" class="form-control" rows="25"><?php echo htmlspecialchars($post['content'] ?? ''); ?></textarea>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="col-md-4">
                         <div class="card bg-light border-0">
                            <div class="card-body">
                                <h6 class="card-title text-muted mb-3">Yayın Ayarları</h6>
                                <div class="mb-3">
                                    <label class="form-label">Slug (URL)</label>
                                    <input type="text" name="slug" class="form-control" value="<?php echo htmlspecialchars($post['slug'] ?? ''); ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Meta Başlık</label>
                                    <input type="text" name="meta_title" class="form-control" value="<?php echo htmlspecialchars($post['meta_title'] ?? ''); ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Meta Açıklama</label>
                                    <textarea name="meta_description" class="form-control" rows="4"><?php echo htmlspecialchars($post['meta_description'] ?? ''); ?></textarea>
                                </div>

                                <div class="mb-3 form-check form-switch">
                                    <input type="checkbox" name="status" class="form-check-input" id="statusCheck" <?php echo (!isset($post['status']) || $post['status']) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="statusCheck">Yayında</label>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-2"><i class="fas fa-save me-2"></i> Değişiklikleri Kaydet</button>
                            </div>
                         </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.add-repeater-item').forEach(btn => {
        btn.addEventListener('click', function() {
            const container = this.closest('.repeater-container');
            const itemsDiv = container.querySelector('.repeater-items');
            const key = container.dataset.key;
            const newIdx = 'new_' + Date.now();
            
            // Get Template Content
            const template = document.getElementById('tmpl-' + key);
            if (!template) {
                console.error('Template not found for ' + key);
                return;
            }
            
            let html = template.innerHTML;
            html = html.replace(/%INDEX%/g, newIdx);
            
            itemsDiv.insertAdjacentHTML('beforeend', html);
        });
    });

    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-item')) {
            e.target.closest('.repeater-item').remove();
        }
    });
});
</script>
<?php include 'includes/footer.php'; ?>