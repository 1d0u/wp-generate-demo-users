<?php
/**
 * Plugin Name: Muzip Demo User Generator
 * Description: Generates demo users based on provided username list.
 * Version: 1.0
 * Author: Dogu Pekgoz
 */


// Eklenti aktive edildiğinde çalışacak fonksiyonu tanımlayın
function muzip_demo_user_generator_activate() {
    // Sayfanın var olup olmadığını kontrol edin
    $page_title = 'Muzip Demo User Generator';
    $page_slug = 'muzip-demo-user-generator';

    // Sayfa zaten varsa bir şey yapma
    if (get_page_by_path($page_slug))
        return;

    // Sayfa oluşturma
    $muzip_page = array(
        'post_title' => $page_title,
        'post_content' => '[muzip_demo_user_generator]', // Shortcode'u içeriğe ekle
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_name' => $page_slug,
        'comment_status' => 'closed',
        'ping_status' => 'closed',
    );

    // Sayfayı veritabanına ekle
    wp_insert_post($muzip_page);
}

function muzip_demo_user_generator_shortcode() {
    // Success mesajını kontrol edin
    $success = isset($_GET['success']);

    ob_start();
    ?>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <br>
        <div class="container mt-5">
            <?php if ($success): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Success! Users have been generated.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Muzip Generate Demo Users</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="username">Username List:</label>
                                    <textarea name="username" id="username" class="form-control" rows="10" placeholder="Enter usernames, one per line."></textarea>
                                    <small class="form-text text-muted">One username per line.</small>
                                </div>
                                <div class="form-group">
                                    <a href="https://github.com/jeanphorn/wordlist/blob/master/usernames.txt" class="btn btn-outline-info" target="_blank">Get username List</a>
                                    <button type="submit" class="btn btn-primary float-end" name="submit">Generate Users!</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
        <?php
        $output = ob_get_clean();
        return $output;
}
add_shortcode('muzip_demo_user_generator', 'muzip_demo_user_generator_shortcode');
register_activation_hook(__FILE__, 'muzip_demo_user_generator_activate');

// Processing form submission
function muzip_demo_user_generator_process() {
    if (isset($_POST['submit'])) {
        $username_list = $_POST['username'];
        $username_list = nl2br($username_list);
        $username_list = str_replace('<br />', ',', $username_list);
        $usernames = explode(',', $username_list);
        $users_created = 0;

        foreach ($usernames as $username) {
            $password = randomPassword();
            $email = emailGenerate(trim($username));
            $user_id = wp_create_user($username, $password, $email);
            if (!is_wp_error($user_id)) {
                $users_created++;
            }
        }

        // Eğer kullanıcılar oluşturulduysa, başarı mesajını URL'ye ekleyerek sayfayı yeniden yükleyin
        if ($users_created > 0) {
            wp_redirect(add_query_arg('success', 'true', wp_get_referer()));
            exit;
        }
    }
}
add_action('init', 'muzip_demo_user_generator_process');

// Email Generator
function emailGenerate($username) {
    return $username . rand(0, 9999) . '@gmail.com';
}

// Password Generator
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+';
    $pass = array(); // remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; // put the length -1 in cache
    for ($i = 0; $i < 8; $i++) { // password length changed to 8 for security reasons
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); // turn the array into a string
}