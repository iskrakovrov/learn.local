<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);

// Проверяем, есть ли поле bio в таблице reg_options, если нет — добавляем
$sql = "SHOW COLUMNS FROM reg_options LIKE 'bio'";
$qw = create($sql);
if (empty($qw)) {
    $sql = "ALTER TABLE `reg_options` ADD `bio` INT(11) NOT NULL DEFAULT 0 AFTER `mode`;";
    create($sql);
}

// Получаем данные для выпадающих списков
$proxyGroups = selectAll("SELECT id, name_group FROM group_proxy ORDER BY name_group");
$servers = selectAll("SELECT id, name_server FROM servers ORDER BY name_server");
$accountGroups = selectAll("SELECT id, name_group FROM group_acc ORDER BY name_group");
$emails = selectAll("SELECT id, name FROM lists WHERE cat = 13 ORDER BY name");
$firstNames = selectAll("SELECT id, name FROM lists WHERE cat = 3 ORDER BY name");
$lastNames = selectAll("SELECT id, name FROM lists WHERE cat = 3 ORDER BY name");
$cities = selectAll("SELECT id, name FROM lists WHERE cat = 2 ORDER BY name");
$bioOptions = selectAll("SELECT id, name FROM lists WHERE cat = 5 ORDER BY name");

// Получаем сохраненные настройки пользователя
$userId = $_SESSION['user_id'] ?? 0;
$savedOptions = select("SELECT * FROM reg_options WHERE user_id = ?", [$userId]);

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['reset'])) {
        // Обновляем запись, устанавливая все значения в NULL или 0 (bio — в 0)
        $query = "UPDATE reg_options SET 
              proxy_group = NULL,
              server = NULL,
              account_group = NULL,
              email = NULL,
              registration_method = NULL,
              link_email = NULL,
              gender = NULL,
              avatar = NULL,
              city = NULL,
              first_name = NULL,
              last_name = NULL,
              mcc_mnc_source = NULL,
              mode = NULL,
              bio = 0
              WHERE user_id = ?";

        update($query, [$userId]);

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    if (isset($_POST['mode'])) {
        // Подготовка данных из формы
        $data = [
            'user_id' => $userId,
            'proxy_group' => $_POST['proxy_group'] ?? null,
            'server' => $_POST['server'] ?? null,
            'account_group' => $_POST['account_group'] ?? null,
            'email' => $_POST['email'] ?? null,
            'registration_method' => $_POST['registration_method'] ?? null,
            'link_email' => $_POST['link_email'] ?? null,
            'gender' => $_POST['gender'] ?? null,
            'avatar' => $_POST['avatar'] ?? null,
            'city' => $_POST['city'] ?? null,
            'first_name' => $_POST['first_name'] ?? null,
            'last_name' => $_POST['last_name'] ?? null,
            'mcc_mnc_source' => $_POST['mcc_mnc_source'] ?? null,
            'mode' => $_POST['mode'],
            'bio' => $_POST['bio'] ?? 0,
        ];

        if ($savedOptions) {
            // Обновляем существующие настройки
            $query = "UPDATE reg_options SET 
                      proxy_group = :proxy_group,
                      server = :server,
                      account_group = :account_group,
                      email = :email,
                      registration_method = :registration_method,
                      link_email = :link_email,
                      gender = :gender,
                      avatar = :avatar,
                      city = :city,
                      first_name = :first_name,
                      last_name = :last_name,
                      mcc_mnc_source = :mcc_mnc_source,
                      mode = :mode,
                      bio = :bio
                      WHERE user_id = :user_id";
        } else {
            // Вставляем новые настройки
            $query = "INSERT INTO reg_options 
                      (user_id, proxy_group, server, account_group, email, registration_method, 
                       link_email, gender, avatar, city, first_name, last_name, mcc_mnc_source, mode, bio)
                      VALUES 
                      (:user_id, :proxy_group, :server, :account_group, :email, :registration_method,
                       :link_email, :gender, :avatar, :city, :first_name, :last_name, :mcc_mnc_source, :mode, :bio)";
        }

        insert($query, $data);

        // Перенаправление на соответствующую страницу
        if ($_POST['mode'] == '1') {
            header('Location: account_creator_page.php');
            exit;
        } elseif ($_POST['mode'] == '2') {
            header('Location: fbcombo_page.php');
            exit;
        }
    }
}
?>

<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- Required meta tags -->
    <?php require_once('inc/meta.php'); ?>
    <title>FB Combo</title>
    <style>
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .form-select {
            margin-bottom: 1rem;
        }
        .settings-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .section-title {
            color: #0d6efd;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .btn-reset {
            margin-left: 10px;
        }
        .mcc-mnc-info {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: -0.5rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
<?php require_once 'inc/header.php'; ?>

<main class="container-fluid">
    <div class="row text-center mb-4">
        <h2 class="mt-3">Setting mobile mode</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="settings-card">
                <div class="alert alert-info" role="alert">
                    <h4 class="alert-heading">Setting up the account creator</h4>
                    <p class="mb-0">Please configure all required settings before activation</p>
                </div>

                <form method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="section-title">Proxy Settings</h5>

                            <label for="proxyGroup" class="form-label">Proxy group. Attention! Use SOCKS5 proxy.</label>
                            <select class="form-select" id="proxyGroup" name="proxy_group" aria-label="Proxy group select">
                                <option selected disabled>Select proxy group</option>
                                <?php foreach ($proxyGroups as $group): ?>
                                    <option value="<?= $group['id'] ?>"
                                        <?= ($savedOptions['proxy_group'] ?? null) == $group['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($group['name_group']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <h5 class="section-title">MCC-MNC Settings</h5>

                            <label for="mccMncSource" class="form-label">Determine MCC-MNC by:</label>
                            <select class="form-select" id="mccMncSource" name="mcc_mnc_source" aria-label="MCC-MNC source select">
                                <option selected disabled>Select MCC-MNC source</option>
                                <option value="0" <?= isset($savedOptions['mcc_mnc_source']) && $savedOptions['mcc_mnc_source'] == 0 ? 'selected' : '' ?>>Phone number</option>
                                <option value="1" <?= isset($savedOptions['mcc_mnc_source']) && $savedOptions['mcc_mnc_source'] == 1 ? 'selected' : '' ?>>Proxy IP</option>
                            </select>
                            <div class="mcc-mnc-info">
                                MCC (Mobile Country Code) and MNC (Mobile Network Code) will be automatically determined based on the selected source.
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h5 class="section-title">Account Settings</h5>

                            <label for="server" class="form-label">Server for accounts</label>
                            <select class="form-select" id="server" name="server" aria-label="Server select">
                                <option selected disabled>Select server</option>
                                <?php foreach ($servers as $server): ?>
                                    <option value="<?= $server['id'] ?>"
                                        <?= ($savedOptions['server'] ?? null) == $server['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($server['name_server']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <label for="accountGroup" class="form-label">Group accounts</label>
                            <select class="form-select" id="accountGroup" name="account_group" aria-label="Account group select">
                                <option selected disabled>Select account group</option>
                                <?php foreach ($accountGroups as $group): ?>
                                    <option value="<?= $group['id'] ?>"
                                        <?= ($savedOptions['account_group'] ?? null) == $group['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($group['name_group']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <h5 class="section-title">Email Settings</h5>

                            <label for="email" class="form-label">Email</label>
                            <select class="form-select" id="email" name="email" aria-label="Email select">
                                <option value="0" <?= ($savedOptions['email'] ?? null) == 0 ? 'selected' : '' ?>>No email</option>
                                <?php foreach ($emails as $email): ?>
                                    <option value="<?= $email['id'] ?>"
                                        <?= ($savedOptions['email'] ?? null) == $email['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($email['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <label for="registrationMethod" class="form-label">What do we use for registration?</label>
                            <select class="form-select" id="registrationMethod" name="registration_method" aria-label="Registration method select">
                                <option selected disabled>Select registration method</option>
                                <option value="1" <?= ($savedOptions['registration_method'] ?? null) == 1 ? 'selected' : '' ?>>Phone</option>
                                <option value="2" <?= ($savedOptions['registration_method'] ?? null) == 2 ? 'selected' : '' ?>>Mail</option>
                            </select>

                            <label for="linkEmail" class="form-label">After registering using a phone, should I link my email?</label>
                            <select class="form-select" id="linkEmail" name="link_email" aria-label="Link email select">
                                <option selected disabled>Select option</option>
                                <option value="1" <?= ($savedOptions['link_email'] ?? null) == 1 ? 'selected' : '' ?>>No</option>
                                <option value="2" <?= ($savedOptions['link_email'] ?? null) == 2 ? 'selected' : '' ?>>Yes</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h5 class="section-title">Profile Settings</h5>

                            <label for="gender" class="form-label">Gender of accounts?</label>
                            <select class="form-select" id="gender" name="gender" aria-label="Gender select">
                                <option selected disabled>Select gender</option>
                                <option value="1" <?= ($savedOptions['gender'] ?? null) == 1 ? 'selected' : '' ?>>Male</option>
                                <option value="2" <?= ($savedOptions['gender'] ?? null) == 2 ? 'selected' : '' ?>>Female</option>
                            </select>

                            <label for="avatar" class="form-label">Set an avatar for your account? Photos in folder Working folder/ava</label>
                            <select class="form-select" id="avatar" name="avatar" aria-label="Avatar select">
                                <option selected disabled>Select option</option>
                                <option value="1" <?= ($savedOptions['avatar'] ?? null) == 1 ? 'selected' : '' ?>>No</option>
                                <option value="2" <?= ($savedOptions['avatar'] ?? null) == 2 ? 'selected' : '' ?>>Yes</option>
                            </select>

                            <label for="city" class="form-label">Set the account's city of residence?</label>
                            <select class="form-select" id="city" name="city" aria-label="City select">
                                <option selected disabled>Select option</option>
                                <option value="0" <?= ($savedOptions['city'] ?? null) == 0 ? 'selected' : '' ?>>No</option>
                                <?php foreach ($cities as $city): ?>
                                    <option value="<?= $city['id'] ?>"
                                        <?= ($savedOptions['city'] ?? null) == $city['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($city['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <h5 class="section-title">Name Settings</h5>

                            <div class="mb-3">
                                <label for="firstName" class="form-label">First names</label>
                                <select class="form-select" id="firstName" name="first_name" aria-label="First name select">
                                    <option selected disabled>Select first name list</option>
                                    <?php foreach ($firstNames as $name): ?>
                                        <option value="<?= $name['id'] ?>"
                                            <?= ($savedOptions['first_name'] ?? null) == $name['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($name['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last names</label>
                                <select class="form-select" id="lastName" name="last_name" aria-label="Last name select">
                                    <option selected disabled>Select last name list</option>
                                    <?php foreach ($lastNames as $name): ?>
                                        <option value="<?= $name['id'] ?>"
                                            <?= ($savedOptions['last_name'] ?? null) == $name['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($name['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- BIO Section -->
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h5 class="section-title">BIO Settings</h5>

                            <label for="bio" class="form-label">Set BIO for the account?</label>
                            <select class="form-select" id="bio" name="bio" aria-label="BIO select">
                                <option value="0" <?= ($savedOptions['bio'] ?? null) == 0 ? 'selected' : '' ?>>No BIO</option>
                                <?php foreach ($bioOptions as $option): ?>
                                    <option value="<?= $option['id'] ?>"
                                        <?= ($savedOptions['bio'] ?? null) == $option['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($option['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Скрытое поле для режима -->
                    <input type="hidden" name="mode" value="1">

                    <!-- Кнопки -->
                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary btn-lg px-5">Save and Activate</button>
                            <?php if ($savedOptions): ?>
                                <button type="submit" name="reset" class="btn btn-danger btn-lg px-5 btn-reset">Reset Settings</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>

                <?php
                if (isset($error)) {
                    echo '<div class="alert alert-danger mt-3" role="alert">' . $error . '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

</body>
</html>
