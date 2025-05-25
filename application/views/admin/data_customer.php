<!-- application/views/admin/data_customer.php -->
<div class="container mt-4">
    <h3 class="mb-4"><?= $title; ?></h3>

    <?= $this->session->flashdata('pesan'); ?>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Profil</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr class="align-middle text-center">
                            <td><?= $user->id; ?></td>
                            <td class="text-start"><?= htmlspecialchars($user->name); ?></td>
                            <td><?= htmlspecialchars($user->email); ?></td>
                            <td>
                                <img src="<?= base_url('assets/img/profile/' . $user->image); ?>" alt="foto" width="50" class="img-thumbnail rounded-circle">
                            </td>
                            <td>
                                <span class="<?= $user->is_active ? 'text-success' : 'text-danger'; ?>">
                                    <?= $user->is_active ? 'Aktif' : 'Tidak Aktif'; ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">Data customer tidak ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
