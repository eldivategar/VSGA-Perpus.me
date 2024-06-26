<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VSGA - Perpus.me</title>

    <!-- Site Icon -->
    <link rel="icon" href="../assets/img/perpus.me.ico" type="image/x-icon">

    <!-- Bootstrap 5.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <!-- Custom Style -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <!-- Top Navbar -->
    <?php
    include '../component/navbar.php';
    ?>

    <section class="m-4" style="padding-top: 5rem;">
        <!-- Button trigger modal -->
        <div class="text-end">
            <button type="button" id="addMemberButton" class="btn create-btn" data-bs-toggle="modal" data-bs-target="#myModal">
                Tambah Anggota
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="myModalLabel">Tambah Anggota Baru</h1>
                    </div>
                    <form action="post.php" id="memberForm" method="post">
                        <div class="modal-body">
                            <div class="row g-3">
                                <input type="hidden" name="member_id" id="member_id">
                                <div class="col-md-6">
                                    <label for="fname" class="form-label">Nama Depan</label>
                                    <input type="text" class="form-control" id="fname" name="fname" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lname" class="form-label">Nama Belakang</label>
                                    <input type="text" class="form-control" id="lname" name="lname" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="address" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="address" name="address" required></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="phone" class="form-label">No. Handphone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="l_gender" value="L">
                                        <label class="form-check-label" for="l_gender">
                                            Laki-laki
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="p_gender" value="P">
                                        <label class="form-check-label" for="p_gender">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header text-center" style="background-color: #0E46A3;">
                <h5 class="text-white">Data Anggota Perpus.me</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <?php
                        include '../database/connection.php';
                        $query = "SELECT * FROM members ORDER BY member_id DESC";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            $rowCount = mysqli_num_rows($result);
                            echo "<caption>" . "Total Anggota: " . $rowCount . " </caption>";
                        ?>
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Telp</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($result as $member => $value) {
                                ?>
                                    <tr>
                                        <td scope="row"><?= $member + 1 ?></td>
                                        <td><?= $value['first_name'] . " " . $value['last_name'] ?></td>
                                        <td><?= $value['address'] ?></td>
                                        <td><?= $value['email'] ?></td>
                                        <td><?= $value['phone'] ?></td>
                                        <td><?= $value['gender'] ?></td>
                                        <td>
                                            <div class="d-grid gap-2 d-md-block">
                                                <button class="btn btn-outline-info edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#myModal" data-member='<?= json_encode($value) ?>'>Edit</button>
                                                <!-- <button class="btn btn-outline-danger" type="button">Hapus</button> -->
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<caption>" . "Total Anggota: 0" . "</caption>";
                            }
                            ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <!-- Custom JS -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const myModal = new bootstrap.Modal(document.getElementById('myModal'));
            const modalTitle = document.getElementById('myModalLabel');
            const memberForm = document.getElementById('memberForm');

            const addMemberButton = document.getElementById('addMemberButton');
            addMemberButton.addEventListener('click', () => {
                modalTitle.textContent = 'Tambah Anggota Baru';
                memberForm.reset();
            });

            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const member = JSON.parse(button.getAttribute('data-member'));
                    modalTitle.textContent = 'Edit Data Anggota';
                    memberForm.action = '../members/update.php';

                    document.getElementById('member_id').value = member.member_id;
                    document.getElementById('fname').value = member.first_name;
                    document.getElementById('lname').value = member.last_name;
                    document.getElementById('address').value = member.address;
                    document.getElementById('email').value = member.email;
                    document.getElementById('phone').value = member.phone;
                    console.log(member)
                    if (member.gender === 'L') {
                        document.getElementById('l_gender').value = 'L';
                        document.getElementById('l_gender').checked = true;
                    } else if (member.gender === 'P') {
                        document.getElementById('p_gender').value = 'P';
                        document.getElementById('p_gender').checked = true;
                    }
                });
            });
        });
    </script>
</body>

</html>