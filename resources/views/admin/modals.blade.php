 <form action="{{ route('admin.user-Management.store') }}" method="POST">
    @csrf
     <div class="modal fade create-user" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
         aria-hidden="true">
         <div class="modal-dialog modal-xl modal-dialog-centered">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="myExtraLargeModalLabel">Create User</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-md-6">
                             <div class="mb-3">
                                 <label class="form-label" for="CreateTask-Task-Name">Nama</label>
                                 <input type="text" name="nama" class="form-control" placeholder="Enter Task Name"
                                     id="CreateTask-Task-Name">
                             </div>

                         </div>
                         <div class="col-md-6">
                             <div class="mb-3">
                                 <label class="form-label" for="CreateTask-Task-Name">Identitas Number</label>
                                 <input type="text" name="identitas" class="form-control"
                                     placeholder="Enter Task Name" id="CreateTask-Task-Name">
                             </div>

                         </div>
                         <div class="col-md-6">
                             <div class="mb-3">
                                 <label class="form-label" for="CreateTask-Team-Member">Password</label>
                                 <input type="password" name="password" class="form-control"
                                     placeholder="Enter Team Member" id="CreateTask-Team-Member">
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="mb-3">
                                 <label class="form-label" for="CreateTask-Category">Role</label>
                                 <select class="form-select" name="role" id="role">
                                     <option selected disabled> Select Role </option>
                                     <option value="admin">Admin</option>
                                     <option value="mahasiswa">Mahasiswa</option>
                                     <option value="dosen">Dosen</option>
                                 </select>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="mb-3">
                                 <label class="form-label" for="CreateTask-Category">Kategori</label>
                                 <select class="form-select" name="kategori" id="kategori">
                                     <option selected disabled> Select Category </option>
                                 </select>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="mb-3">
                                 <label class="form-label" for="CreateTask-Category">Status</label>
                                 <select class="form-select" name="status">
                                     <option selected> Select Category </option>
                                     <option>Active</option>
                                     <option>Non Active</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                     <div class="row mt-2">
                         <div class="col-12 text-end">
                             <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i
                                     class="bx bx-x me-1 align-middle"></i> Cancel</button>
                             <button type="submit" class="btn btn-success" data-bs-toggle="modal"><i
                                     class="bx bx-check me-1 align-middle"></i> Confirm</button>
                         </div>
                     </div>
 </form>
 <script>
     document.getElementById('role').addEventListener('change', function() {
         var role = this.value;
         var kategoriDropdown = document.getElementById('kategori');
         kategoriDropdown.innerHTML = '';

         if (role === 'mahasiswa') {
             var option = document.createElement('option');
             option.text = 'Mahasiswa';
             kategoriDropdown.add(option);
         } else if (role === 'dosen') {
             var options = ['UI/UX', 'Jaringan', 'Website'];
             options.forEach(function(optionValue) {
                 var option = document.createElement('option');
                 option.text = optionValue;
                 kategoriDropdown.add(option);
             });
         }
         else if (role === 'admin') {
             var options = ['Super Admin'];
             options.forEach(function(optionValue) {
                 var option = document.createElement('option');
                 option.text = optionValue;
                 kategoriDropdown.add(option);
             });
         }
     });
 </script>
