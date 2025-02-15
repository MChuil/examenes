<?= $this->extend("layout/index") ?>

<?= $this->section("title") ?> Inicio <?= $this->endSection() ?>

<?= $this->section("content") ?>
    <h1>Bienvenido al sistema de Examenes On-line</h1>

    <?php echo base_url(); ?>

<?= $this->endSection() ?>