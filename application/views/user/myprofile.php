<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>

        <div class="col-lg-8">
            <div class="card mb-3">
                <div class="row g-0 align-items-center">
                    <div class="col-md-4 text-center p-3">
                        <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" 
                             class="rounded-circle img-thumbnail" 
                             alt="Foto Profil" 
                             width="150" height="150" 
                             style="object-fit: cover;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title mb-1"><?= $user['name']; ?></h5>
                            <p class="card-text mb-1"><?= $user['email']; ?></p>
                            <p class="card-text">
                                <small class="text-muted">Profile since <?= date('d F Y', $user['date_created']); ?></small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
