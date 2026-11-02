<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

include 'site_settings.php';
$siteSettings = get_site_settings();
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $saveData = [
        'site_name' => $_POST['site_name'] ?? '',
        'site_tagline' => $_POST['site_tagline'] ?? '',
        'site_logo_url' => $_POST['site_logo_url'] ?? '',
        'hero_title' => $_POST['hero_title'] ?? '',
        'hero_subtitle' => $_POST['hero_subtitle'] ?? '',
        'about_heading' => $_POST['about_heading'] ?? '',
        'about_subtitle' => $_POST['about_subtitle'] ?? '',
        'services_heading' => $_POST['services_heading'] ?? '',
        'services_subtitle' => $_POST['services_subtitle'] ?? '',
        'faq_heading' => $_POST['faq_heading'] ?? '',
        'faq_subtitle' => $_POST['faq_subtitle'] ?? '',
        'contact_heading' => $_POST['contact_heading'] ?? '',
        'contact_subtitle' => $_POST['contact_subtitle'] ?? '',
        'contact_phone' => $_POST['contact_phone'] ?? '',
        'contact_email' => $_POST['contact_email'] ?? '',
        'contact_address' => $_POST['contact_address'] ?? '',
        'contact_hours' => $_POST['contact_hours'] ?? '',
        'social_facebook' => $_POST['social_facebook'] ?? '',
        'social_instagram' => $_POST['social_instagram'] ?? '',
        'social_twitter' => $_POST['social_twitter'] ?? '',
        'social_youtube' => $_POST['social_youtube'] ?? '',
        'admin_brand_name' => $_POST['admin_brand_name'] ?? 'Catering Admin',
    ];

    if (save_site_settings($saveData)) {
        $message = 'Settings saved successfully.';
        $messageType = 'success';
        $siteSettings = get_site_settings();
    } else {
        $message = 'Unable to save settings at this time.';
        $messageType = 'danger';
    }
}

$page_title = 'Admin Settings';
$isAdminPage = true;
include 'header.php';
?>

<style>
.admin-container {
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
}
.page-header {
    background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
    color: white;
    padding: 1.8rem;
    margin-top: 1rem;
    margin-bottom: 1.5rem;
    border-radius: 0.75rem;
}
.page-header h1 {
    margin: 0;
    font-weight: 700;
    font-size: 2rem;
}
.page-header p {
    margin: 0.25rem 0 0;
    opacity: 0.8;
}
.footer-spacing {
    margin-top: 1.5rem;
}
</style>

<div class="container admin-container">
    <div class="page-header">
        <h1>Admin Settings</h1>
        <p>Configure your site settings and branding options.</p>
    </div>

    <div class="row">
        <div class="col-12">
            <?php if ($message): ?>
                <div class="alert alert-<?php echo htmlspecialchars($messageType); ?>"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="post" action="admin_settings.php">
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label class="form-label">Site Name</label>
                                <input type="text" name="site_name" class="form-control" value="<?php echo htmlspecialchars($siteSettings['site_name']); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Site Tagline</label>
                                <input type="text" name="site_tagline" class="form-control" value="<?php echo htmlspecialchars($siteSettings['site_tagline']); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Logo URL</label>
                                <input type="url" name="site_logo_url" class="form-control" value="<?php echo htmlspecialchars($siteSettings['site_logo_url']); ?>" placeholder="https://example.com/logo.png">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Admin Brand Name</label>
                                <input type="text" name="admin_brand_name" class="form-control" value="<?php echo htmlspecialchars($siteSettings['admin_brand_name']); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Hero Title (Home)</label>
                                <input type="text" name="hero_title" class="form-control" value="<?php echo htmlspecialchars($siteSettings['hero_title']); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Hero Subtitle (Home)</label>
                                <input type="text" name="hero_subtitle" class="form-control" value="<?php echo htmlspecialchars($siteSettings['hero_subtitle']); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">About Page Heading</label>
                                <input type="text" name="about_heading" class="form-control" value="<?php echo htmlspecialchars($siteSettings['about_heading']); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">About Page Subtitle</label>
                                <input type="text" name="about_subtitle" class="form-control" value="<?php echo htmlspecialchars($siteSettings['about_subtitle']); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Services Page Heading</label>
                                <input type="text" name="services_heading" class="form-control" value="<?php echo htmlspecialchars($siteSettings['services_heading']); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Services Page Subtitle</label>
                                <input type="text" name="services_subtitle" class="form-control" value="<?php echo htmlspecialchars($siteSettings['services_subtitle']); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">FAQ Page Heading</label>
                                <input type="text" name="faq_heading" class="form-control" value="<?php echo htmlspecialchars($siteSettings['faq_heading']); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">FAQ Page Subtitle</label>
                                <input type="text" name="faq_subtitle" class="form-control" value="<?php echo htmlspecialchars($siteSettings['faq_subtitle']); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Contact Page Heading</label>
                                <input type="text" name="contact_heading" class="form-control" value="<?php echo htmlspecialchars($siteSettings['contact_heading']); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Contact Page Subtitle</label>
                                <input type="text" name="contact_subtitle" class="form-control" value="<?php echo htmlspecialchars($siteSettings['contact_subtitle']); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Contact Phone</label>
                                <input type="text" name="contact_phone" class="form-control" value="<?php echo htmlspecialchars($siteSettings['contact_phone']); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Contact Email</label>
                                <input type="email" name="contact_email" class="form-control" value="<?php echo htmlspecialchars($siteSettings['contact_email']); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Contact Address</label>
                                <input type="text" name="contact_address" class="form-control" value="<?php echo htmlspecialchars($siteSettings['contact_address']); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Business Hours</label>
                                <input type="text" name="contact_hours" class="form-control" value="<?php echo htmlspecialchars($siteSettings['contact_hours']); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Facebook URL</label>
                                <input type="url" name="social_facebook" class="form-control" value="<?php echo htmlspecialchars($siteSettings['social_facebook']); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Instagram URL</label>
                                <input type="url" name="social_instagram" class="form-control" value="<?php echo htmlspecialchars($siteSettings['social_instagram']); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Twitter URL</label>
                                <input type="url" name="social_twitter" class="form-control" value="<?php echo htmlspecialchars($siteSettings['social_twitter']); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">YouTube URL</label>
                                <input type="url" name="social_youtube" class="form-control" value="<?php echo htmlspecialchars($siteSettings['social_youtube']); ?>">
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                            <a href="admin_dashboard.php" class="btn btn-secondary ms-2">Back to Dashboard</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
</div>

<div class="footer-spacing"></div>

<?php include 'footer.php'; ?>