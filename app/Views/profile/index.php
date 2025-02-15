<?= $this->extend("layout/index") ?>
<?= $this->section("title") ?> <?= $title ?> <?= $this->endSection() ?>
<?= $this->section("content") ?>
    <h1><?= $title ?></h1>
<?= $this->endSection() ?>
