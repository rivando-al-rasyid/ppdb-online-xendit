<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('dashboard'));
});

Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('dashboard'));
});

Breadcrumbs::for('profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Profile', route('profile.edit'));
});

Breadcrumbs::for('pembayaran.create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Tagihan', route('pembayaran.create'));
});

Breadcrumbs::for('pembayaran.hasil', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Tagihan', route('pembayaran.hasil'));
});

Breadcrumbs::for('pembayaran.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Tagihan', route('pembayaran.index'));
});

Breadcrumbs::for('pembayaran.invoice', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Tagihan', route('pembayaran.invoice'));
});


Breadcrumbs::for('admin', function (BreadcrumbTrail $trail) {
    $trail->push('Admin', route('admin.dashboard'));
});

Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('Dashboard', route('admin.dashboard'));
});

Breadcrumbs::for('admin.profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Profile Admin', route('admin.profile.edit'));
});

Breadcrumbs::for('sekolah.profile', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Profile Admin', route('sekolah.profile'));
});
Breadcrumbs::for('admin.pekerjaan_ortu.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Profile Admin', route('admin.pekerjaan_ortu.index'));
});

Breadcrumbs::for('admin.pekerjaan_ortu.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Profile Admin', route('admin.pekerjaan_ortu.create'));
});

Breadcrumbs::for('admin.penghasilan_ortu.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Profile Admin', route('admin.penghasilan_ortu.index'));
});

Breadcrumbs::for('admin.penghasilan_ortu.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Profile Admin', route('admin.penghasilan_ortu.create'));
});

Breadcrumbs::for('peserta.detail', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('admin.dashboard');
    $trail->push('Profile Admin', route('peserta.detail', ['id' => $id]));
});




Breadcrumbs::for('tu', function (BreadcrumbTrail $trail) {
    $trail->push('Tata Usaha', route('tu.dashboard'));
});

Breadcrumbs::for('tu.dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('tu');
    $trail->push('Dashboard', route('tu.dashboard'));
});

Breadcrumbs::for('tu.profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('tu.dashboard');
    $trail->push('Profile Staft TU', route('tu.profile.edit'));
});
