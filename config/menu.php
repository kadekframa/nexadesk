<?php

/*
 * Catatan ikon:
 * Sidebar merender ikon sebagai `ki-duotone`, dan tiap ikon duotone butuh
 * sejumlah <span class="pathN"> sesuai lapisan warnanya. `iconPath` di bawah
 * adalah JUMLAH LAPIS ikon yang bersangkutan -- angkanya tidak boleh dikarang.
 *
 * Cara memastikan saat mengganti ikon: cari `.ki-<nama> .pathN:before` di
 * public/assets/plugins/global/plugins.bundle.css, lalu pakai N terbesar.
 * Kurang -> ikon tampil tidak utuh; lebih -> ada span kosong yang sia-sia.
 *
 * Catatan permission:
 * `permission` berisi nama ability Gate yang didefinisikan di
 * app/Providers/AuthServiceProvider.php. Menu tampil bila pengguna yang login
 * diizinkan minimal satu ability di dalamnya. Array kosong berarti menu tampil
 * untuk semua pengguna yang sudah login.
 */

return [
    # Menus
    'KT_MENU_MODE' => 'auto',
    /** 'manual' or 'auto' */

    'KT_MENUS' => [
        [
            'label'          => 'Menu Utama',
            'type'           => 'heading',
            'permission'     => [],
            'permissionType' => 'gate',
        ],
        [
            'label'          => 'Dashboard',
            'type'           => 'item',
            'route'          => 'home',
            'active'         => ['home*'],
            'permission'     => [],
            'permissionType' => 'gate',
            'icon'           => 'ki',
            'iconName'       => 'ki-element-11',
            'iconPath'       => 4,
        ],

        // Contoh heading + menu yang hanya tampil untuk pengguna yang lolos Gate 'master-data':
        // [
        //     'label'          => 'Master Data',
        //     'type'           => 'heading',
        //     'permission'     => ['master-data'],
        //     'permissionType' => 'gate',
        // ],
        // [
        //     'label'          => 'Contoh Menu',
        //     'type'           => 'item',
        //     'route'          => 'contoh.index',
        //     'active'         => ['contoh.*'],
        //     'permission'     => ['master-data'],
        //     'permissionType' => 'gate',
        //     'icon'           => 'ki',
        //     'iconName'       => 'ki-element-11',
        //     'iconPath'       => 4,
        // ],
    ],
];
