<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 if (isset($_SESSION['user_id'])) : ?>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <div class="header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h1 class="text-center mb-4">USER MANAGEMENT</h1>
        <div class="col-md-4 col-lg-3 search-bar">
            <input type="text" class="form-control rounded-pill" placeholder="Search users" id="recycleSearchInput">
        </div>
    </div>

    <div class="container mt-5">
        <h2>Admin</h2>
        <table class="table table-bordered table-striped table-hover" style="border-radius: 15px; overflow: y;">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Profile</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Role</th>
                    <th style="text-align:center; border-top-right-radius: 1px;" scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <?php foreach ($users as $user): ?>
                    <?php if($user['role']==='admin') :?>
                        <tr>
                            <td class="text-center">
                                <img src="<?= $user['profile'] ?>" alt="Profile Image" width="50" height="50" class="rounded-circle">
                            </td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['phone']) ?></td>
                            <td>
                                <span class="badge text-white px-3 py-1" style="border-radius: 20px; font-size: 12px; background-color: 
                                    <?php echo ($user['role'] == 'Admin') ? '#dc3545' : 
                                    (($user['role'] == 'User') ? '#ffc107' : '#28a745'); ?>;">
                                    <?= htmlspecialchars($user['role']) ?>
                                </span>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <div class="dropdown">
                                    <button class="btn btn-light border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: none;">
                                        <i class="material-icons">more_vert</i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/users/edit/<?= $user['id'] ?>">
                                            <i class="material-icons">edit</i> Edit</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endif;?>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- For customers -->
        <h2 style="margin-top: 100px;">Customers</h2>
        <table class="table table-bordered table-striped table-hover" style="border-radius: 15px; overflow: y; margin-top: 20px;">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Profile</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Role</th>
                    <th style="text-align:center; border-top-right-radius: 1px;" scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <?php foreach ($users as $user): ?>
                    <?php if($user['role']==='users') :?>
                        <tr>
                            <td class="text-center">
                                <img src="<?= $user['profile'] ?>" alt="Profile Image" width="50" height="50" class="rounded-circle">
                            </td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['phone']) ?></td>
                            <td>
                                <span class="badge text-white px-3 py-1" style="border-radius: 20px; font-size: 12px; background-color: 
                                    <?php echo ($user['role'] == 'Admin') ? '#dc3545' : 
                                    (($user['role'] == 'User') ? '#ffc107' : '#28a745'); ?>;">
                                    <?= htmlspecialchars($user['role']) ?>
                                </span>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <div class="dropdown">
                                    <button class="btn btn-light border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: none;">
                                        <i class="material-icons">more_vert</i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/users/edit/<?= $user['id'] ?>">
                                            <i class="material-icons">edit</i> Edit</a></li>
                                        <li><a class="dropdown-item text-danger delete-user" href="#" data-id="<?= $user['id'] ?>">
                                            <i class="material-icons">delete</i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endif;?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


 
    <!-- Include SweetAlert Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // SweetAlert Move to Trash Confirmation
    document.querySelectorAll('.delete-user').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default anchor action
            const userId = this.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This user will be moved to the trash!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, move to trash!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to move-to-trash action
                    window.location.href = `/users/delete/${userId}`;
                }
            });
        });
    });
    document.getElementById("recycleSearchInput").addEventListener("input", function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll("#userTableBody tr");
    
    rows.forEach(row => {
        const username = row.querySelector("td:nth-child(3)")?.textContent.toLowerCase();
        const email = row.querySelector("td:nth-child(4)")?.textContent.toLowerCase();
        const phone = row.querySelector("td:nth-child(5)")?.textContent.toLowerCase();
        const role = row.querySelector("td:nth-child(6)")?.textContent.toLowerCase();

        if (username.includes(searchTerm) || email.includes(searchTerm) ||
            phone.includes(searchTerm) || role.includes(searchTerm)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});

</script>
<?php 
else: 
    $this->redirect("/login"); 
endif;   
?>