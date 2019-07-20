@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="pt-2 text-white">List Accounts</h5>
                </div>
                <div class="card-body">

                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="createNewNotes">Create New Note</a>

                    <table class="table table-bordered table-striped data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th style="width:50px">Username</th>
                                <th>Note</th>
                                <th style="width:70px">Date Added</th>
                                <th style="width:70px">Date Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalNotes" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="notesForm" name="notesForm" class="form-horizontal">
                    <div class="alert alert-danger" id="message-valid">
                        
                    </div>    

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" id="name" class="form-control" autocomplete="off" required>
                            <small id="helpName" class=" text-danger">Help text</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" id="username" class="form-control" autocomplete="off" required>
                            <small id="helpUsername" class=" text-danger">Help text</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" name="password" id="password" class="form-control" autocomplete="off" required>
                            <small id="helpPassword" class=" text-danger">Help text</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="website" class="col-sm-2 control-label">Website</label>
                        <div class="col-sm-10">
                            <input type="text" name="website" id="website" class="form-control"  autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-sm-2 control-label">Note</label>
                        <div class="col-sm-10">
                            <textarea name="note" id="note" class="form-control" autocomplete="off" required></textarea>
                            <small id="helpNote" class=" text-danger">Help text</small>
                        </div>
                    </div>
                    <div class="col-sm-offser-2 col-sm-10">
                        <input type="submit" class="btn btn-primary" id="saveBtn" value="Save Changes">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalNotesEdit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeadingEdit"></h4>
            </div>
            <div class="modal-body">
                <form id="notesFormEdit" name="notesFormEdit" class="form-horizontal">
                    <input type="hidden" name="notes_idEdit" id="notes_idEdit">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="nameEdit" id="nameEdit" class="form-control" autocomplete="off" required>
                            <small id="helpNameEdit" class=" text-danger">Help text</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="usernameEdit" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="usernameEdit" id="usernameEdit" class="form-control"  autocomplete="off" required>
                            <small id="helpUsernameEdit" class=" text-danger">Help text</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="passwordEdit" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" name="passwordEdit" id="passwordEdit" class="form-control" autocomplete="off" required>
                            <small id="helpPasswordEdit" class=" text-danger">Help text</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="websiteEdit" class="col-sm-2 control-label">Website</label>
                        <div class="col-sm-10">
                            <input type="text" name="websiteEdit" id="websiteEdit" class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="noteEdit" class="col-sm-2 control-label">Note</label>
                        <div class="col-sm-10">
                            <textarea name="noteEdit" id="noteEdit" class="form-control" autocomplete="off" required></textarea>
                            <small id="helpNoteEdit" class=" text-danger">Help text</small>
                        </div>
                    </div>
                    <div class="col-sm-offser-2 col-sm-10">
                        <input type="submit" class="btn btn-primary" id="saveBtnEdit" value="Save Changes">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="modalDetail" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading">Detail Note</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>
                                <div id="nameDetail"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>
                                <div id="usernameDetail"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td>
                                <div id="passwordDetail"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Website</th>
                            <td>
                                <a href="" id="websiteDetail" target="_blank">
                            </td>
                        </tr>
                        <tr>
                            <th>Note</th>
                            <td>
                                <div id="noteDetail"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('jquery')
    <script>
        // Get CSRF-TOKEN from meta tag
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        // For erase error validate POST request 
        $('#name').keypress(function(val){
            if(val){
                $('#helpName').hide();
                $('#name').css('border', '1px solid #ced4da');
            }
        });
        $('#username').keypress(function(val){
            if(val){
                $('#helpUsername').hide();
                $('#username').css('border', '1px solid #ced4da');
            }
        });
        $('#password').keypress(function(val){
            if(val){
                $('#helpPassword').hide();
                $('#password').css('border', '1px solid #ced4da');
            }
        });
        $('#note').keypress(function(val){
            if(val){
                $('#helpNote').hide();
                $('#note').css('border', '1px solid #ced4da');
            }
        });

        // For erase error validate PUT request
        $('#nameEdit').keypress(function(val){
            if(val){
                $('#helpNameEdit').hide();
                $('#nameEdit').css('border', '1px solid #ced4da');
            }
        });   
        $('#usernameEdit').keypress(function(val){
            if(val){
                $('#helpUsernameEdit').hide();
                $('#usernameEdit').css('border', '1px solid #ced4da');
            }
        });
        $('#passwordEdit').keypress(function(val){
            if(val){
                $('#helpPasswordEdit').hide();
                $('#passwordEdit').css('border', '1px solid #ced4da');
            }
        });
        $('#noteEdit').keypress(function(val){
            if(val){
                $('#helpNoteEdit').hide();
                $('#noteEdit').css('border', '1px solid #ced4da');
            }
        });                          


        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('note.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'username', name: 'username'},
                {data: 'note', name: 'note'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action', orderable:false, searchable:false},
            ]
        });

        // Show modal Input
        $('#createNewNotes').click(function(){
            $('#message-valid').hide();
            $('#notesForm').trigger('reset');
            $('#modalHeading').html('Create New Note');
            $('#modalNotes').modal('show');

            //hidden text help for info validate
            $('#helpName').hide();
            $('#helpUsername').hide();
            $('#helpPassword').hide();
            $('#helpNote').hide();

            //set default border if cancel create data (did not pass validation)
            $('#name').css('border', '1px solid #ced4da');
            $('#username').css('border', '1px solid #ced4da');
            $('#password').css('border', '1px solid #ced4da');
            $('#note').css('border', '1px solid #ced4da');
        });

        // Send request POST to NoteController
        $('#saveBtn').click(function(e){
            e.preventDefault();
            $(this).html('Sending...');

            $.ajax({
                data: $('#notesForm').serialize(),
                url: "{{ route('note.store') }}",
                type: "POST",
                dataType: "json",
                success: function(data){
                    $('#notesForm').trigger('reset');
                    $('#modalNotes').modal('hide');
                    toastr.success(data.success, 'Success');
                    console.log(data);
                    table.draw();
                },error: function(data){
                    // Get Error Validation
                    var error = [];
                    var response = JSON.parse(data.responseText);
                    $.each(response.errors, function(key, value){
                        error[key] = value;
                    })
                    
                    // Display error validation under the form
                    if (error['name']) {
                        $('#helpName').html(error['name']);
                        $('#name').css('border', '1px solid rgb(255, 61, 68)');
                        $('#helpName').show();
                    }
                    if (error['username']) {
                        $('#helpUsername').html(error['username']);
                        $('#username').css('border', '1px solid rgb(255, 61, 68)');
                        $('#helpUsername').show();
                    }
                    if (error['password']) {
                        $('#helpPassword').html(error['password']);
                        $('#password').css('border', '1px solid rgb(255, 61, 68)');
                        $('#helpPassword').show();
                    }
                    if (error['note']) {
                        $('#helpNote').html(error['note']);
                        $('#note').css('border', '1px solid rgb(255, 61, 68)');
                        $('#helpNote').show();
                    }
                    
                }
            })
        });

        // Show modal edit 
        $('body').on('click', '.editNote', function(){
            var note_id = $(this).data('id');

            $.get("{{ route('note.index') }}" + '/' + note_id + '/edit', function(data) {
                $('#modalHeadingEdit').html('Edit Note');
                $('#modalNotesEdit').modal('show');
                $('#notes_idEdit').val(data.id);
                $('#nameEdit').val(data.name);
                $('#usernameEdit').val(data.username);
                $('#passwordEdit').val(data.password);
                $('#websiteEdit').val(data.website);
                $('#noteEdit').val(data.note);

                //hidden text help for info validate
                $('#helpNameEdit').hide();
                $('#helpUsernameEdit').hide();
                $('#helpPasswordEdit').hide();
                $('#helpNoteEdit').hide();

                //set default border if cancel update data (did not pass validation)
                $('#nameEdit').css('border', '1px solid #ced4da');
                $('#usernameEdit').css('border', '1px solid #ced4da');
                $('#passwordEdit').css('border', '1px solid #ced4da');
                $('#noteEdit').css('border', '1px solid #ced4da');
                });
        });

        // Send request PUT to NoteController
        $('#saveBtnEdit').click(function(e){
            e.preventDefault();
            $(this).html('Sending...');
            var id = $('#notes_idEdit').val();

            $.ajax({
                data: $('#notesFormEdit').serialize(),
                url: "{{ route('note.store') }}" + '/' + id,
                type: "PUT",
                dataType: "json",
                success: function(data){
                    $('#notesFormEdit').trigger('reset');
                    $('#modalNotesEdit').modal('hide');
                    toastr.success(data.success, 'Success');
                    table.draw();
                }, error: function(data){
                    var response = JSON.parse(data.responseText);
                    var error = [];
                    
                    $.each(response.message, function(key, value){
                        error[key] = value;
                    });
                    
                    // Display error validation under the form
                    if (error['name']) {
                        $('#helpNameEdit').html(error['name']);
                        $('#nameEdit').css('border', '1px solid rgb(255, 61, 68)');
                        $('#helpNameEdit').show();
                    }
                    if (error['username']) {
                        $('#helpUsernameEdit').html(error['username']);
                        $('#usernameEdit').css('border', '1px solid rgb(255, 61, 68)');
                        $('#helpUsernameEdit').show();
                    }
                    if (error['password']) {
                        $('#helpPasswordEdit').html(error['password']);
                        $('#passwordEdit').css('border', '1px solid rgb(255, 61, 68)');
                        $('#helpPasswordEdit').show();
                    }
                    if (error['note']) {
                        $('#helpNoteEdit').html(error['note']);
                        $('#noteEdit').css('border', '1px solid rgb(255, 61, 68)');
                        $('#helpNoteEdit').show();
                    }
                } 
            })
        });
    
        // Show modal detail
        $('body').on('click', '.detailNote', function(){
            var note_id = $(this).data('id');
            $.get(
                "{{ route('note.index') }}" + '/' + note_id + '/edit',
                function(data){
                    $('#modalDetail').modal('show');
                    $('#nameDetail').html(data.name);
                    $('#usernameDetail').html(data.username);
                    $('#passwordDetail').html(data.password);
                    $('#websiteDetail').html(data.website);
                    $('#websiteDetail').attr("href", data.website);
                    $('#noteDetail').html(data.note);
                });
        });
    
        // Send request DELETE to NoteController
        $('body').on('click', '.deleteNote', function(){
            var note_id = $(this).data('id');

            // Delete Confirm
            swalWithBootstrapButtons.fire({
                title: 'Are You sure want to delete?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value){
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('note.store') }}" + '/' + note_id,
                        success: function(data){
                            toastr.success(data.success, "Success");
                            
                            table.draw()
                        
                        }, error: function(data){
                            console.log('Error:', data);
                        }
                    })
                    
                }
            })
        });
    </script>
@endsection